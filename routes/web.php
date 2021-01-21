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

Route::get('/', function () {
    return view('welcome');
});

// SE CREA RUTA PARA MOSTRAR LA VISTA DE LA ENCUESTA
Route::get('encuesta-IDEX/{nombre}/{fase}/{id}/{cliente}', 'Encuesta\EncuestaController@encuesta');

/**
 * Rutas para el controlador GuardarRespuesta
 */
Route::resource('respuesta', 'GuardarRespuesta\GuardarRespuestaController');
