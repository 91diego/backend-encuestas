<?php

namespace App\Http\Controllers\ExportExcel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Negociaciones;
use App\Respuestas;
use App\EnvioEncuestas;
use App\Encuestas;
use App\Fases;
use App\Preguntas;

class ExportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // QUERY INFORMACION
        /**
         * SELECT
         * encuestas.nombre as "Encuesta", fases.nombre as "Fase",
         * negociaciones.id_negociacion, negociaciones.cliente, negociaciones.desarrollo, negociaciones.responsable,
         * negociaciones.puesto_responsable, negociaciones.departamento_responsable,
         * negociaciones.gerente_responsable, negociaciones.origen, negociaciones.canal_ventas,
         * preguntas.numero, preguntas.descripcion, respuestas.respuesta
         * FROM
         * negociaciones
         * LEFT JOIN respuestas ON respuestas.negociacion_id = negociaciones.id
         * RIGHT JOIN envio_encuestas ON envio_encuestas.negociacion_id = negociaciones.id_negociacion
         * RIGHT JOIN encuestas ON encuestas.id = envio_encuestas.encuesta_id
         * RIGHT JOIN fases ON fases.id = encuestas.fase_id
         * LEFT JOIN preguntas ON preguntas.id = respuestas.pregunta_id
         */
        $data = DB::table('negociaciones')
        ->leftJoin('respuestas', 'respuestas.negociacion_id', '=', 'negociaciones.id')
        ->rightJoin('envio_encuestas', 'envio_encuestas.negociacion_id', '=', 'negociaciones.id_negociacion')
        ->rightJoin('encuestas', 'encuestas.id', '=', 'envio_encuestas.encuesta_id')
        ->rightJoin('fases', 'fases.id', '=', 'encuestas.fase_id')
        ->leftJoin('preguntas', 'preguntas.id', '=', 'respuestas.pregunta_id')
        ->select('encuestas.nombre as Encuesta', 'fases.nombre as Fase', 'negociaciones.id_negociacion', 
        'negociaciones.cliente', 'negociaciones.desarrollo', 'negociaciones.responsable',
        'negociaciones.puesto_responsable', 'negociaciones.departamento_responsable',
        'negociaciones.gerente_responsable', 'negociaciones.origen', 'negociaciones.canal_ventas',
        'preguntas.numero', 'preguntas.descripcion', 'respuestas.respuesta')
        ->get();

        return $data;
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
