<?php

namespace App\Http\Controllers\EnvioEncuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\EnvioEncuestas;
use App\Encuestas;
use App\Negociaciones;
use DB;

class EnvioEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $envios = EnvioEncuestas::get();
        $envios = DB::table('envio_encuestas')
        ->join('encuestas', 'encuestas.id', '=', 'envio_encuestas.encuesta_id')
        ->join('negociaciones', 'negociaciones.id_negociacion', '=', 'envio_encuestas.negociacion_id')
        ->select('encuestas.nombre', 'negociaciones.desarrollo', 'envio_encuestas.estatus_envio', 'envio_encuestas.fecha_envio',
        'envio_encuestas.numero_envios', 'envio_encuestas.estatus_respuesta','envio_encuestas.fecha_respuesta')
        ->get();
        return $envios;
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
        //
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
