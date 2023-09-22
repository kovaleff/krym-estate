<?php

use App\Http\Controllers\Parse\ParseController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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
Route::get('/parse', [ParseController::class, 'parse']);
Route::get('/tes', [TestController::class, 'index']);


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/apart/{id}', [\App\Http\Controllers\ApartController::class, 'detail']);
Route::get('/developer/{id}', [\App\Http\Controllers\DeveloperController::class, 'detail'])->name('developer');
Route::get('/developers', [\App\Http\Controllers\DeveloperController::class, 'all'])->name('developers');
Route::get('/all-news', [\App\Http\Controllers\NewsController::class, 'index'])->name('all-news');
Route::get('/news{id}', [\App\Http\Controllers\NewsController::class, 'detail'])->name('news');
