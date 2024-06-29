<?php

namespace Modules\PhotographicReport\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\PhotographicReport\Models\Photo;
use Modules\PhotographicReport\Models\PhotographicReport;
use Modules\PhotographicReport\Http\Requests\PhotographicRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Routing\Controller;
use Modules\PhotographicReport\Repository\PhotographicReportRepository;
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
    public function index(Request $request)
    {
        // Obter as imagens da sessão
    /* $images = Session::get('images', []); */

    /* $reports = PhotographicReport::with('photo')
            ->orderBy('created_at', 'desc')
            ->paginate(10); */


    $reports = PhotographicReportRepository::search($request)->orderBy('created_at', 'desc')->paginate(8);

    /* dd($reports); */

    return view('photographicreport::index', compact('reports'));
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
    public function store(PhotographicRequest $request)
    {
        $report = PhotographicReport::create([
            'operation' => $request->operation,
            'user' => $request->user
        ]);

        foreach ($request->file('photos') as $file) {
            $path = $file->store('photos',  'public');
            // Extrair metadados EXIF da imagem
            $exif = @exif_read_data($file->getRealPath());
            $dataTime = '';
            if($exif && isset($exif['DateTime'])) {
                $dataTime = $exif['DateTime'];
                // Converter data e hora EXIF para o formato SQL
                $dataTime = date('Y-m-d H:i:s', strtotime($dataTime));
            } else {
                // Define o valor padrão cados não exista metadados da data/hora
                $dataTime = now();
            }
            Photo::create([
                'path' => $path,
                'date_time' => $dataTime,
                'photographic_report_id' => $report->id    
            ]);
        }
        //return back()->with('success', 'Fotos carregadas e relatório criado com sucesso!');
        return redirect()->route('report.show', $report->id)->with('success', 'Fotos carregadas e relatório criado com sucesso!');
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */  

     public function show($id)
     {   
        $report = PhotographicReport::with('photo')->findOrFail($id);

         $photos = Photo::where('photographic_report_id', $id)
                 ->orderBy('date_time', 'asc')
                 ->get();
 
         /* $firstPagePhotos = $photos->slice(0, 4);
 
         $otherPhotos = $photos->slice(4); */
 
         foreach ($photos as $photo) {
             $photo->base64 = $this->convertToBase64($photo->path);
         }

         $totalPages = ceil($photos->count() / 3);
 
         /* foreach ($otherPhotos as $photo) {
             $photo->base64 = $this->convertToBase64($photo->path);
         } */
         //dd($photos);
         return view('photographicreport::show', compact('photos', 'totalPages', 'report'));
     }



    /* public function show2($id)
    {   
        $photos = Photo::where('photographic_report_id', $id)
                ->orderBy('date_time', 'asc')
                ->get();

        $firstPagePhotos = $photos->slice(0, 4);

        $otherPhotos = $photos->slice(4);

        foreach ($firstPagePhotos as $photo) {
            $photo->base64 = $this->convertToBase64($photo->path);
        }

        foreach ($otherPhotos as $photo) {
            $photo->base64 = $this->convertToBase64($photo->path);
        }
        //dd($photos);
        return view('photographicreport::show', compact('firstPagePhotos', 'otherPhotos'));
    } */

    private function convertToBase64($path)
    {
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $base64 = 'data:' . $type . ';base64' . base64_encode($file);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $report = PhotographicReport::with('photo')->findOrFail($id);

         $photos = Photo::where('photographic_report_id', $id)
                 ->orderBy('date_time', 'asc')
                 ->get();
 
         /* $firstPagePhotos = $photos->slice(0, 4);
 
         $otherPhotos = $photos->slice(4); */
 
         foreach ($photos as $photo) {
             $photo->base64 = $this->convertToBase64($photo->path);
         }

         $totalPages = ceil($photos->count() / 3);
 
         /* foreach ($otherPhotos as $photo) {
             $photo->base64 = $this->convertToBase64($photo->path);
         } */
         //dd($photos);

        return view('photographicreport::edit', compact('photos', 'totalPages', 'report'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $report = PhotographicReport::findOrFail($id);

        // Atualizar nome operação
        $report->operation = $request->input('operation');
        $report->save();

        // Exclui fotos
        if ($request->has('delete_photos')) {
            foreach ($request->input('delete_photos') as $photoId) {
                $photo = Photo::findOrFail($photoId);
                Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
        }

        // Substitui fotos
        // Substitui fotos
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $photoId => $file) {
                $photo = Photo::findOrFail($photoId);
                Storage::disk('public')->delete($photo->path);
                $path = $file->store('photos', 'public'); // Certifique-se de armazenar no disco 'public'
                $photo->path = $path;
                $photo->save();
            }
        }

        // Adicionar novas fotos
        if ($request->hasFile('newPhotos')) {
            foreach ($request->file('newPhotos') as $file) {
                $path = $file->store('photos',  'public');
                // Extrair metadados EXIF da imagem
                $exif = @exif_read_data($file->getRealPath());
                //dd($exif);
                $dataTime = '';
                if($exif && isset($exif['DateTime'])) {
                    $dataTime = $exif['DateTime'];
                    // Converter data e hora EXIF para o formato SQL
                    $dataTime = date('Y-m-d H:i:s', strtotime($dataTime));
                } else {
                    // Define o valor padrão cados não exista metadados da data/hora
                    $dataTime = now();
                }
                Photo::create([
                    'path' => $path,
                    'date_time' => $dataTime,
                    'photographic_report_id' => $report->id    
                ]);
            }
        }

        return redirect()->route('report.show', $report->id)->with('success', 'Relatório atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //dd('teste');
        $report = PhotographicReport::find($id);
        //dd($report);
        $photos = Photo::where('photographic_report_id', $id)->get();

        foreach ($photos as $photo) {
            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }
            $photo->delete();
        }

        $report->delete();

        //$report->save();

        return redirect()->back();
    }

    public function destroyPhoto($id)
    {
        dd('teste');
    }
}
