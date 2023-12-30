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
            
            $data['inputBO'] = isset($_POST['inputBO']) ? $_POST['inputBO'] : null;
            $data['typeBO'] = isset($_POST['typeBO']) ? $_POST['typeBO'] : null;
            $data['inputAI'] = isset($_POST['inputAI']) ? $_POST['inputAI'] : null;
            $data['valueAI'] = isset($_POST['valueAI']) ? $_POST['valueAI'] : null;
            $data['articleAI'] = isset($_POST['articleAI']) ? $_POST['articleAI'] : null;
            $data['articleBO'] = isset($_POST['articleBO']) ? $_POST['articleBO'] : null;
            $data['selectTypeAI'] = isset($_POST['selectTypeAI']) ? $_POST['selectTypeAI'] : null;

            $data['sizeFraction'] = null;
            $data['inputDeforestationSize'] = isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null;
            if ($data['inputDeforestationSize'] != null) {
                if ($data['inputDeforestationSize'] == intval($data['inputDeforestationSize'])) {
                    $data['sizeIntereger'] = intval(isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null);
                } else {
                    $fraction = explode ('.', floatval($data['inputDeforestationSize']));
                    $data['sizeIntereger'] = $fraction[0];
                    $data['sizeFraction'] = $fraction[1];                
                }
            }

            $data['reserve'] = isset($_POST['reserve']) ? $_POST['reserve'] : null;

            $data['inputEmbargo'] = isset($_POST['inputEmbargo']) ? $_POST['inputEmbargo'] : null;
            $data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;
            
            $data['inputQuantityWood'] = isset($_POST['inputQuantityWood']) ? $_POST['inputQuantityWood'] : null;
            $data['inputLumber'] = isset($_POST['inputLumber']) ? $_POST['inputLumber'] : null;
            $data['inputNaturalWood'] = isset($_POST['inputNaturalWood']) ? $_POST['inputNaturalWood'] : null;

            $data['name'] = isset($_POST['name']) ? $_POST['name'] : null;
            $data['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : null;
            $data['rg'] = isset($_POST['rg']) ? $_POST['rg'] : null;
            $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : null;
            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : null;
            $data['affiliation'] = isset($_POST['affiliation']) ? $_POST['affiliation'] : null;
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : null;
            $data['location'] = isset($_POST['location']) ? $_POST['location'] : null;
            
            /* $historic = isset($_POST['historic']) ? $_POST['historic'] : null;

            $paragraphsHistoric = explode("\r\n", $historic);
            
            $paragraphs = array();
            foreach ($paragraphsHistoric as $paragraphHistoric) {
                if ($paragraphHistoric != null) {                    
                    $paragraphs[] = $paragraphHistoric;
                }                
            }
            
            $data['historic'] = isset($paragraphs) ? $paragraphs : null; */
            $data['historic'] = isset($_POST['historic']) ? $_POST['historic'] : null;
            
            $data['image1'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][0]));
            $data['image2'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][1]));
            $data['image3'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][2]));
            $data['image4'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][3]));

            $data['motive'] = isset($_POST['motive']) ? $_POST['motive'] : null;
            $data['mitigating'] = isset($_POST['mitigating']) ? $_POST['mitigating'] : null;
            $mitigatingString = '';
            if ($data['mitigating'] != null) {
                foreach ($data['mitigating'] as $mitigating) {
                    $mitigatingString .= $mitigating . '*';
                }
                
            }
            $data['mitigatingString'] = isset($mitigatingString) ? $mitigatingString : null;

            // Separar novamente quando for jogar na View
            /* $mitigatingExplode = explode('*', $mitigatingString);
            //dd($mitigatingExplode);
            $teste = array();
            foreach($mitigatingExplode as $mitigating) {
                if ($mitigating != null) {
                    $teste[] = $mitigating;

                }
            }
            dd($teste); */

            $data['aggravating'] = isset($_POST['aggravating']) ? $_POST['aggravating'] : null;
            $aggravatingString = '';
            if ($data['aggravating'] != null) {
                foreach ($data['aggravating'] as $aggravating) {
                    $aggravatingString .= $aggravating . '*';
                }
                
            }
            $data['aggravatingString'] = isset($aggravatingString) ? $aggravatingString : null;



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
            
            $data['textEmbargo'] = '';
            
            if ($data['selectTypeAI'] == 'logging') {
                if ($data['reserve'] == 'offReserve') {
                    $typeDeforestation = 'área de vegetação nativa';                    
                }else if ($data['reserve'] == 'reserve') {
                    $typeDeforestation = 'área de reserva legal';                    
                }else {
                    $typeDeforestation = 'regeneração';
                }
                
                $data['administrative'] = ' desmatar floresta nativa em uma área de ' . $data["inputDeforestationSize"] . ' hectares em ' . $typeDeforestation . ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data["articleAI"] . ' do decreto federal 6.514 de 22 de julho de 2008, que prevê multa de R$ 5.000,00 (cinco mil reais) por hectare ou fração. Para chegar ao valor obtido, foi ';
                
                if (intval($data['inputDeforestationSize']) == $data['inputDeforestationSize']) {
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ 5.000,00 totalizando R$' . $data["valueAI"];
                } else {
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ 5.000,00 mais R$5.000,00 pela fração 0,' .  $data["sizeFraction"] . ' totalizando R$' . $data["valueAI"];
                }
                $data['textEmbargo'] = 'A área embargada é de <strong>' . $data['inputDeforestationSize'] . '</strong>  hectares de floresta nativa em ' . $typeDeforestation . ', conforme Termo de Embargo de Nº <strong>' . $data['inputEmbargo'] . '</strong>, para que a área suprimida se regenere.';              
            } else {
                $data['administrative'] = 'Em Desenvolvimento';
            }
        } else {
            dd('Formuário não enviado');
        }
        $unicIdReport = rand();
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
            //'size_deforestation_fraction' => 0,132,
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
            'unic_id_report' => $unicIdReport
            
        ]);

        // Salvar as imagens no banco de dados

        if ($request->hasFile('images1')) {

            $images = $this->imageUpload($request->file('images1'), 'image', $unicIdReport);
            $dataReport->photos()->createMany($images);

        }


        
        
        // Armazenar $images na sessão
        Session::put('data', $data);       
        
        return redirect('report/detailed');

        
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
        return view('detailedreport::edit');
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
