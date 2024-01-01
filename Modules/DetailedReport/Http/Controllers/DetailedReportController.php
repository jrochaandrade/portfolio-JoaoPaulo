<?php

namespace Modules\DetailedReport\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
//use PDF;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Dompdf\Options;
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

        if ($mitigatingString = $data['mitigating']) {

            $mitigatingString = $data['mitigating'];
            
            $mitigatingExplode = explode('*', $mitigatingString);
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
        
        
        if ($aggravatingString = $data['aggravating']) {
            $aggravatingString = $data['aggravating'];
            
            $aggravatingExplode = explode('*', $aggravatingString);
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

        foreach ($photosReport as $photo) {
            $caminhoImagem = '/' . $photo['image'];

            // Obter a URL da imagem
            $urlImagem = Storage::url($caminhoImagem);
            
            // Carregar o conteúdo da imagem da URL
            $conteudoImagem = file_get_contents(public_path('storage/' . $caminhoImagem));
            
            // Converter o conteúdo da imagem para base64
            $imagemBase64 = base64_encode($conteudoImagem);

            // Atribuir à variável de dados
            $data['image' . ($i + 1)] = $imagemBase64;

            $i++;
        }


        //$data['photosBased'] = $photosBased;

        
        //dd($data);
        return view('detailedreport::report', compact('data'));
    }

    public function generatePdf() 
    {
    $data = Session::get('data', []);
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
    public function store(Request $request)
    {
        $data = array();
        
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
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
            
            // Recebe o numero da ocorrência
            $data['inputBO'] = isset($_POST['inputBO']) ? $_POST['inputBO'] : null;
            // Recebe o tipo da ocorrência
            $data['typeBO'] = isset($_POST['typeBO']) ? $_POST['typeBO'] : null;
            // Recebe o numero do auto de infração
            $data['inputAI'] = isset($_POST['inputAI']) ? $_POST['inputAI'] : null;
            // Recebe o valor do auto de infração - Verificar se é necessário
            $data['valueAI'] = isset($_POST['valueAI']) ? $_POST['valueAI'] : null;
            // Recebe o artigo do auto de infração
            $data['articleAI'] = isset($_POST['articleAI']) ? $_POST['articleAI'] : null;
            // Recebe o artigo da ocorrência
            $data['articleBO'] = isset($_POST['articleBO']) ? $_POST['articleBO'] : null;
            // Recebe o tipo do AI se é Desmatamento ou Madeira
            $data['selectTypeAI'] = isset($_POST['selectTypeAI']) ? $_POST['selectTypeAI'] : null;


            // **************Puxar esse valor da tabela de multas ***************
            $fineValue = 5000;

            // Recebe o tamanho do desmatamento e separa a parte inteira, verifica se tem fração e define o valor da multa.
            $data['sizeFraction'] = null;
            $data['inputDeforestationSize'] = isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null;
            if ($data['inputDeforestationSize'] != null) {
                if ($data['inputDeforestationSize'] == intval($data['inputDeforestationSize'])) {
                    $data['sizeIntereger'] = intval(isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null);
                    $data['valueInfraction'] = $data['sizeIntereger'] * $fineValue;
                } else {
                    $fraction = explode ('.', floatval($data['inputDeforestationSize']));
                    $data['sizeIntereger'] = $fraction[0];
                    $data['sizeFraction'] = $fraction[1];

                    $data['valueInfraction'] = ($data['sizeIntereger'] * $fineValue) + 5000;                
                }
            }
            
            // Recebe o tipo de desmatamento ex. Reserva Legal
            $data['reserve'] = isset($_POST['reserve']) ? $_POST['reserve'] : null;
            // Recebe o numero do termo de embargo
            $data['inputEmbargo'] = isset($_POST['inputEmbargo']) ? $_POST['inputEmbargo'] : null;
            // Recebe o numero da Carta imagem
            $data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;


            // Quando for implantar tipo madeira
            // Recebe a quantidade de madeira apreendida
            $data['inputQuantityWood'] = isset($_POST['inputQuantityWood']) ? $_POST['inputQuantityWood'] : null;
            // Recebe o numero da planilha de madeira serrada
            $data['inputLumber'] = isset($_POST['inputLumber']) ? $_POST['inputLumber'] : null;
            // Recebe o numero da planilha de madeira in-natura
            $data['inputNaturalWood'] = isset($_POST['inputNaturalWood']) ? $_POST['inputNaturalWood'] : null;


            // Recebe o numero do termo de embargo
            $data['inputTermo'] = isset($_POST['inputTermo']) ? $_POST['inputTermo'] : null;
            // Recebe os objetos apreendidos
            $data['inputSeizedObjects'] = isset($_POST['inputSeizedObjects']) ? $_POST['inputSeizedObjects'] : null;
            // Recebe o local onde foi depositado os objetos
            $data['inputDepositLocation'] = isset($_POST['inputDepositLocation']) ? $_POST['inputDepositLocation'] : null;
            // Recebe os dados do fiel depositário
            $data['inputNameFaithful'] = isset($_POST['inputNameFaithful']) ? $_POST['inputNameFaithful'] : null;
            // Recebe os dados do responsável pelo recebimento dos materiais
            $data['inputNameresponsible'] = isset($_POST['inputNameresponsible']) ? $_POST['inputNameresponsible'] : null;
            // Recebe os dados do envolvido
            $data['name'] = isset($_POST['name']) ? $_POST['name'] : null;
            $data['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : null;
            $data['rg'] = isset($_POST['rg']) ? $_POST['rg'] : null;
            $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : null;
            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : null;
            $data['affiliation'] = isset($_POST['affiliation']) ? $_POST['affiliation'] : null;
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : null;
            $data['location'] = isset($_POST['location']) ? $_POST['location'] : null;
            // Recebe o histórico
            $data['historic'] = isset($_POST['historic']) ? $_POST['historic'] : null;
            // Verifica se foi carregado imagens
            if($request->hasFile('image1')) {
                $data['image1'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][0]));
                $data['image2'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][1]));
                $data['image3'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][2]));
                $data['image4'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][3]));
            }
            // Recebe o motivo da infração
            $data['motive'] = isset($_POST['motive']) ? $_POST['motive'] : null;
            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            $data['mitigating'] = isset($_POST['mitigating']) ? $_POST['mitigating'] : null;
            $mitigatingString = '';
            if ($data['mitigating'] != null) {
                foreach ($data['mitigating'] as $mitigating) {
                    $mitigatingString .= $mitigating . '*';
                }
            }
            $data['mitigatingString'] = isset($mitigatingString) ? $mitigatingString : null;
            // Verifica se as agravantes recebeu algum valor e salva todas em uma string separada por *
            $data['aggravating'] = isset($_POST['aggravating']) ? $_POST['aggravating'] : null;
            $aggravatingString = '';
            if ($data['aggravating'] != null) {
                foreach ($data['aggravating'] as $aggravating) {
                    $aggravatingString .= $aggravating . '*';
                }
            }
            $data['aggravatingString'] = isset($aggravatingString) ? $aggravatingString : null;
            // Recebe os dados da equipe
            $data['cmt'] = isset($_POST['cmt']) ? $_POST['cmt'] : null;
            $data['mot'] = isset($_POST['mot']) ? $_POST['mot'] : null;
            $data['ptr1'] = isset($_POST['ptr1']) ? $_POST['ptr1'] : null;
            $data['ptr2'] = isset($_POST['ptr2']) ? $_POST['ptr2'] : null;
            $data['ptr3'] = isset($_POST['ptr3']) ? $_POST['ptr3'] : null;
            $data['unitCmt'] = isset($_POST['unitCmt']) ? $_POST['unitCmt'] : null;
            $data['unitMot'] = isset($_POST['unitMot']) ? $_POST['unitMot'] : null;
            $data['unitPtr1'] = isset($_POST['unitPtr1']) ? $_POST['unitPtr1'] : null;
            $data['unitPtr2'] = isset($_POST['unitPtr2']) ? $_POST['unitPtr2'] : null;
            $data['unitPtr3'] = isset($_POST['unitPtr3']) ? $_POST['unitPtr3'] : null;
            // Verifica se o usuário selecionou Desmatamento ou Madeira e formatar o texto conforme selecionado
            $data['textEmbargo'] = '';
            if ($data['selectTypeAI'] == 'logging') {
                if ($data['reserve'] == 'offReserve') {
                    $typeDeforestation = 'área de vegetação nativa';                    
                }else if ($data['reserve'] == 'reserve') {
                    $typeDeforestation = 'área de reserva legal';                    
                }else {
                    $typeDeforestation = 'regeneração';
                }
                
                $data['administrative'] = ' desmatar floresta nativa em uma área de ' . $data["inputDeforestationSize"] . ' hectares em ' . $typeDeforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data["articleAI"] . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ ' .  number_format($fineValue, 2, ',', '.') .' por hectare ou fração. Para chegar ao valor obtido, foi ';
                
                
                // Recebe o tamanho do desmatamento e separa o valor inteiro e a fração, forma o texto que vai apresentar no relatório.
                if (intval($data['inputDeforestationSize']) == $data['inputDeforestationSize']) {
                    // Formata o valor da infração
                    $valueInfractionFormated = number_format($data["valueInfraction"], 2, ',', '.');
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' totalizando R$' . $valueInfractionFormated;
                } else {
                    // Formata o valor da infração
                    $valueInfractionFormated = number_format($data["valueInfraction"], 2, ',', '.');
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ '.  number_format($fineValue, 2, ',', '.') . ' mais R$ '.  number_format($fineValue, 2, ',', '.') . ' pela fração 0,' .  $data["sizeFraction"] . ' totalizando R$' . $valueInfractionFormated;
                }
                $data['textEmbargo'] = 'A área embargada é de <strong>' . $data['inputDeforestationSize'] . '</strong>  hectares de floresta nativa em ' . $typeDeforestation . ', conforme Termo de Embargo de Nº <strong>' . $data['inputEmbargo'] . '</strong>, para que a área suprimida se regenere.';              
            } else {
                $data['administrative'] = 'Em Desenvolvimento';
            }
        } else {
            dd('Formuário não enviado');
        }
        //Cria um id único para o relatório
        $unicIdReport = rand();
        // Salva os dados na tabela reports
        $dataReport = Report::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'affiliation' => $data['affiliation'],
            'address' => $data['address'],
            'location' => $data['location'],            
            'historic' => $data['historic'],
            'number_BO' => $data['inputBO'],
            'type_BO' => $data['typeBO'],
            'article_BO' => $data['articleBO'],
            'number_AI' => $data['inputAI'],
            'value_AI' => $data['valueAI'],
            'article_AI' => $data['articleAI'],
            'type_AI' => $data['selectTypeAI'],
            'size_deforestation' => $data['inputDeforestationSize'],
            'size_deforestation_intereger' => $data['sizeIntereger'],
            'size_deforestation_fraction' => $data['sizeFraction'],
            'area_deforestation' => $data['reserve'],
            'number_embargo' => $data['inputEmbargo'],
            'number_letter' => $data['inputImageLetter'],
            'text_administrative' => $data['administrative'],
            'text_embargo' => $data['textEmbargo'],
            'motive' => $data['motive'],
            'mitigating' => $data['mitigatingString'],
            'aggravating' => $data['aggravatingString'],
            'name_CMT' => $data['cmt'],
            'name_MOT' => $data['mot'],
            'name_PTR1' => $data['ptr1'],
            'name_PTR2' => $data['ptr2'],
            'name_PTR3' => $data['ptr3'],
            'unit_CMT' => $data['unitCmt'],
            'unit_MOT' => $data['unitMot'],
            'unit_PTR1' => $data['unitPtr1'],
            'unit_PTR2' => $data['unitPtr2'],
            'unit_PTR3' => $data['unitPtr3'],
            'unic_id_report' => $unicIdReport,
            'term_seizure' => $data['inputTermo'],
            'seized_objects' => $data['inputSeizedObjects'],
            'deposit_location' => $data['inputDepositLocation'],
            'name_faithful' => $data['inputNameFaithful'],
            'name_responsible' => $data['inputNameresponsible'],
            'value_infraction' => $data['valueInfraction']
        ]);

        $report = Report::where('unic_id_report', $unicIdReport)->first();
        $idReport = $report['report_ID'];




        // Salvar as imagens no banco de dados
        if ($request->hasFile('images1')) {
            $images = $this->imageUpload($request->file('images1'), 'image', $unicIdReport);
            $dataReport->photos()->createMany($images);
        }
        // Armazenar $data na sessão
        Session::put('data', $data);       
        
        //return redirect('report/detailed');
        //generateReport
        return redirect()->route('generateReport', ['id' => $idReport]);

    }

    /* private function imageUpload($images, $imageColumn = null, $unicIdReport)
    {

        $report = Report::where('unic_id_report', $unicIdReport)->first();
        $idReport = $report['report_ID'];
        $uploadedImages = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                $uploadedImages[] = [
                    $imageColumn => $image->store('reports', 'public'),
                    
                ];
                $photosReport = new PhotosReport([
                    'report_report_ID' => $idReport,
                ]);
                $photosReport->save();
            }
        } else {
            $uploadedImages = [
                $imageColumn => $images->store('photo', 'public'),
                
            ];
            $photosReport = new PhotosReport([
                'report_report_ID' => $idReport,
            ]);
            $photosReport->save();
        }

        return $uploadedImages;
    } */

    private function imageUpload($images, $imageColumn = null, $unicIdReport)
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

        $mitigatingString  = $data['mitigating'];

        $mitigating = explode('*', $mitigatingString);
        //dd($mitigating);
        $mitigatingArray = array();
        foreach ($mitigating as $option) {
            if($option != null) {
                $mitigatingArray[] = $option;
            }
        }

        $aggravatingString  = $data['aggravating'];

        
        $aggravating = explode('*', $aggravatingString);
        //dd($aggravating);
        $aggravatingArray = array();
        foreach ($aggravating as $option) {
            if($option != null) {
                $aggravatingArray[] = $option;
            }
        }
        //dd($mitigatingArray);
        //dd($aggravatingArray);

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
        $data->fill($request->except('mitigating', 'aggravating'));
        $data->save();

        // Update mitigating circumstances
        $mitigating = $request->input('mitigating', []);
        $data->mitigating = implode('*', $mitigating);
        $data->save();

        // Update aggravating circumstances
        $aggravating = $request->input('aggravating', []);
        $data->aggravating = implode('*', $aggravating);
        $data->save();

        
        
        // Upload new photos
        if ($request->hasFile('images1')) {
            $this->deletePhotos($data->report_ID);
            $images = $this->imageUpload($request->file('images1'), 'image', $data['unic_id_report']);
            $data->photos()->createMany($images);
        }

        //return redirect()->route('editReport', ['id' => $data->report_ID]);
        //return redirect('/report/detailed');
        return redirect()->route('generateReport', ['id' => $data->report_ID]);
    }

    private function deletePhotos($reportId)
    {
        // Get photos associated with the report ID
        $photos = PhotosReport::where('report_report_ID', $reportId)->get();

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
