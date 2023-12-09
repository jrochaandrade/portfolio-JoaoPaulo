<?php

namespace Modules\InteractiveMap\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Modules\InteractiveMap\Entities\PolygonCoordinates;
use Modules\InteractiveMap\Entities\PolygonData;
use Illuminate\Support\Facades\DB;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Delete;

//#[Middleware('auth')]
class InteractiveMapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    #[Get(uri: '/mapa', name: 'mapa.index')]
    public function index(Request $request)
    {
        $polygonsData = PolygonData::paginate(5);

        // Embargos sem paginação para click no mapa
        $embargoes = PolygonData::all();

        $polygons = $this->searchCoordinates($request);

        return view('interactivemap::index', compact('polygonsData', 'polygons', 'embargoes'));
    }
    public function oldsidebar()
    {

        return view('oldsidebar');
    }


    function searchCoordinates(Request $request) 
    {
        $polygons = [];
        //$filteredEmbargoes = 

        // Obter todos os embargos
        $embargoes = PolygonData::all();

        //Armazenar todos os ids dos embargos
        $embargoesIds = [];
        foreach ($embargoes as $embargo) {
            $embargoesIds[] = [
                'id' => $embargo['id_polygon'],
            ];
        }

        // Armazena todos os ids únicos que fazem ligação com os ids armazenados na variável $embargoesIds
        $uniquesIds = DB::table('polygon_coordinates')->whereIn('polygon_data_id_fk', $embargoesIds)->distinct()->pluck('unique_id_coord');

        // Percorre todos os ids únicos e busca na tabela polygon_coordinates e consulta as coordenadas lat, log e id da tabela pai
        foreach ($uniquesIds as $uniqueId) {
            $coordinates = DB::table('polygon_coordinates')->select('latitude', 'longitude', 'polygon_data_id_fk')->where('unique_id_coord', $uniqueId)->get();
            // Percorre todas as coordenadas e cria um array onde é armazenadao as coordenadas e o id
            $arrayCoordinates = [];
            foreach ($coordinates as $coordinate) {
                $arrayCoordinates[] = [
                    'latitude' => $coordinate->latitude,
                    'longitude' => $coordinate->longitude,
                    'id' => $coordinate->polygon_data_id_fk,
                ];
            }            
            // Atribui o array de coordenadas ao array $polygons usando o id do poligono como chave
            $polygons[$uniqueId] = $arrayCoordinates;
        }

        return $polygons;

    }




    #[Post(uri: 'uploadKml', name: 'uploadKml')]
    public function uploadKml (Request $request)
    {

        //$user_id = auth()->id();

        if ($request->hasFile('kmlFile')) {
            $kmlFile = $request->file('kmlFile');
            $kmlContent = File::get($kmlFile);       
        }

        $xml = new \SimpleXMLElement($kmlContent);

        //$polygonsUpload = [];
        foreach ($xml->Document->Folder->Placemark as $placemark) {
            $register = [];

            // Loop através dos atributos
            foreach ($placemark->ExtendedData->SchemaData->SimpleData as $attribute) {
                $name = (string) $attribute['name'];
                $value = (string) $attribute;

                // Armazene os valores com vase no nome do atributo
                $register[$name] = $value;
            }

            $uniqueIdCoord = null;            
            $arrayVertice = [];
            if (isset($placemark->MultiGeometry->Polygon)) {
                $i = 0;
                foreach ($placemark->MultiGeometry->Polygon as $polygon) {
                    if(property_exists($polygon, 'outerBoundaryIs')) {
                        $arrayVertice[$i]['external'] = $polygon->outerBoundaryIs->LinearRing->coordinates;
                        if(property_exists($polygon, 'innerBoundaryIs')) {
                            $arrayVertice[$i]['internal'] = [];
                            foreach ($polygon->innerBoundaryIs as $innerBoundary) {
                                $arrayVertice[$i]['internal'][] = $innerBoundary->LinearRing->coordinates;
                            }                        
                        }
                    }
                    $i++;                    
                }
            }

            /* // Verifica se o polígono é interno ou externo e armazena as coordenadasd em arrays separadas
            $uniqueIdCoord = null;
            $arrayExternalCoord = [];
            $arrayInternalCoord = [];
            if (isset($placemark->MultiGeometry->Polygon)) {
                foreach ($placemark->MultiGeometry->Polygon as $polygon) {
                    if(property_exists($polygon, 'outerBoundaryIs')) {
                        $typePolygon = 'externo';
                        $arrayExternalCoord [] = $polygon->outerBoundaryIs->LinearRing->coordinates;
                    }
                    if(property_exists($polygon, 'innerBoundaryIs')) {
                        foreach ($polygon->innerBoundaryIs as $innerBoundary) {
                            $typePolygon = 'interno';
                            $arrayInternalCoord [] = $innerBoundary->LinearRing->coordinates;
                        }                        
                    }
                }
            } */ 

            // Adicionar id unico no array
            $uniqueIdData = rand();
            $register['unique_id'] = $uniqueIdData;

            //Adicionar poligonos internos e externos no array            
            $register['vertices'] = $arrayVertice;

            // Chama a função formatarData para formatar conforme padrão do bando
            $defaultDate = '';
            $date = $register['DATA'];
            $defaultDate = $this->formatDate($defaultDate, $date);
            $register['DATA'] = $defaultDate;

            $polygonsUpload [] = $register;

        }

       /*  DB::beginTransaction();

        try { */
            //Armazenas os dados do poligno na tabela polygon_data
            foreach ($polygonsUpload as $polygon) {
                
                // Verifica o tamanho do cpf para definir se é cpf ou cnpj e salva no campo adequado
                if (strlen($register['CPF_CNPJ']) > 14) {
                    $cnpj = $register['CPF_CNPJ'];
                    $cpf = null;
                } else {
                    $cpf = $register['CPF_CNPJ'];
                    $cnpj = null;
                }

                $polygonData = new PolygonData ([
                    'id_register' =>$polygon['ID_CADAST'],
                    'unique_id' =>$polygon['unique_id'],
                    'name' =>$polygon['NOME'],
                    'cpf' => $cpf,
                    'cnpj' => $cnpj,
                    'address' =>$polygon['ENDERECO'],
                    'city' =>$polygon['MUNICIPIO'],
                    'area' =>$polygon['AREA'],
                    'infraction_notice' =>$polygon['NUM_AUT'],
                    'decree' =>$polygon['ENQUAD_AUT'],
                    'embargo' =>$polygon['NUM_EMBARG'],
                    'ocurrence' =>$polygon['NUM_BO_BOA'],
                    'law' =>$polygon['ENQUA_BOA'],
                    'type_infraction' =>$polygon['INFRACAO'],
                    'date' =>$polygon['DATA'],
                    'team' =>$polygon['EQUIPE'],
                    'centroid' =>$polygon['COOR_CENTR'],
                    'geo_manager' =>$polygon['RESP_GEO'],
                    'operation' =>$polygon['NOME_OPERA'],
                    'id_user_created_at' =>'123456' ,  /* $id_usuario */
                ]);
                $polygonData->save();
            }


            foreach ($polygonsUpload as $polygons) {
                
                $uniqueIdData = $polygons['unique_id'];
                foreach ($polygons['vertices'] as $vertice) {
                    foreach ($vertice['external'] as $coordinates){
                        $uniqueIdExternal = rand();
                        $typePolygon = 'Externo';
                        $this->saveCoordinates($coordinates, $uniqueIdExternal, $typePolygon, $uniqueIdData);
                        if (array_key_exists('internal', $vertice) && $vertice['internal'] !== null) {
                            foreach ($vertice['internal'] as $coordinates) {
                                $typePolygon = 'Interno';
                                $this->saveCoordinates($coordinates, $uniqueIdExternal, $typePolygon, $uniqueIdData);
                            }
                        }
                   }
                }
            }

            // Chama a função saveCoordinates para armazenar as coordenadas dos polígonos na tabela polygon_coordinates
            //dd($polygonsUpload);
            /* foreach ($polygonsUpload as $polygons) {
                $uniqueIdData = $polygon['unique_id'];
                foreach ($polygons['polygon_external'] as $coordinates) {
                    $typePolygon = 'Externo';
                    $this->saveCoordinates($coordinates, $uniqueIdCoord, $typePolygon, $uniqueIdData);
                }
                if ($polygons['polygon_internal'] != null) {
                    foreach ($polygons['polygon_internal'] as $coordinates) {
                        $typePolygon = 'Interno';
                        $this->saveCoordinates($coordinates, $uniqueIdCoord, $typePolygon, $uniqueIdData);
                    }
                }
            } */

            


        /*     DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), 500);
        }  */

        return redirect('mapa');
    }

    private function saveCoordinates($coordinates, $uniqueIdExternal, $typePolygon, $uniqueIdData) 
    {

        //dd($polygon, $uniqueIdCoord, $typePolygon, $uniqueIdData);

        DB::beginTransaction();
        try {

            // Verificar o id unico do embargo recebido do polígono e buscar o embargo na tabela

            $polygon = PolygonData::where('unique_id', $uniqueIdData)->first();
            $idPolygon = $polygon['id_polygon'];
            
            $uniqueIdCoord = rand();

            $stringCoorinates = (string) $coordinates;

            $arrayCoordinates = explode(' ', trim($stringCoorinates));

            foreach ($arrayCoordinates as $coordinateEdited) {
                list($long, $lat) = explode(',', $coordinateEdited);

                $coordinatesPolygon = new PolygonCoordinates([
                    'latitude' => (string) $lat,
                    'longitude'=> (string) $long,
                    'polygon_data_id_fk' => $idPolygon,
                    'unique_id_coord' => $uniqueIdCoord,
                    'type_polygon' => $typePolygon,
                    'unique_id_external' => $uniqueIdExternal
                ]);

                $polygon->polygonCoordinates()->save($coordinatesPolygon);
            }




            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function formatDate ($defaultDate, $date) {
        //  Verifica se a data está no formato 'yyyy-mm-dd' (ano-mês-dia) ou 'yyyy/mm/dd' (ano/mês/dia), se tiver não precisa converter.
        if (preg_match('/\d{4}\-\d{2}\-\d{2}$/', $date) ||  preg_match('/\d{4}\/\d{2}\/\d{2}$/', $date)) {
            $defaultDate = $date;
            
        // Verifica se a data está no formato 'dd/mm/yyyy' (dia/mês/ano) ou 'dd-mm-yyyy' (dia-mês-ano), se estiver converte para o formato 'yyyy/mm/dd'.
        } elseif (preg_match('/\d{2}\/\d{2}\/\d{4}$/', $date) ||  preg_match('/\d{2}\-\d{2}\-\d{4}$/', $date)) {
            $cleanDate = str_replace('-', '/', $date);

            $defaultDate = Carbon::createFromFormat('d/m/Y', $cleanDate)->format('Y-m-d');

        // Verifica se a data está no formato 'dd/mm/yy' abreviado ex. (10/01/23) (dia/mês/ano) ou 'dd-mm-yy' (dia-mês-ano), se estiver converte para o formato 'yyyy/mm/dd'.
        } elseif (preg_match('/\d{2}\-\d{2}\-\d{2}$/', $date) || preg_match('/\d{2}\/\d{2}\/\d{2}$/', $date)) {
            $cleanDate = str_replace('-', '/', $date);
            
            list($dia, $mes, $ano_curto) = explode('/', $cleanDate);

            $ano = "20$ano_curto";

            $defaultDate = Carbon::create($ano, $mes, $dia)->format('Y-m-d');
            
        } else {
            'Verificar o padrão da data adicionado no arquivo'; // Verificar se vai colocar mensagem de erro.

        };

        return $defaultDate;
    }

    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('interactivemap::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('interactivemap::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('interactivemap::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
