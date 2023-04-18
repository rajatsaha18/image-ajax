<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StudentController::class, 'index']);
Route::post('/', [StudentController::class, 'addStudent'])->name('add.student');
Route::get('/get-students', [StudentController::class, 'getStudent'])->name('get.student');
Route::get('/ediUser/{id}', [StudentController::class, 'editStudent']);
Route::post('/update-data', [StudentController::class, 'updateStudent'])->name('update.student');
