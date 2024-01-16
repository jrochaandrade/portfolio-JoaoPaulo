<?php
use Modules\DetailedReport\Http\Controllers\DetailedReportController;

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

/* Route::prefix('detailedreport')->group(function() {
    Route::get('/report/detailed', 'DetailedReportController@index');
}); */



Route::group(['middleware' => ['auth']], function() /* colocando as rotas dentro dessa rota vai proteger do acesso via endereço */
{
    Route::get('/report/detailed', [DetailedReportController::class, 'index'])->name('detailed');

    Route::get('/report/create', [DetailedReportController::class, 'create'])->name('create');
    
    Route::get('/report/edit/{id}', [DetailedReportController::class, 'edit'])->name('editReport');
    
    Route::put('/report/{id}', [DetailedReportController::class, 'update'])->name('updateReport');
    
    Route::get('/report/generateReport/{id}', [DetailedReportController::class, 'show'])->name('generateReport');
    
    Route::post('/report/save', [DetailedReportController::class, 'store'])->name('save');
    
    
    Route::get('/report/pdf', [DetailedReportController::class, 'generatePdf'])->name('generate.pdf');


    Route::delete('/report/{id}', [DetailedReportController::class, 'destroy'])->name('report.destroy');


    Route::get('/autocomplete-article', [DetailedReportController::class, 'selectSearch']);
});

//Auth::routes();



