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

Route::get('/report/detailed', [DetailedReportController::class, 'index'])->name('detailed');

Route::get('/report/create', [DetailedReportController::class, 'create'])->name('create');

Route::get('/report/generateReport/{id}', [DetailedReportController::class, 'show'])->name('generateReport');

Route::post('/report/save', [DetailedReportController::class, 'store'])->name('save');


Route::get('/report/pdf', [DetailedReportController::class, 'generatePdf'])->name('generate.pdf');

