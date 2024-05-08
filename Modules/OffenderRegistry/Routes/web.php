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



Route::group(['middleware' => ['auth']], function() /* colocando as rotas dentro dessa rota vai proteger do acesso via endereço */
{
    Route::prefix('offenderregistry')->group(function() {
        Route::get('/', 'OffenderRegistryController@index');
    });

});
