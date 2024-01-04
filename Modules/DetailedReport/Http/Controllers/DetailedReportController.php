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
use Modules\DetailedReport\Models\PhotosReport;
use Modules\DetailedReport\Models\Report;
use Illuminate\Support\Facades\Storage;

class DetailedReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $perPage = 5;
        $reports = Report::paginate(5);
        //dd($reports);
        
        return view('detailedreport::index', compact('reports'));
    }

    public function show($id)
    {   
        
        $data = Report::find($id);
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
        // Mudar artigo in-verbis
        if ($data->article_AI == 'Art. 51') {
            $data['article_administrive'] = 'Art. 51.  Destruir, desmatar, danificar ou explorar floresta ou qualquer tipo de vegetação nativa ou de espécies nativas plantadas, em área de reserva legal ou servidão florestal, de domínio público ou privado, sem autorização prévia do órgão ambiental competente ou em desacordo com a concedida: (Redação dada pelo Decreto nº 6.686, de 2008). Multa de R$ 5.000,00 (cinco mil reais) por hectare ou fração.';

            $data['article_criminal'] = 'Art. 50. Destruir ou danificar florestas nativas ou plantadas ou vegetação fixadora de dunas, protetora de mangues, objeto de especial preservação:

            Pena - detenção, de três meses a um ano, e multa.';
        

        
        } elseif ($data->article_AI == 'Art. 50') {
            $data['article_administrive'] = 'Art. 50.  Destruir ou danificar florestas ou qualquer tipo de vegetação nativa ou de espécies nativas plantadas, objeto de especial preservação, sem autorização ou licença da autoridade ambiental competente: Multa de R$ 5.000,00 (cinco mil reais) por hectare ou fração.';

            $data['article_criminal'] = 'Art. 50. Destruir ou danificar florestas nativas ou plantadas ou vegetação fixadora de dunas, protetora de mangues, objeto de especial preservação:

                    Pena - detenção, de três meses a um ano, e multa.';
        } elseif ($data->article_AI == 'Art. 43') {
            $data['article_administrive'] = 'Art. 43.  Destruir ou danificar florestas ou demais formas de vegetação natural ou utilizá-las com infringência das normas de proteção em área considerada de preservação permanente, sem autorização do órgão competente, quando exigível, ou em desacordo com a obtida: (Redação dada pelo Decreto nº 6.686, de 2008). Multa de R$ 5.000,00 (cinco mil reais) a R$ 50.000,00 (cinqüenta mil reais), por hectare ou fração.';

            $data['article_criminal'] = 'Art. 38. Destruir ou danificar floresta considerada de preservação permanente, mesmo que em formação, ou utilizá-la com infringência das normas de proteção: Pena - detenção, de um a três anos, ou multa, ou ambas as penas cumulativamente.';
        }

        /* if ($data->article_BO == 'Art. 50') {
            $data['article_criminal'] = 'Art. 50. Destruir ou danificar florestas nativas ou plantadas ou vegetação fixadora de dunas, protetora de mangues, objeto de especial preservação:

                Pena - detenção, de três meses a um ano, e multa.';
            } elseif ($data->article_BO == 'Art. 38') {
            $data['article_criminal'] = 'Art. 38. Destruir ou danificar floresta considerada de preservação permanente, mesmo que em formação, ou utilizá-la com infringência das normas de proteção: Pena - detenção, de um a três anos, ou multa, ou ambas as penas cumulativamente.';

        } */

        
        
        /* //$data['photosBased'] = $photosBased;
        $cpf = $data['cpf'];
        $formatCPF =  $this->formatCPF($cpf);

        $phone = $data['phone'];
        $formatPhone =  $this->formatPhone($phone);

        $birthday = $data['birthday'];
        $formatBirthday =  $this->formatBirth($birthday); */

        
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
        return view('detailedreport::create');
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function store(ReportRequest $request)
    {
        $data = array();
        
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            // Salva os logos base64 na tabela - Necessário somente para geração do PDF
            $pathLogo1 = public_path('images/logo1.png');
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
            $data['logo3'] = isset($base64Logo3) ? $base64Logo3 : null;
            
            // Recebe o numero da ocorrência
            $data['number_BO'] = isset($_POST['number_BO']) ? $_POST['number_BO'] : null;
            // Recebe o tipo da ocorrência
            $data['type_BO'] = isset($_POST['type_BO']) ? $_POST['type_BO'] : null;
            // Recebe o numero do auto de infração
            $data['number_AI'] = isset($_POST['number_AI']) ? $_POST['number_AI'] : null;
            // Recebe o valor do auto de infração - Verificar se é necessário
            $data['value_AI'] = isset($_POST['value_AI']) ? $_POST['value_AI'] : null;
            // Recebe o artigo do auto de infração
            $data['article_AI'] = isset($_POST['article_AI']) ? $_POST['article_AI'] : null;
            // Recebe o artigo da ocorrência
            $data['article_BO'] = isset($_POST['article_BO']) ? $_POST['article_BO'] : null;
            // Recebe o tipo do AI se é Desmatamento ou Madeira
            $data['selectTypeAI'] = isset($_POST['selectTypeAI']) ? $_POST['selectTypeAI'] : null;

            $data['use_fire'] = isset($_POST['use_fire']) ? $_POST['use_fire'] : null;



            // **************Puxar esse valor da tabela de multas ***************
            $fineValue = 5000;

            // Recebe o tamanho do desmatamento e separa a parte inteira, verifica se tem fração e define o valor da multa.
            $data['size_deforestation_fraction'] = null;
            $data['size_deforestation'] = isset($_POST['size_deforestation']) ? $_POST['size_deforestation'] : null;
            if ($data['size_deforestation'] != null) {
                if ($data['size_deforestation'] == intval($data['size_deforestation'])) {
                    $data['size_deforestation_intereger'] = intval(isset($_POST['size_deforestation']) ? $_POST['size_deforestation'] : null);
                    // Verifica se teve uso de fogo e muda valor da multa
                    if ($data['use_fire'] == 'noUseFire') {
                        
                        $data['value_infraction'] = $data['size_deforestation_intereger'] * $fineValue;
                    } else {
                        
                        $data['value_infraction'] = (($data['size_deforestation_intereger'] * $fineValue) / 2) + ($data['size_deforestation_intereger'] * $fineValue);
                        //$value = ($data['size_deforestation_intereger'] * $fineValue) / 2;
                    }
                } else {
                    $fraction = explode ('.', floatval($data['size_deforestation']));
                    $data['size_deforestation_intereger'] = $fraction[0];
                    $data['size_deforestation_fraction'] = $fraction[1];

                    if ($data['use_fire'] == 'noUseFire') {

                        $data['value_infraction'] = ($data['size_deforestation_intereger'] * $fineValue) + 5000;                
                    }else {
                        $normalValue = $data['size_deforestation_intereger'] * $fineValue + 5000;
                        $halfValue = $normalValue / 2;
                        $data['value_infraction'] = $normalValue + $halfValue;

                    }
                    
                }
            }
            
            // Recebe o tipo de desmatamento ex. Reserva Legal
            $data['area_deforestation'] = isset($_POST['area_deforestation']) ? $_POST['area_deforestation'] : null;
            // Recebe o numero do termo de embargo
            $data['number_embargo'] = ($_POST['number_embargo'] !== '') ? $_POST['number_embargo'] : null;

            // Recebe o numero da Carta imagem
            $data['number_letter'] = isset($_POST['number_letter']) ? $_POST['number_letter'] : null;


            // Quando for implantar tipo madeira
            // Recebe a quantidade de madeira apreendida
            $data['inputQuantityWood'] = isset($_POST['inputQuantityWood']) ? $_POST['inputQuantityWood'] : null;
            // Recebe o numero da planilha de madeira serrada
            $data['inputLumber'] = isset($_POST['inputLumber']) ? $_POST['inputLumber'] : null;
            // Recebe o numero da planilha de madeira in-natura
            $data['inputNaturalWood'] = isset($_POST['inputNaturalWood']) ? $_POST['inputNaturalWood'] : null;


            // Recebe o numero do termo de apreensão
            $data['term_seizure'] = isset($_POST['term_seizure']) ? $_POST['term_seizure'] : null;
            // Recebe os objetos apreendidos
            $data['seized_objects'] = isset($_POST['seized_objects']) ? $_POST['seized_objects'] : null;
            // Recebe o local onde foi depositado os objetos
            $data['deposit_location'] = isset($_POST['deposit_location']) ? $_POST['deposit_location'] : null;
            // Recebe os dados do fiel depositário
            $data['name_faithful'] = isset($_POST['name_faithful']) ? $_POST['name_faithful'] : null;
            // Recebe os dados do responsável pelo recebimento dos materiais
            $data['name_responsible'] = isset($_POST['name_responsible']) ? $_POST['name_responsible'] : null;
             // Verifica se foi carregado imagens salva para carregar no pdf
             if($request->hasFile('images2')) {
                $data['imageObjects1'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][0]));
                $data['imageObjects2'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][1]));
                $data['imageObjects3'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][2]));
                $data['imageObjects4'] = base64_encode(file_get_contents($_FILES['images2']['tmp_name'][3]));
            }
            // Recebe os dados do envolvido
            $data['name'] = isset($_POST['name']) ? $_POST['name'] : null;
            $data['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : null;
            $data['rg'] = isset($_POST['rg']) ? $_POST['rg'] : null;
            $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : null;

            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : null;
            /* dd($dataBirthday);
            $formattedBirthday = \DateTime::createFromFormat('dmY', $dataBirthday)->format('Y-m-d'); */


            $data['affiliation'] = isset($_POST['affiliation']) ? $_POST['affiliation'] : null;
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : null;
            $data['location'] = isset($_POST['location']) ? $_POST['location'] : null;
            // Recebe o histórico
            $data['historic'] = isset($_POST['historic']) ? $_POST['historic'] : null;
            // Verifica se foi carregado imagens salva para carregar no pdf
            if ($request->hasFile('images1')) {
                $data['image1'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][0]));
                $data['image2'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][1]));
                $data['image3'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][2]));
                $data['image4'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][3]));
            }

            //dd($request->hasFile('image1'));
            // Recebe o motivo da infração
            $data['motive'] = isset($_POST['motive']) ? $_POST['motive'] : null;
            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            $data['mitigating'] = isset($_POST['mitigating']) ? $_POST['mitigating'] : null;
            $mitigating_string = '';
            if ($data['mitigating'] != null) {
                foreach ($data['mitigating'] as $mitigating) {
                    $mitigating_string .= $mitigating . '*';
                }
            }
            $data['mitigating_string'] = isset($mitigating_string) ? $mitigating_string : null;
            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            $data['aggravating'] = isset($_POST['aggravating']) ? $_POST['aggravating'] : null;
            $aggravating_string = '';
            if ($data['aggravating'] != null) {
                foreach ($data['aggravating'] as $aggravating) {
                    $aggravating_string .= $aggravating . '*';
                }
            }
            $data['aggravating_string'] = isset($aggravating_string) ? $aggravating_string : null;
            // Recebe os dados da equipe
            $data['name_CMT'] = isset($_POST['name_CMT']) ? $_POST['name_CMT'] : null;
            $data['name_MOT'] = isset($_POST['name_MOT']) ? $_POST['name_MOT'] : null;
            $data['name_PTR1'] = isset($_POST['name_PTR1']) ? $_POST['name_PTR1'] : null;
            $data['name_PTR2'] = isset($_POST['name_PTR2']) ? $_POST['name_PTR2'] : null;
            $data['name_PTR3'] = isset($_POST['name_PTR3']) ? $_POST['name_PTR3'] : null;
            $data['unit_CMT'] = isset($_POST['unit_CMT']) ? $_POST['unit_CMT'] : null;
            $data['unit_MOT'] = isset($_POST['unit_MOT']) ? $_POST['unit_MOT'] : null;
            $data['unit_PTR1'] = isset($_POST['unit_PTR1']) ? $_POST['unit_PTR1'] : null;
            $data['unit_PTR2'] = isset($_POST['unit_PTR2']) ? $_POST['unit_PTR2'] : null;
            $data['unit_PTR3'] = isset($_POST['unit_PTR3']) ? $_POST['unit_PTR3'] : null;

            
            $data['type_AI'] = isset($_POST['type_AI']) ? $_POST['type_AI'] : null;
            //dd($_POST['type_AI']);
            // Verifica se o usuário selecionou Desmatamento ou Madeira e formatar o texto conforme selecionado
            $data['text_embargo'] = '';
            if ($data['type_AI'] == 'logging') {
                /* if ($data['area_deforestation'] == 'offReserve') {
                    $type_deforestation = 'área de vegetação nativa';                    
                }else if ($data['area_deforestation'] == 'area_deforestation') {
                    $type_deforestation = 'área de reserva legal';                    
                }else {
                    $type_deforestation = 'regeneração';
                } */

                if ($data['use_fire'] == 'noUseFire') {

                    if ($data['article_AI'] == 'Art. 43') {
                        $data['text_administrative'] = ' desmatar ' .  number_format($data["size_deforestation"], 3, ',', '') . ' hectares de floresta em ' . $data['area_deforestation'] . ' e em área considerada de preservação permanente, sem autorização prévia do órgão ambiental competente, conforme o ' . $data["article_AI"] . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,00 por hectare ou fração. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } else {

                        $data['text_administrative'] = ' desmatar ' . number_format($data["size_deforestation"], 3, ',', '') . ' hectares de floresta em ' . $data['area_deforestation'] . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data["article_AI"] . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                    }
                    
                    
                    
                    // Recebe o tamanho do desmatamento e separa o valor inteiro e a fração, forma o texto que vai apresentar no relatório.
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) {
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;
                    } else {
                        // Formata o valor da infração
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' mais R$ '.  number_format($fineValue, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare' . ' totalizando R$' . $valueInfractionFormated;
                    }

                } else {
                    if ($data['article_AI'] == 'Art. 43') {
                        $data['text_administrative'] = ' desmatar ' .  number_format($data["size_deforestation"], 3, ',', '') . ' hectares de floresta em ' . $data['area_deforestation'] . ' em área considerada de preservação permanente com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data["article_AI"] . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' a R$ 50.000,00 por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido foi utilizado a instrução IN 19/2023 do IBAMA para definir o valor mínimo por hectare, ';
                    } else {

                        $data['text_administrative'] = ' desmatar ' .  number_format($data["size_deforestation"], 3, ',', '') . ' hectares de floresta em ' . $data['area_deforestation'] . ' com uso de fogo, sem autorização prévia do órgão ambiental competente, conforme o ' . $data["article_AI"] . ' combinado com Art. 60-I do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração, aumentado pela metade quando a infração for consumada mediante uso de fogo ou provocação de incêndio. Para chegar ao valor obtido, foi ';
                    }
                    
                    
                    // Recebe o tamanho do desmatamento e separa o valor inteiro e a fração, forma o texto que vai apresentar no relatório.
                    // Se inteiro
                    if (intval($data['size_deforestation']) == $data['size_deforestation']) {
                        // Formata o valor da infração
                        $normalValue = $data['size_deforestation_intereger'] * $fineValue;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' aumentado pela metade totalizando R$' . $valueInfractionFormated;
                    } else {
                        // Formata o valor da infração
                        $normalValue = ($data['size_deforestation_intereger'] * $fineValue) + 5000;
                        $halfValue = $normalValue / 2;
                        $valueInfractionFormated = number_format($normalValue + $halfValue, 2, ',', '.');
                        $valueInfractionFormated = number_format($data["value_infraction"], 2, ',', '.');
                        $data['text_administrative'] .= 'multiplicado ' . $data["size_deforestation_intereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' mais R$ '.  number_format($fineValue, 2, ',', '.') . ' pela fração 0,' .  $data["size_deforestation_fraction"] .' hectare = R$ ' . number_format($normalValue, 2, ',', '.') . ' aumentado pela metade totalizando R$ ' . number_format($normalValue + $halfValue, 2, ',', '.');
                    }
                }
                
                $data['text_embargo'] = 'A área embargada é de <strong>' .  number_format($data["size_deforestation"], 3, ',', '') . '</strong>  hectares de floresta em ' . $data['area_deforestation'] . ', conforme Termo de Embargo Nº <strong>' . $data['number_embargo'] . '</strong>, para que a área suprimida se regenere.';              
            } else {
                $data['text_administrative'] = 'Em Desenvolvimento';
            }
        } else {
            dd('Formuário não enviado');
        }

        // Verifica qual artigo administrativo foi selecionado e seleciona o criminal

        if ($data['article_AI'] == 'Art. 50' || $data['article_AI'] == 'Art. 51' ) {
            $article_BO = 'Art. 50';
        } else if ($data['article_AI'] == 'Art. 43') {
            $article_BO = 'Art. 38';
        }



        //Cria um id único para o relatório
        $unicIdReport = rand();
        // Salva os dados na tabela reports
        $dataReport = Report::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'phone' => $data['phone'],
            'birthday' =>  $data['birthday'] ,
            'affiliation' => $data['affiliation'],
            'address' => $data['address'],
            'location' => $data['location'],            
            'historic' => $data['historic'],
            'number_BO' => $data['number_BO'],
            'type_BO' => $data['type_BO'],
            'article_BO' => $article_BO,
            'number_AI' => $data['number_AI'],
            'value_AI' => $data['value_AI'],
            'article_AI' => $data['article_AI'],
            'type_AI' => $data['type_AI'],
            'use_fire' => $data['use_fire'],
            'size_deforestation' => $data['size_deforestation'],
            'size_deforestation_intereger' => $data['size_deforestation_intereger'],
            'size_deforestation_fraction' => $data['size_deforestation_fraction'],
            //'type_deforestation' => $data['selectTypeAI'],
            'area_deforestation' => $data['area_deforestation'],
            'value_infraction' => $data['value_infraction'],
            'number_embargo' => $data['number_embargo'],
            'number_letter' => $data['number_letter'],
            'text_administrative' => $data['text_administrative'],
            'text_embargo' => $data['text_embargo'],
            'motive' => $data['motive'],
            'mitigating' => $data['mitigating_string'],
            'aggravating' => $data['aggravating_string'],
            'name_CMT' => $data['name_CMT'],
            'name_MOT' => $data['name_MOT'],
            'name_PTR1' => $data['name_PTR1'],
            'name_PTR2' => $data['name_PTR2'],
            'name_PTR3' => $data['name_PTR3'],
            'unit_CMT' => $data['unit_CMT'],
            'unit_MOT' => $data['unit_MOT'],
            'unit_PTR1' => $data['unit_PTR1'],
            'unit_PTR2' => $data['unit_PTR2'],
            'unit_PTR3' => $data['unit_PTR3'],
            'unic_id_report' => $unicIdReport,
            'term_seizure' => $data['term_seizure'],
            'seized_objects' => $data['seized_objects'],
            'deposit_location' => $data['deposit_location'],
            'name_faithful' => $data['name_faithful'],
            'name_responsible' => $data['name_responsible'],
        ]);

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
        //generateReport
        return redirect()->route('generateReport', ['id' => $idReport]);

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
    public function update(Request $request, $id)
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

        if ($data->article_AI == 'Art. 50' || $data->article_AI == 'Art. 51' ) {
            $data->article_BO = 'Art. 50';
        } else if ($data->article_AI == 'Art. 43') {
            $data->article_BO = 'Art. 38';
        }


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
                    } else {
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
        //
    }
}
