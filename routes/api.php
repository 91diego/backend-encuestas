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
