<?php

namespace Modules\DetailedReport\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
//use PDF;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Dompdf\Options;
use Modules\DetailedReport\Http\Requests\ReportRequest;
use Modules\DetailedReport\Http\Requests\ReportRequestEdit;
use Modules\DetailedReport\Models\Infraction;
use Modules\DetailedReport\Models\InfractionBo;
use Modules\DetailedReport\Models\PhotosReport;
use Modules\DetailedReport\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class DetailedReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $perPage = 5;
        $reports = Report::paginate(5); 
        
        
        
        
        return view('detailedreport::index', compact('reports'));
    }

    public function show($id)
    {   

        
        $data = Report::find($id);
        
        $infraction = Infraction::find($data->id_infraction);
        $infraction_bo = InfractionBo::find($data->id_infraction_bo);


        //$historic = isset($_POST['historic']) ? $_POST['historic'] : null;
        $historic = $data['historic'];
        //dd($historic);
        $paragraphsHistoric = explode("\r\n", $historic);
        //dd($paragraphsHistoric);
        $paragraphs = array();
        foreach ($paragraphsHistoric as $paragraphHistoric) {
            if ($paragraphHistoric != null) {                    
                $paragraphs[] = $paragraphHistoric;
            }                
        }
        //dd($paragraphs);
        $data['historicParagraphs'] =  $paragraphs;

        if ($mitigating_string = $data['mitigating']) {

            $mitigating_string = $data['mitigating'];
            
            $mitigatingExplode = explode('*', $mitigating_string);
            //dd($mitigatingExplode);
            $teste = array();
            foreach($mitigatingExplode as $mitigating) {
                if ($mitigating != null) {
                    $mitigatingArray[] = $mitigating;
                    
                }
            }
            
            $data['mitigatingArray'] = $mitigatingArray;
        } else {
            $data['mitigatingArray'] = 'Não possui atenuante.';
        }
        
        
        if ($aggravating_string = $data['aggravating']) {
            $aggravating_string = $data['aggravating'];
            
            $aggravatingExplode = explode('*', $aggravating_string);
            //dd($aggravatingExplode);
            $teste = array();
            foreach($aggravatingExplode as $aggravating) {
                if ($aggravating != null) {
                    $aggravatingArray[] = $aggravating;
                    
                }
            }
            
            $data['aggravatingArray'] = $aggravatingArray;

        }else {
            $data['aggravatingArray'] = 'Não possui agravante.';
        }

        $photosReport = PhotosReport::where('report_report_ID', $id)->get();
        
        $photosBased = array();
        $i = 0;
        $image1 = [];
        $image2 = [];
        
        foreach ($photosReport as $photo) {
            if ($photo->type_image == 'image1') {
                $image1[] = $photo;
            } else{
                $image2[] = $photo;
            }
        }
        $i = 0;
        foreach ($image1 as $image) {
            $caminhoImagem = '/' . $image['image'];

            // Obter a URL da imagem
            $urlImagem = Storage::url($caminhoImagem);
            
            // Carregar o conteúdo da imagem da URL
            $conteudoImagem = file_get_contents(public_path('storage/' . $caminhoImagem));
            // Converter o conteúdo da imagem para base64
            $imagemBase64 = base64_encode($conteudoImagem);

            // Atribuir à variável de dados
            $data['imageOcorrence' . ($i + 1)] = $imagemBase64;

            $i++;
        } 
        $i = 0;
        foreach ($image2 as $image) {
            $caminhoImagem = '/' . $image['image'];

            // Obter a URL da imagem
            $urlImagem = Storage::url($caminhoImagem);
            
            // Carregar o conteúdo da imagem da URL
            $conteudoImagem = file_get_contents(public_path('storage/' . $caminhoImagem));
            
            // Converter o conteúdo da imagem para base64
            $imagemBase64 = base64_encode($conteudoImagem);

            // Atribuir à variável de dados
            $data['imageObjects' . ($i + 1)] = $imagemBase64;

            $i++;
        }

        $data['article_administrative'] = $infraction->article_administrative;
        


        $data['article_criminal'] = $infraction_bo->article;
        $data['article_BO'] = $infraction_bo->article_BO;
        

        
        //dd($data);
        return view('detailedreport::report', compact('data'));
    }

    public function generatePdf() 
    {
        $data = Session::get('data', []);
        //dd($data);
        $historic_string = $data['historic'];
        //dd($historic_string);
        // Use preg_split com um padrão que inclui quebras de linha do Windows (\r\n) e Unix/Linux (\n)
        $historic_array = preg_split("/\r\n|\n/", $historic_string);
        
        // Filtra linhas vazias
        $historic_array = array_filter($historic_array, 'strlen');
        
        $data['historic'] = $historic_array;


        /* $mitigantin_string = $data['mitigating'];
        dd($data['agravating']); */
        
    //dd($data);
    
    /* // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml('hello world');

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream(); */

        // Renderize a view para HTML
    $html = View::make('pdf.report', compact('data'))->render();

    
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isFontSubsettingEnabled', true);
    $options->set('isHtml5ParserEnabled', true);

    // Configure as margens em milímetros (exemplo: 10mm para todas as margens)
    $options->set('margin-top', 10);
    $options->set('margin-right', 10);
    $options->set('margin-bottom', 10);
    $options->set('margin-left', 10);

    // Crie uma instância do Dompdf com as opções configuradas
    $dompdf = new Dompdf($options);

    // ... restante do código ...

    $dompdf->set_base_path(public_path('css/detailedReport.css'));
    // (Opcional) Configure o tamanho do papel e a orientação
    $dompdf->setPaper('a4', 'portrait');

    
    // Carregue o HTML no Dompdf
    $dompdf->loadHtml($html);

    // Renderize o HTML como PDF
    $dompdf->render();

    // Saída do PDF gerado para o navegador
    $dompdf->stream();
    

    

    }

    public function create(Request $request)
    {
        
        $infractions = Infraction::all();

        $infraction_search = $request->search_article_BO ? DB::table('infractions')->where('nome', 'LIKE', $request->search_article_BO)->first() : null;
        

        return view('detailedreport::create', compact('infractions', "infraction_search" ));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function store(ReportRequest $request)
    {

        
        
        $data = array();
        
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            
            $id_infraction = $_POST['search_article'];
            $id_infraction_bo = $_POST['search_article_BO'];
    
            $infraction =  Infraction::find($id_infraction);
            $infraction_bo =  InfractionBo::find($id_infraction_bo);

            $data = array();
            foreach ($_POST as $key => $item) {
                $data[$key] = $item;
            }
            // Salva os logos base64 na tabela - Necessário somente para geração do PDF
            /* $pathLogo1 = public_path('images/logo1.png');
            $file1 = file_get_contents($pathLogo1);
            $base64Logo1 = base64_encode($file1);
            $data['logo1'] = isset($base64Logo1) ? $base64Logo1 : null;
            $pathLogo2 = public_path('images/logo2.png');
            $file2 = file_get_contents($pathLogo2);
            $base64Logo2 = base64_encode($file2);
            $data['logo2'] = isset($base64Logo2) ? $base64Logo2 : null;
            $pathLogo3 = public_path('images/logo3.png');
            $file3 = file_get_contents($pathLogo3);
            $base64Logo3 = base64_encode($file3);
            $data['logo3'] = isset($base64Logo3) ? $base64Logo3 : null; */
            
            /* // Define se houve agravente uso de fogo
            $data['use_fire'] = isset($_POST['use_fire']) ? $_POST['use_fire'] : null; */


            
            $data = $this->calculateFineValue($data, $infraction);

            // Recebe o tamanho do desmatamento e separa a parte inteira, verifica se tem fração e define o valor da multa.
            /* $data['size_deforestation'] = isset($_POST['size_deforestation']) ? $_POST['size_deforestation'] : null;
            $data['quantity_wood'] = isset($_POST['quantity_wood']) ? $_POST['quantity_wood'] : null; */
            
            /* $data['size_deforestation_fraction'] = null;


            if ($data['size_deforestation'] != null) {
                if ($data['size_deforestation'] == intval($data['size_deforestation'])) {
                    $data['size_deforestation_intereger'] = $data['size_deforestation'];
                    // Verifica se teve uso de fogo e muda valor da multa
                    if ($data['use_fire'] == 'noUseFire') {
                        
                        $data['value_infraction'] = $data['size_deforestation_intereger'] * $infraction->value_infraction;
                    } else {
                        
                        $data['value_infraction'] = (($data['size_deforestation_intereger'] * $infraction->value_infraction) / 2) + ($data['size_deforestation_intereger'] * $infraction->value_infraction);
                        //$value = ($data['size_deforestation_intereger'] * $infraction->value_infraction) / 2;
                    }
                } else { // Se tamanho do desmatamento não for inteiro separa a fração para calcular a multa
                    $fraction = explode ('.', floatval($data['size_deforestation']));
                    $data['size_deforestation_intereger'] = $fraction[0];
                    $data['size_deforestation_fraction'] = $fraction[1];

                    if ($data['use_fire'] == 'noUseFire') {

                        $data['value_infraction'] = ($data['size_deforestation_intereger'] * $infraction->value_infraction) + 5000;                
                    }else {
                        $normalValue = $data['size_deforestation_intereger'] * $infraction->value_infraction + 5000;
                        $halfValue = $normalValue / 2;
                        $data['value_infraction'] = $normalValue + $halfValue;

                    }
                    
                }
            } else if ($data['quantity_wood'] != null) {
                $data['value_infraction'] = $data['quantity_wood'] * $infraction->value_infraction;

                // Definir valor null par não dar erro
                $data["size_deforestation_intereger"] = null;
                $data["size_deforestation"] = null;
            } */
            
            


           



           
             // Verifica se foi carregado imagens salva para carregar no pdf
             if($request->hasFile('images2')) {
                $data['imageObjects1'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][0]));
                $data['imageObjects2'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][1]));
                $data['imageObjects3'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][2]));
                $data['imageObjects4'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][3]));
            }

            // Verifica se foi carregado imagens salva para carregar no pdf
            if ($request->hasFile('images1')) {
                $data['image1'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][0]));
                $data['image2'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][1]));
                $data['image3'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][2]));
                $data['image4'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][3]));
            }
            

            
            
            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            /* $data['mitigating'] = isset($_POST['mitigating']) ? $_POST['mitigating'] : null; */
            $mitigating_string = '';
            if (isset($data['mitigating']) != null) {
                foreach ($data['mitigating'] as $mitigating) {
                    $mitigating_string .= $mitigating . '*';
                }
            }
            $data['mitigating_string'] = isset($mitigating_string) ? $mitigating_string : null;

            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            /* $data['aggravating'] = isset($_POST['aggravating']) ? $_POST['aggravating'] : null; */
            $aggravating_string = '';
            if (isset($data['aggravating']) != null) {
                foreach ($data['aggravating'] as $aggravating) {
                    $aggravating_string .= $aggravating . '*';
                }
            }
            $data['aggravating_string'] = isset($aggravating_string) ? $aggravating_string : null;

            // Deixa a unidade de medida no singular
            $letter_to_remove = 's';
            $unit_measure_singular = $this->removeLetterEndOfWord($data['unit_measure'], $letter_to_remove);

            // Salva o numero do embargo para enviar para a função gerar o texto administrativo
            $data['number_embargo'] = isset($_POST['number_embargo']) ? $_POST['number_embargo'] : null;




            

            // Escreve valores numericos por extenso - erro nos centavos
           // $formatter = new \NumberFormatter('pt_BR', NumberFormatter::SPELLOUT);

            // Chama a função para escrever o texto administrativo
            $data['text_administrative'] = $this->administrativeTextDeforestation($data, $infraction, $unit_measure_singular);

            // Escreve o texto do embargo
            $data['text_embargo'] = 'A área embargada é de <strong>' . $data['size_deforestation'] . '</strong>  hectares de floresta em ' . $infraction->area_deforestation . ', conforme Termo de Embargo Nº <strong>' . $data['number_embargo'] . '</strong>, para que a área suprimida se regenere.';


            /* $data['text_embargo'] = '';
            // Se tipo de infração for desmatamento
            if ($infraction->type_AI == 'logging') {
                
                // Não tem uso de fogo
                if ($data['use_fire'] == 'noUseFire') { 



                    $data['text_administrative'] = $infraction->verb . ' ' . $data['size_deforestation'] . ' ' . $unit_measure . ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . ' ou fração. Para chegar ao valor obtido, foi ' . $infraction->open_fine_text;
                    
                                        
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) { // Se for desmatamento com área inteira
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;

                    }elseif (floatval($data['size_deforestation']) == $data['size_deforestation']) { // Se for desmatamento com área fração                                                
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' mais R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare' . ' totalizando R$' . $valueInfractionFormated;
                    }
                    
                    
                    
                    
                // Agravante com uso de fogo, aumenta pela metadao o valor da multa
                } else { 
                    
                    $data['text_administrative'] = $infraction->verb . ' ' . $data['size_deforestation'] . ' ' . $unit_measure . ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . $infraction->additional_text . ' aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ' . $infraction->open_fine_text;
                    
                    
                    // Recebe o tamanho do desmatamento e separa o valor inteiro e a fração, forma o texto que vai apresentar no relatório.
                    // Se inteiro
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) {
                        // Formata o valor da infração
                        $normalValue = $data['size_deforestation_intereger'] * $infraction->value_infraction;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' aumentado pela metade totalizando R$' . $valueInfractionFormated;
                    } else {
                        // Formata o valor da infração
                        $normalValue = ($data['size_deforestation_intereger'] * $infraction->value_infraction) + 5000;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' mais R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare = R$ ' . number_format($normalValue, 2, ',', '.') . ' aumentado pela metade totalizando R$ ' . number_format($normalValue + $halfValue, 2, ',', '.');
                    }
                }
                
                $data['text_embargo'] = 'A área embargada é de <strong>' . $data['size_deforestation'] . '</strong>  hectares de floresta em ' . $infraction->area_deforestation . ', conforme Termo de Embargo Nº <strong>' . $data['number_embargo'] . '</strong>, para que a área suprimida se regenere.';
            // Se tipo de infração for madeira
            } elseif ($infraction->type_AI == 'wood') {

                

                $data['text_administrative'] = $infraction->verb . ' ' . $data['quantity_wood'] . ' ' . $unit_measure . ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . '. Para chegar ao valor obtido, foi ';
                
                
                // Adciona o cálculo ao text_administrative
                $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                $data['text_administrative'] .= 'multiplicado ' . $data['quantity_wood'] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;
                
            } */
            
            //dd($data);
            $id_usuario = auth()->id();

            //Cria um id único para o relatório
            $unicIdReport = rand();
            // Salva os dados na tabela reports
            $dataReport = Report::create([
                'name' => $_POST['name'],
                'cpf' => $_POST['cpf'],
                'rg' => isset($_POST['rg']) ? $_POST['rg'] : null,
                'phone' => $_POST['phone'],
                'birthday' =>  $_POST['birthday'] ,
                'affiliation' => $_POST['affiliation'],
                'address' => $_POST['address'],
                'location' => $_POST['location'],            
                'historic' => $_POST['historic'],
                'number_BO' => $_POST['number_BO'],
                'type_BO' => $_POST['type_BO'],
                //'article_BO' => $infraction_bo->,
                'number_AI' => $_POST['number_AI'],
                //'value_AI' => $_POST['value_AI'],
                //'article_AI' => $_POST['article_AI'],
                'id_infraction' => $id_infraction,
                'id_infraction_bo' => $id_infraction_bo,
                'type_AI' => $infraction->type_AI,
                'unit_measure' =>  $_POST['unit_measure'],
                'use_fire' => $_POST['use_fire'],
                'size_deforestation' => $data['size_deforestation'],
                'size_deforestation_intereger' => $data['size_deforestation_intereger'],
                'size_deforestation_fraction' => $data['size_deforestation_fraction'],
                //'type_deforestation' => $_POST['selectTypeAI'],
                //'area_deforestation' => $_POST['area_deforestation'],
                'value_infraction' => $data['value_infraction'],
                'number_embargo' => $data['number_embargo'] ? $data['number_embargo'] : null,
                'quantity_wood' => $data['quantity_wood'] ? $data['quantity_wood'] : 0,

                'number_letter' => isset($_POST['number_letter']) ? $_POST['number_letter'] : null,
                'text_administrative' => $data['text_administrative'],
                'text_embargo' => $data['text_embargo'],
                'text_type_wood' => $_POST['text_type_wood'],
                'motive' => $_POST['motive'],
                'mitigating' => $data['mitigating_string'],
                'aggravating' => $data['aggravating_string'],
                'name_CMT' => $_POST['name_CMT'],
                'name_MOT' => $_POST['name_MOT'],
                'name_PTR1' => isset($_POST['name_PTR1']) ? $_POST['name_PTR1'] : null,
                'name_PTR2' => isset($_POST['name_PTR2']) ? $_POST['name_PTR2'] : null,
                'name_PTR3' => isset($_POST['name_PTR3']) ? $_POST['name_PTR3'] : null,
                'unit_CMT' => $_POST['unit_CMT'],
                'unit_MOT' => $_POST['unit_MOT'],
                'unit_PTR1' => isset($_POST['unit_PTR1']) ? $_POST['unit_PTR1'] : null,
                'unit_PTR2' => isset($_POST['unit_PTR2']) ? $_POST['unit_PTR2'] : null,
                'unit_PTR3' => isset($_POST['unit_PTR3']) ? $_POST['unit_PTR3'] : null,
                'unic_id_report' => $unicIdReport,
                'term_seizure' => $_POST['term_seizure'],
                'seized_objects' => $_POST['seized_objects'],
                'deposit_location' => $_POST['deposit_location'],
                'name_faithful' => $_POST['name_faithful'],
                'name_responsible' => $_POST['name_responsible'],
                'id_user_created_at' => $id_usuario
            ]);





        } else {
            dd('Formuário não enviado');
        }

        

        // Recebe o id do Relatório para vincular as fotos e salvar no banco
        $report = Report::where('unic_id_report', $unicIdReport)->first();
        $idReport = $report['report_ID'];

        // Salvar as imagens dos objetos no banco de dados
        if ($request->hasFile('images2')) {
            $typeImage = 'image2';
            $images = $this->imageUpload($request->file('images2'), 'image', $unicIdReport, $typeImage);
            $dataReport->photos()->createMany($images);
        }


        // Salvar as imagens da ocorrência no banco de dados
        if ($request->hasFile('images1')) {
            $typeImage = 'image1';
            $images = $this->imageUpload($request->file('images1'), 'image', $unicIdReport, $typeImage);
            $dataReport->photos()->createMany($images);
        }

        // Armazenar $data na sessão
        Session::put('data', $data);
        
        //return redirect('report/detailed');
        return redirect()->route('generateReport', ['id' => $idReport]);

    }

    public function removeLetterEndOfWord($unit_measure, $letterToRemove) {
        // Divide a string em palavras
        $words = explode(' ', $unit_measure);
    
        // Itera sobre cada palavra e remove a letra do final
        foreach ($words as &$word) {
            // Verifica se a palavra termina com a letra a ser removida
            while (substr($word, -1) == $letterToRemove) {
                // Remove a última letra da palavra
                $word = substr($word, 0, -1);
            }
        }
    
        // Junta as palavras novamente
        $resultString = implode(' ', $words);
        return $resultString;
    }


    public function selectSearch(Request $request)
    {
        $articles = Infraction::where('article', 'LIKE', '%' . $request->searchItem . '%')
            ->paginate(10, ['*'], 'page', $request->page);

        return response()->json([
            'data' => $articles->items(),
            'pagination' => [
                'more' => $articles->hasMorePages(),
            ],
        ]);
    }


    public function boSelect2(Request $request)
    {
        $articles = InfractionBO::where('article', 'LIKE', '%' . $request->searchItem . '%')
            ->paginate(10, ['*'], 'page', $request->page);

        return response()->json([
            'data' => $articles->items(),
            'pagination' => [
                'more' => $articles->hasMorePages(),
            ],
        ]);
    }

    private function calculateFineValue($data, $infraction) 
    {
        // Recebe o tamanho do desmatamento e separa a parte inteira, verifica se tem fração e define o valor da multa.
        $data['size_deforestation_fraction'] = null;
        /* $data['size_deforestation'] = isset($_POST['size_deforestation']) ? $_POST['size_deforestation'] : null;
        $data['quantity_wood'] = isset($_POST['quantity_wood']) ? $_POST['quantity_wood'] : null; */



        if ($data['size_deforestation'] != null) {
            if ($data['size_deforestation'] == intval($data['size_deforestation'])) {
                $data['size_deforestation_intereger'] = $data['size_deforestation'];
                // Verifica se teve uso de fogo e muda valor da multa
                if ($data['use_fire'] == 'noUseFire') {
                    
                    $data['value_infraction'] = $data['size_deforestation_intereger'] * $infraction->value_infraction;
                } else {
                    
                    $data['value_infraction'] = (($data['size_deforestation_intereger'] * $infraction->value_infraction) / 2) + ($data['size_deforestation_intereger'] * $infraction->value_infraction);
                    //$value = ($data['size_deforestation_intereger'] * $infraction->value_infraction) / 2;
                }
            } else { // Se tamanho do desmatamento não for inteiro separa a fração para calcular a multa
                $fraction = explode ('.', floatval($data['size_deforestation']));
                $data['size_deforestation_intereger'] = $fraction[0];
                $data['size_deforestation_fraction'] = $fraction[1];

                if ($data['use_fire'] == 'noUseFire') {

                    $data['value_infraction'] = ($data['size_deforestation_intereger'] * $infraction->value_infraction) + 5000;                
                }else {
                    $normalValue = $data['size_deforestation_intereger'] * $infraction->value_infraction + 5000;
                    $halfValue = $normalValue / 2;
                    $data['value_infraction'] = $normalValue + $halfValue;

                }
                
            }
        } else if ($data['quantity_wood'] != null) {
            $data['value_infraction'] = $data['quantity_wood'] * $infraction->value_infraction;

            // Definir valor null par não dar erro
            $data["size_deforestation_intereger"] = null;
            $data["size_deforestation"] = null;
        }

        return $data;
    }

    private function administrativeTextDeforestation($data, $infraction, $unit_measure_singular) 
    {
        $data['text_embargo'] = '';
            // Se tipo de infração for desmatamento
            if ($infraction->type_AI == 'logging') {
                
                // Não tem uso de fogo
                if ($data['use_fire'] == 'noUseFire') { 



                    $data['text_administrative'] = $infraction->verb . ' ' . $data['size_deforestation'] . ' ' . $data['unit_measure'] . ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . ' ou fração. Para chegar ao valor obtido, foi ' . $infraction->open_fine_text;
                    
                                        
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) { // Se for desmatamento com área inteira
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;

                    }elseif (floatval($data['size_deforestation']) == $data['size_deforestation']) { // Se for desmatamento com área fração                                                
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' mais R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare' . ' totalizando R$' . $valueInfractionFormated;
                    }
                    
                    
                    
                    
                // Agravante com uso de fogo, aumenta pela metadao o valor da multa
                } else { 
                    
                    $data['text_administrative'] = $infraction->verb . ' ' . $data['size_deforestation'] . ' ' . $data['unit_measure']. ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . $infraction->additional_text . ' aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ' . $infraction->open_fine_text;
                    
                    
                    // Recebe o tamanho do desmatamento e separa o valor inteiro e a fração, forma o texto que vai apresentar no relatório.
                    // Se inteiro
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) {
                        // Formata o valor da infração
                        $normalValue = $data['size_deforestation_intereger'] * $infraction->value_infraction;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' aumentado pela metade totalizando R$' . $valueInfractionFormated;
                    } else {
                        // Formata o valor da infração
                        $normalValue = ($data['size_deforestation_intereger'] * $infraction->value_infraction) + 5000;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' = ' . number_format($data["size_deforestation_intereger"] * $infraction->value_infraction, 2, ',', '.') . ' mais R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare = R$ ' . number_format($normalValue, 2, ',', '.') . ' aumentado pela metade totalizando R$ ' . number_format($normalValue + $halfValue, 2, ',', '.');
                    }
                }
                
                
            // Se tipo de infração for madeira
            } elseif ($infraction->type_AI == 'wood') {

                

                $data['text_administrative'] = $infraction->verb . ' ' . $data['quantity_wood'] . ' ' . $data['unit_measure'] . ' de ' . $infraction->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $infraction->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de ' .  $infraction->value_infraction_text .' por ' . $unit_measure_singular . '. Para chegar ao valor obtido, foi ';
                
                
                // Adciona o cálculo ao text_administrative
                $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                $data['text_administrative'] .= 'multiplicado ' . $data['quantity_wood'] . ' vezes R$ '.  number_format($infraction->value_infraction, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;
                
            }

        return $data['text_administrative'];
    }
    

    private function imageUpload($images, $imageColumn = null, $unicIdReport, $typeImage)
    {
        
        $report = Report::where('unic_id_report', $unicIdReport)->first();
        $idReport = $report['report_ID'];
        $uploadedImages = [];

        foreach ($images as $image) {
            $imagePath = $image->store('reports', 'public');

            // Criar o registro de imagem e associar ao relatório
            $photosReport = new PhotosReport([
                'image' => $imagePath,
                'report_report_ID' => $idReport,
                'type_image' => $typeImage
            ]);

            // Salvar o registro de imagem
            $photosReport->save();

            // Adicionar ao array para retornar
            /* $uploadedImages[] = [
                $imageColumn => $imagePath,
                'report_report_ID' => $idReport,
            ]; */
        }

        return $uploadedImages;
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
   /*  public function show($id)
    {
        return view('detailedreport::show');
    } */

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Report::find($id);

        $mitigating_string  = $data['mitigating'];

        $mitigating = explode('*', $mitigating_string);
        //dd($mitigating);
        $mitigatingArray = array();
        foreach ($mitigating as $option) {
            if($option != null) {
                $mitigatingArray[] = $option;
            }
        }

        $aggravating_string  = $data['aggravating'];

        
        $aggravating = explode('*', $aggravating_string);
        //dd($aggravating);
        $aggravatingArray = array();
        foreach ($aggravating as $option) {
            if($option != null) {
                $aggravatingArray[] = $option;
            }
        }

        return view('detailedreport::edit', compact('data', 'mitigatingArray', 'aggravatingArray'));
        //return view('detailedreport::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ReportRequestEdit $request, $id)
    {
        $data = Report::find($id);


        // Update main fields of the Report model
        $data->fill($request->except('mitigating', 'aggravating', 'size_deforestation_intereger', 'size_deforestation_fraction', 'text_embargo'));
        $data->save();
        
        
        // Update mitigating circumstances
        $mitigating = $request->input('mitigating', []);
        $data->mitigating = implode('*', $mitigating);
        $data->save();

        // Update aggravating circumstances
        $aggravating = $request->input('aggravating', []);
        $data->aggravating = implode('*', $aggravating);
        
        $data->save();

        /* if ($data->area_deforestation == 'offReserve') {
            $data->type_deforestation = 'área de vegetação nativa';                    
        }else if ($data->area_deforestation == 'area_deforestation') {
            $data->type_deforestation = 'área de reserva legal';                    
        }else {
            $data->type_deforestation = 'regeneração';
        }
        $data->save(); */

        /* if ($data->article_AI == 'Art. 50' || $data->article_AI == 'Art. 51' ) {
            $data->article_BO = 'Art. 50';
        } else if ($data->article_AI == 'Art. 43') {
            $data->article_BO = 'Art. 38';
        }else if ($data['article_AI'] == 'Art. 48') {
            $article_BO = 'Art. 48';
        } */


        // Recebe o tamanho do desmatamento e separa a parte inteira, verifica se tem fração e define o valor da multa.
        // *******************Mudar para puxar da tabela de infração **********************************
        $fineValue = 5000; 
        // ********************************************************************************
        $fraction = null;
        //$sizeDeforestation = isset($data['size_deforestation']) ? $data['size_deforestation'] : null;
        if ($data->size_deforestation != null) {
            //$data->text_administrative = '';
            
           
            if ($data->size_deforestation== intval($data->size_deforestation)) {
                $data->size_deforestation_intereger = intval($data->size_deforestation);

                // Verificar se teve uso de fogo e muda o valor da multa
                if ($data->use_fire == 'noUseFire') {
                    
                    $data->value_infraction = $data->size_deforestation * $fineValue;
                    if ($data->article_AI == 'Art. 43') {
                        $data->text_administrative = ' desmatar ' .  number_format($data->size_deforestation_intereger, 3, ',', '') . ' hectares de floresta em ' . $data->area_deforestation . ' e em área considerada de preservação permanente, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,00 por hectare ou fração. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } elseif ($data->article_AI == 'Art. 48') {
                        $data->text_administrative = ' impedir ou dificultar a regeneração natural de ' . $data->size_deforestation_intereger . ' hectares de florestas ou demais formas de vegetação, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                    }
                    else {
                        $data->text_administrative = ' desmatar floresta em uma área de ' . number_format($data->size_deforestation_intereger, 3, ',', '') . ' hectares em ' . $data->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';

                    }
                    
                    
                    $valueInfractionFormated = number_format($data->value_infraction, 2, ',', '.');
                    
                    $data->text_administrative .= 'multiplicado ' . $data->size_deforestation_intereger . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' totalizando R$ ' . $valueInfractionFormated;
                    
                } else {
                    $normalValue = $data->size_deforestation * $fineValue;
                    $halfValue = $normalValue / 2;
                    $data->value_infraction = $normalValue + $halfValue;
                    
                    if ($data->article_AI == 'Art. 43') {
                        $data->text_administrative = ' desmatar ' . number_format($data->size_deforestation_intereger, 3, ',', '') . ' hectares de floresta em ' . $data->area_deforestation . ' e em área considerada de preservação permanente com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,00 por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } else if ($data->article_AI == 'Art. 48') {
                        $data->text_administrative = ' impedir ou dificultar a regeneração natural de ' . number_format($data->size_deforestation_intereger, 3, ',', '') . ' hectares de florestas ou demais formas de vegetação com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                    } else {

                        $data->text_administrative = ' desmatar floresta em uma área de ' . number_format($data->size_deforestation_intereger, 3, ',', '') . ' hectares em ' . $data->area_deforestation . 'com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ';
                    }
                    
                    
                    
                    
                    $valueInfractionFormated = number_format($data->value_infraction, 2, ',', '.');
                    
                    $data->text_administrative .= 'multiplicado ' . $data->size_deforestation_intereger . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' = R$' . number_format($normalValue, 2, ',', '.') . ' aumentado pela metade toralizando R$ ' . $data->value_infraction;
                }  
                
                $data->size_deforestation_fraction = null;
                
            } else {

                if ($data->use_fire == 'noUseFire') {
                    
                    //$data->size_deforestation_intereger = $data->size_deforestation;
                    $fraction = explode ('.', floatval($data->size_deforestation));
                    
                    $data->size_deforestation_intereger = $fraction[0];
                    $data->size_deforestation_fraction = $fraction[1];
                    
                    $data->value_infraction = ($data->size_deforestation_intereger * $fineValue) + 5000;
                    //$data->value_infraction = $valueInfraction;
                    if ($data->article_AI == 'Art. 43') {
                        $data->text_administrative = ' desmatar ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares de floresta em ' . $data->area_deforestation . ' em área considerada de preservação permanente, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,00 por hectare ou fração. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } else if ($data->article_AI == 'Art. 48') {
                        $data->text_administrative = ' impedir ou dificultar a regeneração natural de ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares de florestas ou demais formas de vegetação, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                    } else {

                        $data->text_administrative = ' desmatar floresta em uma área de ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares em ' . $data->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                    }

                    
                    
                    
                    // Formata o valor da infração
                    $valueInfractionFormated = number_format($data->value_infraction, 2, ',', '.');
                    $data->text_administrative .= 'multiplicado ' . $data->size_deforestation_intereger . ' vezes R$ '.  number_format($fineValue, 2, ',', '.'). ' = ' . number_format(($data->size_deforestation_intereger *$fineValue), 2, ',', '.') . ' mais R$ '.  number_format($fineValue, 2, ',', '.') . ' pela fração 0,' .  $data->size_deforestation_fraction .' hectare' . ' totalizando R$ ' . $valueInfractionFormated;
                    
                } else {
                    // Uso de fogo
                    //$data->size_deforestation_intereger = $data->size_deforestation;
                    $fraction = explode ('.', floatval($data->size_deforestation));
                    
                    $data->size_deforestation_intereger = $fraction[0];
                    $data->size_deforestation_fraction = $fraction[1];
                    $normalValue = ($data->size_deforestation_intereger * $fineValue) + 5000;
                    $halfValue = $normalValue / 2;
                    $data->value_infraction = $normalValue + $halfValue;
                    //$data->value_infraction = $valueInfraction;
                    
                    if ($data->article_AI == 'Art. 43') {
                        $data->text_administrative = ' desmatar ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares de floresta em ' . $data->area_deforestation . ' em área considerada de preservação permanente, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,000 por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } elseif ($data->article_AI == 'Art. 48') {
                        $data->text_administrative = ' impedir ou dificultar a regeneração natural de ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares de florestas ou demais formas de vegetação com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ';
                    } else {

                        $data->text_administrative = ' desmatar floresta em uma área de ' . number_format($data->size_deforestation, 3, ',', '') . ' hectares em ' . $data->area_deforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data->article_AI . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ';
                    }

                    
                    
                    
                    // Formata o valor da infração
                    $valueInfractionFormated = number_format($data->value_infraction, 2, ',', '.');
                    $data->text_administrative .= 'multiplicado ' . $data->size_deforestation_intereger . ' vezes R$ '.  number_format($fineValue, 2, ',', '.'). ' = R$ ' . number_format(($data->size_deforestation_intereger *$fineValue), 2, ',', '.') . ' mais R$ '.  number_format($fineValue, 2, ',', '.') . ' pela fração 0,' .  $data->size_deforestation_fraction .' hectare = R$ ' . number_format($normalValue, 2, ',', '.') . ' aumentado pela metade totalizando R$ ' . $valueInfractionFormated;
                }
                
                
            }
            
        }

         
        
        $data->text_embargo = 'A área embargada é de <strong>' . number_format($data->size_deforestation, 3, ',', '') . '</strong>  hectares de floresta nativa em ' . $data->area_deforestation . ', conforme Termo de Embargo Nº <strong>' . $data->number_embargo . '</strong>, para que a área suprimida se regenere.';
        
        $id_usuario = auth()->id();

        $data->id_user_last_updated_at = $id_usuario;

        $data->save();
        
        // Upload das fotos da ocorrência
        if ($request->hasFile('images1')) {
            $typeImage = 'image1';
            $this->deletePhotos($data->report_ID, $typeImage);
            $images = $this->imageUpload($request->file('images1'), 'image', $data['unic_id_report'], $typeImage);
            $data->photos()->createMany($images);
        }
        // Upload das fotos da apreensão
        if ($request->hasFile('images2')) {
            $typeImage = 'image2';
            $this->deletePhotos($data->report_ID, $typeImage);
            $images = $this->imageUpload($request->file('images2'), 'image', $data['unic_id_report'], $typeImage);
            $data->photos()->createMany($images);
        }

        //return redirect()->route('editReport', ['id' => $data->report_ID]);
        //return redirect('/report/detailed');
        return redirect()->route('generateReport', ['id' => $data->report_ID]);
    }

    private function deletePhotos($reportId, $typeImage)
    {
        // Get photos associated with the report ID
        $photos = PhotosReport::where('report_report_ID', $reportId)
                     ->where('type_image', $typeImage)
                     ->get();


        foreach ($photos as $photo) {
            // Delete from storage
            Storage::disk('public')->delete($photo->image);

            // Delete from database
            $photo->delete();
        }
    }  




    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $reports = Report::find($id);
        //$photos = PhotosReport::where('report_report_ID', $id)->get(); // Exclusão do arquivo perde tudo
        $photos = PhotosReport::where('report_report_ID', $id)->get();
        

        // Exclusão do arquivo perde tudo
       /*  foreach ($photos as $photo) {           
            
            if (Storage::disk('public')->exists($photo->image)) {
                Storage::disk('public')->delete($photo->image);
            }
        } */
        
        foreach ($photos as $photo) {
            $photo->delete();
        }

        $reports->delete();

        $id_usuario = auth()->id();

        $reports->id_user_deleted_at = $id_usuario;

        $reports->save();

        return redirect()->back();

    }
}

