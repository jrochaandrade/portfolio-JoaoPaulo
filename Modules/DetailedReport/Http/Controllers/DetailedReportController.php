<?php

namespace Modules\DetailedReport\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    public function generate()
    {
        $data = array();

        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            $data['inputBO'] = isset($_POST['inputBO']) ? $_POST['inputBO'] : null;
            $data['typeBO'] = isset($_POST['typeBO']) ? $_POST['typeBO'] : null;
            $data['inputAI'] = isset($_POST['inputAI']) ? $_POST['inputAI'] : null;
            $data['valueAI'] = isset($_POST['valueAI']) ? $_POST['valueAI'] : null;
            $data['articleAI'] = isset($_POST['articleAI']) ? $_POST['articleAI'] : null;
            $data['selectTypeAI'] = isset($_POST['selectTypeAI']) ? $_POST['selectTypeAI'] : null;
            $data['inputDeforestationSize'] = isset($_POST['inputDeforestationSize']) ? $_POST['inputDeforestationSize'] : null;
            $data['inputQuantityWood'] = isset($_POST['inputQuantityWood']) ? $_POST['inputQuantityWood'] : null;
            $data['inputEmbargo'] = isset($_POST['inputEmbargo']) ? $_POST['inputEmbargo'] : null;
            $data['inputLumber'] = isset($_POST['inputLumber']) ? $_POST['inputLumber'] : null;
            $data['inputNaturalWood'] = isset($_POST['inputNaturalWood']) ? $_POST['inputNaturalWood'] : null;
            $data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;
            //$data['inputImageLetter'] = isset($_POST['inputImageLetter']) ? $_POST['inputImageLetter'] : null;
            $data['name'] = isset($_POST['name']) ? $_POST['name'] : null;
            $data['cpf'] = isset($_POST['cpf']) ? $_POST['cpf'] : null;
            $data['rg'] = isset($_POST['rg']) ? $_POST['rg'] : null;
            $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : null;
            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : null;
            $data['affiliation'] = isset($_POST['affiliation']) ? $_POST['affiliation'] : null;
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : null;
            $data['location'] = isset($_POST['location']) ? $_POST['location'] : null;
            $data['historic'] = isset($_POST['historic']) ? $_POST['historic'] : null;

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


            
           
            
            
        } else {
            dd('Formuário não enviado');
        }        
        
               
        
        return view('detailedreport::report', compact('data'));
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
