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

class DetailedReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        return view('detailedreport::index');
    }

    public function generate(Request $request)
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
            $data['reserve'] = isset($_POST['reserve']) ? $_POST['reserve'] : null;
            
            $data['inputDeforestationSize'] = isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null;
            
            $data['inputQuantityWood'] = isset($_POST['inputQuantityWood']) ? $_POST['inputQuantityWood'] : null;
            $data['inputEmbargo'] = isset($_POST['inputEmbargo']) ? $_POST['inputEmbargo'] : null;
            $data['inputLumber'] = isset($_POST['inputLumber']) ? $_POST['inputLumber'] : null;
            $data['inputNaturalWood'] = isset($_POST['inputNaturalWood']) ? $_POST['inputNaturalWood'] : null;
            $data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;
            //$sizeIntereger = intval(isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null);

            if ($data['inputDeforestationSize'] != null) {
                if ($data['inputDeforestationSize'] == intval($data['inputDeforestationSize'])) {
                    $data['sizeIntereger'] = intval(isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null);
                } else {
                    $fraction = explode ('.', floatval($data['inputDeforestationSize']));
                    $data['sizeIntereger'] = $fraction[0];
                    $data['sizeFaction'] = $fraction[1];                
                }
            }
            
            $data['textEmbargo'] = '';

            if ($data['selectTypeAI'] == 'logging') {
                if ($data['reserve'] == 'offReserve') {
                    $typeDeforestation = 'área de vegetação nativa';                    
                }else if ($data['reserve'] == 'reserve') {
                    $typeDeforestation = 'área de reserva legal';                    
                }else {
                    $typeDeforestation = 'regeneração';
                }

                $data['administrative'] = ' desmatar floresta nativa em uma área de ' . $data["inputDeforestationSize"] . ' hectares em ' . $typeDeforestation;
                
                $data['administrative'] .= ', sem autorização prévia do órgão ambiental competente, conforme o ' . $data["articleAI"] . ', que prevê multa de R$ 5.000,00 (cinco mil reais) por hectare ou fração. Para chegar ao valor obtido, foi ';

                if (intval($data['inputDeforestationSize']) == $data['inputDeforestationSize']) {
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ 5.000,00 totalizando R$' . $data["valueAI"];
                } else {
                    $data['administrative'] .= 'multiplicado ' . $data["sizeIntereger"] . ' vezes R$ 5.000,00 mais R$5.000,00 pela fração 0,' .  $data["sizeFaction"] . ' totalizando R$' . $data["valueAI"];
                }
                $data['textEmbargo'] = 'A área embargada é de <strong>' . $data['inputDeforestationSize'] . '</strong>  hectares de floresta nativa em ' . $typeDeforestation . ', conforme Termo de Embargo de Nº <strong>' . $data['inputEmbargo'] . '</strong>, para que a área suprimida se regenere.';              
            } else {
                $data['administrative'] = 'Em Desenvolvimento';
            }

            

            //$data['article'] = 'Art. 51 do decreto federal 6.514/2008';
            
            
 
            
            
            //$data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;
            $data['name'] = isset($_POST['name']) ? $_POST['name'] : null;
            $data['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : null;
            $data['rg'] = isset($_POST['rg']) ? $_POST['rg'] : null;
            $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : null;
            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : null;
            $data['affiliation'] = isset($_POST['affiliation']) ? $_POST['affiliation'] : null;
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : null;
            $data['location'] = isset($_POST['location']) ? $_POST['location'] : null;


            $historic = isset($_POST['historic']) ? $_POST['historic'] : null;
            //dd($historic);
            $paragraphsHistoric = explode("\r\n", $historic);

            
            $paragraphs = array();
            foreach ($paragraphsHistoric as $paragraphHistoric) {
                if ($paragraphHistoric != null) {                    
                    $paragraphs[] = $paragraphHistoric;
                }                
            }

            
            
            
            $data['historic'] = isset($paragraphs) ? $paragraphs : null;
            

            //$data['historic'] = isset($_POST['historic']) ? $_POST['historic'] : null;




            //$data['photos'] = isset($_FILES['images1']) ? $_FILES['images1'] : null;
            /* $photos = isset($_FILES['images1']["tmp_name"]) ? $_FILES['images1']["tmp_name"] : null;

            $image1 = $photos[0];
            $image2 = $photos[1];
            $image3 = $photos[2];
            $image4 = $photos[3]; */

            
            
            $data['image1'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][0]));
            $data['image2'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][1]));
            $data['image3'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][2]));
            $data['image4'] = base64_encode(file_get_contents($_FILES['images1']['tmp_name'][3]));
            
            

            $data['motive'] = isset($_POST['motive']) ? $_POST['motive'] : null;
            $data['mitigating'] = isset($_POST['mitigating']) ? $_POST['mitigating'] : null;
            $data['aggravating'] = isset($_POST['aggravating']) ? $_POST['aggravating'] : null;
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

            
            


            
           
            
            
        } else {
            dd('Formuário não enviado');
        }        
        
        // Armazenar $images na sessão
        Session::put('data', $data);       
        
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


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('detailedreport::create');
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
        return view('detailedreport::show');
    }

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
