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

class InteractiveMapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $polygonsData = PolygonData::paginate(5);

        return view('interactivemap::index', compact('polygonsData'));
    }
    public function teste()
    {

        return view('teste');
    }

    public function uploadKml (Request $request)
    {

        //$user_id = auth()->id();

        if ($request->hasFile('kmlFile')) {
            $kmlFile = $request->file('kmlFile');
            $kmlContent = File::get($kmlFile);       
        }

        $xml = new \SimpleXMLElement($kmlContent);

        $polygonsUpload = [];
        foreach ($xml->Document->Folder->Placemark as $placemark) {
            $register = [];

            // Loop através dos atributos
            foreach ($placemark->ExtendedData->SchemaData->SimpleData as $attribute) {
                $name = (string) $attribute['name'];
                $value = (string) $attribute;

                // Armazene os valores com vase no nome do atributo
                $register[$name] = $value;
            }

            // Verifica se o polígono é interno ou externo e armazena as coordenadasd em arrays separadas
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
            } 

            // Adicionar id unico no array
            $uniqueIdData = rand();
            $register['unique_id'] = $uniqueIdData;

            //Adicionar poligonos internos e externos no array
            $register['polygon_external'] = $arrayExternalCoord;
            $register['polygon_internal'] = $arrayInternalCoord;

            // Verifica o tamanho do cpf para definir se é cpf ou cnpj e salva no campo adequado
            if (strlen($register['CPF_CNPJ']) > 14) {
                $cnpj = $register['CPF_CNPJ'];
                $cpf = null;
            } else {
                $cpf = $register['CPF_CNPJ'];
                $cnpj = null;
            }

            // Chama a função formatarData para formatar conforme padrão do bando
            $defaultDate = null;
            $date = $register['DATA'];
            $defaultDate = $this->formatDate($defaultDate, $date);
            $register['DATA'] = $defaultDate;

            $polygonsUpload [] = $register;

        }

       /*  DB::beginTransaction();

        try { */
            //Armazenas os dados do poligno na tabela polygon_data
            foreach ($polygonsUpload as $polygon) {
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
            // Chama a função saveCoordinates para armazenar as coordenadas dos polígonos na tabela polygon_coordinates
            //dd($polygonsUpload);
            foreach ($polygonsUpload as $polygons) {
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
            }

            


        /*     DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), 500);
        }  */

        return redirect('map');
    }

    private function saveCoordinates($coordinates, $uniqueIdCoord, $typePolygon, $uniqueIdData) 
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
                    'type_polygon' => $typePolygon
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
