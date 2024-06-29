<?php
use Illuminate\Support\Facades\Route;
use Modules\PhotographicReport\Http\Controllers\PhotographicReportController;

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

/* Route::prefix('photographicreport')->group(function() {
    Route::get('/report', 'PhotographicReportController@index');
}); */

/* Route::get('/report', [PhotographicReportController::class, 'index'])->name('report.index');
Route::get('/show/{id}', [PhotographicReportController::class, 'show'])->name('report.show');
Route::get('/edit/{id}', [PhotographicReportController::class, 'edit'])->name('report.edit');
Route::put('/update/{id}', [PhotographicReportController::class, 'update'])->name('report.update');
Route::get('/create', [PhotographicReportController::class, 'create'])->name('report.create');
Route::post('/store', [PhotographicReportController::class, 'store'])->name('report.store');
Route::delete('/report/{id}', [PhotographicReportController::class, 'destroy'])->name('report.destroy');
Route::delete('/photo/{id}', [PhotographicReportController::class, 'destroyPhoto'])->name('photo.destroy'); */
//Route::post('/upload', [PhotographicReportController::class, 'upload'])->name('report.upload');
//Route::post('/upload', 'PhotographicReportController@upload')->name('report.upload');

Route::group(['middleware' => ['auth']], function() /* colocando as rotas dentro dessa rota vai proteger do acesso via endereço */
{
    Route::get('/report', [PhotographicReportController::class, 'index'])->name('report.index');
    Route::get('/show/{id}', [PhotographicReportController::class, 'show'])->name('report.show');
    Route::get('/edit/{id}', [PhotographicReportController::class, 'edit'])->name('report.edit');
    Route::put('/update/{id}', [PhotographicReportController::class, 'update'])->name('report.update');
    Route::get('/create', [PhotographicReportController::class, 'create'])->name('report.create');
    Route::post('/store', [PhotographicReportController::class, 'store'])->name('report.store');
    Route::delete('/report/{id}', [PhotographicReportController::class, 'destroy'])->name('report.destroy');
    Route::delete('/photo/{id}', [PhotographicReportController::class, 'destroyPhoto'])->name('photo.destroy');
});
