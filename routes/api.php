<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Rutas para el controlador CrearEncuesta
 */
Route::resource('encuesta', 'CrearEncuesta\CrearEncuestaController');

/**
 * Rutas para el controlador CrearPregunta
 */
Route::resource('pregunta', 'CrearPregunta\CrearPreguntaController');

/**
 * Rutas para el controlador Fase
 */
Route::resource('fases', 'Fases\FaseController');

 /**
  * Rutas para el controlador Medicion
  */
Route::resource('mediciones', 'Mediciones\MedicionController');
