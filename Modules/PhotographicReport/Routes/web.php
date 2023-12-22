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

Route::get('/report', [PhotographicReportController::class, 'index'])->name('report.index');
//Route::post('/upload', [PhotographicReportController::class, 'upload'])->name('report.upload');
//Route::post('/upload', 'PhotographicReportController@upload')->name('report.upload');

