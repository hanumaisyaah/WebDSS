<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;

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
    return view('welcome');
});
Route::resource('alternative', AlternativeController::class);
Route::get('/search', [AlternativeController::class, 'search'])->name('search');
Route::resource('criteria', CriteriaController::class);
Route::get('/search', [CriteriaController::class, 'search'])->name('search');