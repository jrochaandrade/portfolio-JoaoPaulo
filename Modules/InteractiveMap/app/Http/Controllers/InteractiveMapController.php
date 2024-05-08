<?php

namespace Modules\InteractiveMap\app\Http\Controllers;




//use app\Modules\InteractiveMap\app\Http\Controllers\Controller;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Modules\InteractiveMap\app\Models\PolygonCoordinates;
use Modules\InteractiveMap\app\Models\PolygonData;
use Modules\InteractiveMap\app\Repository\PolygonDataRepository;
use Modules\InteractiveMap\app\Http\Requests\InteractiveMapRequest;
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
    //#[Get(uri: '/mapa', name: 'mapa.index')]
    public function index(Request $request)
    {
        //$polygonsData = PolygonData::paginate(5);

        $polygonsData = PolygonDataRepository::search($request)->paginate(5);
        //dd($polygonsData);

        // Embargos sem paginação para click no mapa
        //$embargoes = PolygonData::all();

        $polygons = $this->searchCoordinates($request);

        //dd($polygons);
        // Envia todos os poligons sem paginação
        $allEmbargoes = PolygonDataRepository::search($request)->get();
        
        return view('interactivemap::index', compact('polygonsData', 'polygons', 'allEmbargoes'));
    }
    public function oldsidebar()
    {

        return view('oldsidebar');
    }
    

    function searchCoordinates(Request $request) 
    {
        $polygons = [];
        $filteredEmbargoes = PolygonDataRepository::search($request)->get();

        // Obter todos os embargos
        //$embargoes = PolygonData::all();

        //Armazenar todos os ids dos embargos
        $embargoesIds = [];
        foreach ($filteredEmbargoes as $embargo) {
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
            $date = isset($register['DATA']) ? $register['DATA'] : (isset($register['data']) ? $register['data'] : '2001-01-01');

            $defaultDate = $this->formatDate($defaultDate, $date);
            $register['DATA'] = $defaultDate;

            $polygonsUpload [] = $register;

        }

       /*  DB::beginTransaction();

        try { */
            //Armazenas os dados do poligno na tabela polygon_data
            
            foreach ($polygonsUpload as $polygon) {
                
                // Verifica o tamanho do cpf para definir se é cpf ou cnpj e salva no campo adequado
                if (strlen($polygon['CPF_CNPJ']) > 14) {
                    $cnpj = $polygon['CPF_CNPJ'];
                    $cpf = null;
                } else {
                    $cpf = $polygon['CPF_CNPJ'];
                    $cnpj = null;
                }

                $polygonData = new PolygonData ([
                    'id_register' => isset($polygon['ID_CADAST']) ? $polygon['ID_CADAST'] : (isset($polygon['id_cadast']) ? $polygon['id_cadast'] : 'Não informado'),
                    'unique_id' => $polygon['unique_id'],
                    'name' => isset($polygon['nome']) ? $polygon['nome'] : (isset($polygon['NOME']) ? $polygon['NOME'] : 'Não informado'),
                    'cpf' => $cpf,
                    'cnpj' => $cnpj,
                    'address' => isset($polygon['endereco']) ? $polygon['endereco'] : (isset($polygon['ENDERECO']) ? $polygon['ENDERECO'] : 'Não informado'),
                    'city' => isset($polygon['municipio']) ? $polygon['municipio'] : (isset($polygon['MUNICIPIO']) ? $polygon['MUNICIPIO'] : 'Não informado'),
                    'area' => isset($polygon['area']) ? number_format($polygon['area'], 3, ',') : (isset($polygon['AREA']) ? number_format($polygon['AREA'], 3, ',') : 'Não informado'),
                    'infraction_notice' => isset($polygon['num_aut']) ? $polygon['num_aut'] : (isset($polygon['NUM_AUT']) ? $polygon['NUM_AUT'] : 'Não informado'),
                    'decree' => isset($polygon['enquad_aut']) ? $polygon['enquad_aut'] : (isset($polygon['ENQUAD_AUT']) ? $polygon['ENQUAD_AUT'] : 'Não informado'),
                    'embargo' => isset($polygon['num_embarg']) ? $polygon['num_embarg'] : (isset($polygon['NUM_EMBARG']) ? $polygon['NUM_EMBARG'] : 'Não informado'),
                    'ocurrence' => isset($polygon['num_bo_boa']) ? $polygon['num_bo_boa'] : (isset($polygon['NUM_BO_BOA']) ? $polygon['NUM_BO_BOA'] : 'Não informado'),
                    'law' => isset($polygon['enqua_boa']) ? $polygon['enqua_boa'] : (isset($polygon['ENQUA_BOA']) ? $polygon['ENQUA_BOA'] : 'Não informado'),
                    'type_infraction' => isset($polygon['tipo_infra']) ? $polygon['tipo_infra'] : (isset($polygon['TIPO_INFRA']) ? $polygon['TIPO_INFRA'] : null),
                    'date' =>$polygon['DATA'],
                    'team' => isset($polygon['nome_equip']) ? $polygon['nome_equip'] : (isset($polygon['NOME_EQUIP']) ? $polygon['NOME_EQUIP'] : null),
                    'centroid' => isset($polygon['coor_centr']) ? $polygon['coor_centr'] : (isset($polygon['COOR_CENTR']) ? $polygon['COOR_CENTR'] : 'Não informado'),
                    'geo_manager' => isset($polygon['RESP_GEO']) ? $polygon['RESP_GEO'] : (isset($polygon['resp_geo']) ? $polygon['resp_geo'] : 'Não informado'),
                    'operation' => isset($polygon['equipe']) ? $polygon['equipe'] : (isset($polygon['EQUIPE']) ? $polygon['EQUIPE'] : 'Não informado'),
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

    public function downloadPolygon($id) {
        //Salvar os vértices em um array com base no id enviado da view
        $result = PolygonData::with('polygonCoordinates')->find($id);
        if($result) {
            $polygonsExternal = [];
            $polygonsInternal = [];            
            foreach($result->polygonCoordinates as $vertex) {
                $uniqueIdCoordinate = $vertex->unique_id_coord;
                if($vertex->type_polygon === 'Externo') {
                    if(!isset($polygonsExternal[$uniqueIdCoordinate])) {
                        $polygonsExternal[$uniqueIdCoordinate] = [];
                    }
                    $polygonsExternal[$uniqueIdCoordinate][] = $vertex;
                }
                if($vertex->type_polygon === 'Interno') {
                    if(!isset($polygonsInternal[$uniqueIdCoordinate])) {
                        $polygonsInternal[$uniqueIdCoordinate] = [];
                    }
                    $polygonsInternal[$uniqueIdCoordinate][] = $vertex;
                }
            }
        }
        // Cria uma instância de DomDocument
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->formatOutput = true;

        // Cria o elemento kml
        $kml = $doc->createElement('kml');
        $kml->setAttribute('xmlns', 'http://www.opengis.net/kml/2.2');
        $doc->appendChild($kml);

        // Cria o elemento Document dentro do kml
        $document = $doc->createElement('Document');
        $document->setAttribute('id', 'root_doc');
        $kml->appendChild($document);

        // Cria o esquema (schema)
        $schema = $doc->createElement('Schema');
        $schema->setAttribute('name', 'Embargo');
        $schema->setAttribute('id', 'Embargo');

        // Define os campos do Schema (SimpleFields)
        $fields = [
            'id_polygon' => 'float',
            'id_register' => 'string',
            'name' => 'string',
            'cpf' => 'string',
            'cnpj' => 'string',
            'address' => 'string',
            'cty' => 'string',
            'area' => 'string',
            'infraction_notice' => 'string',
            'decree' => 'string',
            'embargo' => 'string',
            'occurrence' => 'string', // Corrected typo in field name
            'law' => 'string',
            'type_infraction' => 'string',
            'date' => 'string',
            'team' => 'string',
            'centroid' => 'string',
            'operation' => 'string',
            'geo_manager' => 'string',
        ];
        foreach ($fields as $fieldName => $fieldType) {
            $simpleField = $doc->createElement('SimpleField');
            $simpleField->setAttribute('name', $fieldName);
            $simpleField->setAttribute('type', $fieldType);
            $schema->appendChild($simpleField);
        }

        // Adiciona o Schema ao Document
        $document->appendChild($schema);

        // Criar o Folder
        $folder = $doc->createElement('Folder');
        $document->appendChild($folder);

        // Cria o nome e adiciona ao Folder
        $name = $doc->createElement('name', 'Embargo');
        $folder->appendChild($name);

        // Cria o elemento Placemark para cada embargo
        $placemark = $doc->createElement('Placemark');
        // Cria o elemento name e define o nome do polígono
        $name = $doc->createElement('name', $result->name);
        $placemark->appendChild($name);

        // Cria o elemento Style com os estilos desejados
        $style = $doc->createElement('Style');
        $lineStyle = $doc->createElement('LineStyle');
        $color = $doc->createElement('color', 'ff0000ff');
        $lineStyle->appendChild($color);
        $polyStyle = $doc->createElement('PolyStyle');
        $fill = $doc->createElement('fill', '0');
        $polyStyle->appendChild($fill);
        $style->appendChild($lineStyle);
        $style->appendChild($polyStyle);
        $placemark->appendChild($style);

        // Cria o elemento ExtendedData
        $extendedData = $doc->createElement('ExtendedData');
        $placemark->appendChild($extendedData);

        // Cria o elemento SchemaData com schemaUrl
        $schemaData = $doc->createElement('SchemaData');
        $schemaData->setAttribute('schemaUrl', '#Embargo');
        $extendedData->appendChild($schemaData);

        // Cria o elemento SimpleData para cada campo e adiciona os valores
        foreach ($fields as $fieldName => $fieldType) {
            $simpleData = $doc->createElement('SimpleData', $result->$fieldName); // Corrected variable name
            $simpleData->setAttribute('name', $fieldName);
            $schemaData->appendChild($simpleData);
        }

        // Adiciona o ExtendedData ao Placemark
        $placemark->appendChild($extendedData);

        // Cria o elemento MultiGeometry
        $multiGeometry = $doc->createElement('MultiGeometry');

        foreach ($polygonsExternal as $uniqueIdCoordinate => $polygon) {
            $coordinatesString = '';

            foreach ($polygon as $coordinate) {
                $uniqueIdExternal = $coordinate['unique_id_external']; // Corrected variable name
                if ($coordinate->polygon_data_id_fk === $result->id_polygon && $coordinate->type_polygon === 'Externo') {
                    $coordinatesString .= $coordinate->longitude . ',' . $coordinate->latitude . ' ';
                }
            }

            // Remove os espaços extras no final de cada string de coordenadas
            $coordinatesString = trim($coordinatesString);

            if (!empty($coordinatesString)) {

                // Cria o elemento Polygon dentro de MultiGeometry
                $polygonElement = $doc->createElement('Polygon');

                // Cria o elemento outerBoundaryIs dentro de Polygon
                $outerBoundaryIs = $doc->createElement('outerBoundaryIs');

                // Cria o elemento LinearRing dentro de outerBoundaryIs
                $linearRing = $doc->createElement('LinearRing');

                // Adiciona as coordenadas ao LinearRing
                $coordinates = $doc->createElement('coordinates', $coordinatesString);
                $linearRing->appendChild($coordinates);

                // Adiciona LinearRing a outerBoundaryIs
                $outerBoundaryIs->appendChild($linearRing);

                // Adiciona outerBoundaryIs a Polygon
                $polygonElement->appendChild($outerBoundaryIs);

                // Loop para adicionar os polígonos internos
                foreach ($polygonsInternal as $uniqueIdCoordinate => $internalPolygon) {
                    $coordinatesStringInternal = '';

                    foreach ($internalPolygon as $coordinateInternal) {
                        if ($coordinateInternal->polygon_data_id_fk === $result->id_polygon && $coordinateInternal->unique_id_external === $uniqueIdExternal && $coordinateInternal->type_polygon === 'Interno') {
                            $coordinatesStringInternal .= $coordinateInternal->longitude . ',' . $coordinateInternal->latitude . ' ';
                        }
                    }

                    // Remove espaços extras no final da string
                    $coordinatesStringInternal = trim($coordinatesStringInternal);

                    if (!empty($coordinatesStringInternal)) {
                        // Cria o elemento innerBoundaryIs dentro de Polygon
                        $innerBoundaryIs = $doc->createElement('innerBoundaryIs');

                        // Cria o elemento LinearRing dentro de innerBoundaryIs
                        $innerLinearRing = $doc->createElement('LinearRing');

                        // Adiciona as coordenadas ao innerLinearRing
                        $innerCoordinates = $doc->createElement('coordinates', $coordinatesStringInternal);
                        $innerLinearRing->appendChild($innerCoordinates);

                        // Adiciona innerLinearRing a innerBoundaryIs
                        $innerBoundaryIs->appendChild($innerLinearRing);

                        // Adiciona innerBoundaryIs a Polygon
                        $polygonElement->appendChild($innerBoundaryIs);
                    }
                }

                // Adiciona Polygon a MultiGeometry
                $multiGeometry->appendChild($polygonElement);
            }
        }

        // Adiciona MultiGeometry ao Placemark
        $placemark->appendChild($multiGeometry);

        // Adiciona o Placemark ao Folder
        $folder->appendChild($placemark);

        // Salva o documento KML em um arquivo temporário
        $tempFilePath = tempnam(sys_get_temp_dir(), $result->name);
        $doc->save($tempFilePath);

        // Envia o arquivo KML para download
        return response()->download($tempFilePath, $result->name . '.kml', [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $result->name . '.kml"',
        ]);


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
        $data = PolygonData::where('id_polygon', $id)->first();

        $polygons = $this->searchCoordinatesShow($id);

        return view('interactivemap::show', compact('data', 'polygons'));
    }

    function searchCoordinatesShow  ($id) 
    {
        //$polygon = PolygonData::find($id);

        //dd($id);

        $unique_ids = DB::table('polygon_coordinates')->where('polygon_data_id_fk', $id)->distinct()->pluck('unique_id_coord');
        //dd($unique_ids);

        foreach ($unique_ids as $unique_id) {
            $coordinates = DB::table('polygon_coordinates')
                ->select('latitude', 'longitude', 'polygon_data_id_fk', 'type_polygon')
                ->where('unique_id_coord', $unique_id)
                ->get();


            $coordinates_array = [];
            foreach ($coordinates as $coordinate) {
                $coordinates_array[] = [
                    'latitude' => $coordinate->latitude,
                    'longitude' => $coordinate->longitude,
                    'id' => $coordinate->polygon_data_id_fk,
                    'type_polygon' => $coordinate->type_polygon
                ];
            }

            $polygons[$unique_id] = $coordinates_array;

        }

        return $polygons;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = PolygonData::find($id);
        return view('interactivemap::edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(InteractiveMapRequest $request, $id)
    {
        $id_usuario = auth()->id();

        $data = PolygonData::find($id);
        
        $data->fill($request->all());

        $data->id_user_last_updated_at = $id_usuario;
        
        $data->save();


        return redirect()->route('mapa.edit', ['id' => $data])->with('success', true);


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $id_usuario = auth()->id();

        $data = PolygonData::find($id);

        $data->delete();

        $data->id_user_deleted_at = $id_usuario;

        $data->save();

        return redirect()->back()->with('success', 'Excluido com sucesso!');
    }
}
