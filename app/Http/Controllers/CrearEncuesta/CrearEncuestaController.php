<?php

namespace App\Http\Controllers\CrearEncuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Encuestas;

class CrearEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas = Encuestas::get();
        return $encuestas;
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
        $crearEncuesta = new Encuestas;
        // CONSULTA PARA VALIDAR SI EL REGISTRO EXISTE
        $validarEncuesta = Encuestas::where('nombre', '=', strtoupper($request->encuesta))
        ->where('desarrollo', '=', strtoupper($request->desarrollo))
        ->where('fase_id', '=', $request->fase)
        ->exists();
        
        // VALIDAMOS QUE EL REGISTRO NO EXISTA PARA INSERTARLO
        if ($validarEncuesta) {

            return 'El nombre '.strtoupper($request->encuesta).' ya existe. Favor de cambiarlo o modificar la fase que se le asignó.';
        } else {

            // SE GUARDAN LOS DATOS DEL REQUEST EN SUS RESPECTIVOS CAMPOS
            $crearEncuesta->nombre = strtoupper($request->encuesta);
            $crearEncuesta->desarrollo = strtoupper($request->desarrollo);
            $crearEncuesta->fase_id = $request->fase;

            // GUARDAMOS EN LA BASE DE DATOS
            $crearEncuesta->save();

            // OBTENEMOS EL ID DE LA ENCUESTA GENERADO
            $idEncuesta = $crearEncuesta->id;
            // LO RETORNAMOS COMO RESPUESTA
            return $idEncuesta;
        }

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
