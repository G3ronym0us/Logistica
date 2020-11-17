<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/




Auth::routes();
Route::resource('beneficiario', 'BeneficiarioController', ['except' => 'show', 'create', 'edit']);
Route::resource('correlativo', 'CorrelativoController', ['except' => 'show', 'create', 'edit']);
Route::resource('catalogo', 'CatalogoController', ['except' => 'show', 'create', 'edit']);
Route::resource('unidad_medida', 'UnidadController', ['except' => 'show', 'create', 'edit']);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
