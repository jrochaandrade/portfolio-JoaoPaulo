<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use Modules\InteractiveMap\Http\Controllers\InteractiveMapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 /* Route::get('/', function () {
    return view('index');
}); */
 

 Route::get('/', [HomeController::class, 'index'])->name('home.index');
 Route::get('/mapa', [InteractiveMapController::class, 'index'])->name('mapa.index');
 Route::get('/teste', [InteractiveMapController::class, 'teste'])->name('teste');

 
