<?php

use Illuminate\Support\Facades\Route;
use Modules\MapaInterativo\Http\Controllers\MapaInterativoController;

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

/* Route::prefix('mapainterativo')->group(function() {
    Route::get('/mapa', 'MapaInterativoController@index');
}); */

/* Route::get('/mapa', function () {
    return view('\Modules\MapaInterativo\Resources\views\index');
});
 */
Route::get('/mapa', [MapaInterativoController::class, 'index'])->name('mapa.index');

