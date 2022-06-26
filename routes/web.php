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

Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('adminHome');
    }
    return redirect()->route('login');
});

Route::get('/user', function () {
    if (Auth::check()) {
        return redirect()->route('index');
    }
    return redirect()->route('login');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('alternative', AlternativeController::class);
    Route::get('/search', [AlternativeController::class, 'search'])->name('search');
    Route::resource('criteria', CriteriaController::class);
    Route::get('/search', [CriteriaController::class, 'search'])->name('search');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('adminHome');
Route::get('/alternative', [App\Http\Controllers\AlternativeController::class, 'index'])->name('admin.alternative');
Route::get('/criteria', [App\Http\Controllers\CriteriaController::class, 'index'])->name('admin.criteria');
Route::get('admin/criteria/add', [App\Http\Controllers\CriteriaController::class, 'create'])->name('admin.AddCriteria');
Route::get('/ranking', [App\Http\Controllers\ProcessController::class, 'process'])->name('admin.results');
Route::post('/admin/criteria/update/{id}', [App\Http\Controllers\CriteriaController::class, 'update'])->name('admin.kriteria.update');
Route::get('/admin/criteria/edit/{id}', [App\Http\Controllers\CriteriaController::class, 'edit'])->name('admin.EditCri');
Route::get('/admin/criteria/delete/{id}', [App\Http\Controllers\CriteriaController::class, 'destroy'])->name('admin.kriteria.delete');
