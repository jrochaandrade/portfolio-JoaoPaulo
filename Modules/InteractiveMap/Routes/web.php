<?php

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

use Illuminate\Support\Facades\Route;
use Modules\InteractiveMap\Http\Controllers\InteractiveMapController;

/* Route::prefix('interactivemap')->group(function() {
    Route::get('/', 'InteractiveMapController@index');
}); */

Route::get('/mapa', [InteractiveMapController::class, 'index'])->name('mapa.index');
Route::get('/sidebar', [InteractiveMapController::class, 'sidebar'])->name('sidebar.index');
Route::get('/teste', [InteractiveMapController::class, 'teste'])->name('teste');
