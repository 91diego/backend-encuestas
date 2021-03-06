<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Rutas para el controlador CrearEncuesta
 */
Route::resource('encuestas', 'Encuesta\EncuestaController');

/**
 * Rutas para el controlador CrearEncuesta
 */
Route::resource('encuesta', 'CrearEncuesta\CrearEncuestaController');

/**
 * Rutas para el controlador CrearPregunta
 */
Route::resource('pregunta', 'CrearPregunta\CrearPreguntaController');
Route::get('pregunta/mostrar/{id}', 'CrearPregunta\CrearPreguntaController@showQuestion');

/**
 * Rutas para el controlador Fase
 */
Route::resource('fases', 'Fases\FaseController');

 /**
  * Rutas para el controlador Medicion
  */
Route::resource('mediciones', 'Mediciones\MedicionController');

 /**
  * Rutas para el controlador Medicion
  */
  Route::resource('envios', 'EnvioEncuesta\EnvioEncuestaController');

/**
 * Rutas para el controlador CrearQr
 */
Route::resource('qr', 'QrCode\CrearQrController');
Route::get('qr/generar-qr/{id}', 'QrCode\CrearQrController@generarQr');

/**
 * Ruta para generar el documento excel 
 * con la informacion de las encuestas
 */
Route::resource('exportar-excel', 'ExportExcel\ExportExcelController');
