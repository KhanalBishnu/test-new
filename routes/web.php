<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

// Route::resource('evaluations', EvaluationController::class);
Route::resource('evaluations', EvaluationController::class);
Route::resource('employee-evaluations', EvaluationController::class);
Route::resource('sections', SectionController::class);
Route::resource('questions', QuestionController::class);
Route::get('questions/{question}', [QuestionController::class,'toggleStatus'])->name('questions.toggleStatus');


Route::get('sections/{id}/add-question', [SectionController::class, 'addQuestion'])->name('sections.addQuestion');
Route::post('sections/{id}/add-question', [SectionController::class, 'storeQuestion'])->name('sections.storeQuestion');

Route::get('/sections/getSelectedQuestions/{section}', [SectionController::class, 'getSelectedQuestions'])->name('sections.getSelectedQuestions');
Route::get('/sections/delete/{section}', [SectionController::class, 'delete'])->name('sections.delete');


