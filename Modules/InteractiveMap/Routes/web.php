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

Route::get('/map', [InteractiveMapController::class, 'index'])->name('map.index');
Route::post('/uploadKml', [InteractiveMapController::class, 'uploadKml'])->name('uploadKml');
/* Route::get('/sidebar', [InteractiveMapController::class, 'sidebar'])->name('sidebar.index');
Route::get('/teste', [InteractiveMapController::class, 'teste'])->name('teste');
Route::get('/teste2', [InteractiveMapController::class, 'teste2'])->name('teste2');
 */