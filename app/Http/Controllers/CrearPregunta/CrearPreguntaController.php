<?php

namespace App\Http\Controllers\CrearPregunta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Preguntas;

class CrearPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Método index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // SE CREA UNA INSTANCIA DEL MODELO
        $crearPregunta = new Preguntas; # Crear nuevo modelo
        
        // SE GUARDAN LOS DATOS DEL REQUEST EN SUS RESPECTIVOS CAMPOS
        $crearPregunta->numero = $request->numero;
        $crearPregunta->descripcion = $request->descripcion;
        $crearPregunta->multiple = $request->multiple;
        $crearPregunta->encuesta_id = $request->encuesta_id;

        // GUARDAMOS EN LA BASE DE DATOS
        $crearPregunta->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
