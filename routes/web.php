<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
Auth::routes(['verify' => false]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/proyectos', 'App\Http\Controllers\ProyectoController@index')->name('proyectos.index');
    Route::get('/proyectos/nuevo', 'App\Http\Controllers\ProyectoController@create')->name('proyectos.create');
    Route::post('/proyectos/store', 'App\Http\Controllers\ProyectoController@store')->name('proyectos.store');
    Route::get('/proyectos/destroy/{id}', 'App\Http\Controllers\ProyectoController@destroy')->name('proyectos.destroy');
    Route::get('/proyectos/{proyecto}/editar', 'App\Http\Controllers\ProyectoController@edit')->name('proyectos.edit');
    Route::put('/proyectos/{proyecto}', 'App\Http\Controllers\ProyectoController@update')->name('proyectos.update')->where('proyecto', '[0-9]+');
    Route::get('/proyectos/buscar', 'App\Http\Controllers\ProyectoController@search')->name('proyecto.search');
});


Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth')->name('home');
