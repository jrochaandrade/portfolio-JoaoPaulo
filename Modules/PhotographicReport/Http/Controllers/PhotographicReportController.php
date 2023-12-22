<?php

namespace Modules\PhotographicReport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Delete;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PhotographicReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    //#[Get(uri: '/report', name: 'report.index')]
    public function index()
    {
        // Obter as imagens da sessão
    $images = Session::get('images', []);

    return view('photographicreport::index', compact('images'));
    }

    /* public function upload(Request $request) 
    {
        
        $errors = array();
        $allowExt = array('jpeg', 'jpg', 'png');
        $images = array();        
        foreach ($_FILES ['images'] ['name'] as $key => $name) {
            $ext = strtolower (pathinfo ($name, PATHINFO_EXTENSION));
            if (in_array ($ext, $allowExt)) {
                $tmpName = $_FILES ['images'] ['tmp_name'] [$key];
                //$exif = exif_read_data($tmpName, 0, true)['EXIF']["DateTimeOriginal"];
                //dd($exif);
                if (isset(exif_read_data($tmpName, 0, true)['EXIF']["DateTimeOriginal"])) {
                    $images [$tmpName] = exif_read_data($tmpName, 0, true)['EXIF']["DateTimeOriginal"];
                    
                }
            }else {
                $errors [] = "$name não é uma imagem válida";
                echo('Não é uma imagem válida');
            }
        }
        asort ($images);
        dd($images);
    
        // Armazenar $images na sessão
        Session::put('images', $images);

        return Redirect::route('report.index');
        
    } */

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('photographicreport::create');
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
        return view('photographicreport::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('photographicreport::edit');
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
