<?php
/**
 * DOCUEMTACION
 *
 * Fecha:       2020.09.08
 * Nombre:      Diego Gonzalez
 * Descripcion: - Se agrega campo y comentarios_multiple a la consulta de la variable $preguntas en el metodo encuesta().
 */

namespace App\Http\Controllers\Encuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Fases;
use App\Encuestas;
use App\EnvioEncuestas;
use App\Negociaciones;

class EncuestaController extends Controller
{

    private $bitrixSite;
    private $bitrixToken;

    public function __construct()
    {
        $this->bitrixSite=env('BITRIX_SITE', '');
        $this->bitrixToken = env('BITRIX_TOKEN', '');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // MUESTRA EL LISTADO DE LAS ENCUESTAS
        $encuestas = Encuestas::join('fases', 'encuestas.fase_id', '=', 'fases.id')
        ->select('encuestas.id', 'encuestas.nombre as encuesta', 'encuestas.desarrollo', 'fases.nombre as fase')
        ->get();
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
        $encuesta = Encuestas::join('fases', 'fases.id', '=', 'encuestas.fase_id')
        ->select('encuestas.nombre as encuesta', 'encuestas.desarrollo',
        'fases.nombre as fase', 'fases.id as idFase')
        ->find($id);
        return $encuesta;
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

    /**
     * RETORNA LA VISTA DE LA ENCUESTA
     * TAMBIEN TRAE DATOS DEL CRM
     *
     * @param string  $nombre
     * @param string $fase
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function encuesta($nombre, $fase, $id)
    {

        // ALMACENA LOS DATOS QUE SE PASARAN A LA VISTA
        $data = [];

        $preguntas = DB::table('encuestas')
        ->join('preguntas', 'preguntas.encuesta_id', '=', 'encuestas.id')
        ->join('mediciones', 'mediciones.id', '=', 'preguntas.medicion_id')
        ->where('encuestas.nombre', 'LIKE', '%'. $nombre . '%')
        ->where('encuestas.fase_id', '=', $fase)
        ->select('preguntas.id', 'preguntas.numero', 'preguntas.descripcion',
        'preguntas.multiple', 'preguntas.comentarios_multiple', 'mediciones.nombre')
        ->get();

        $informacionPreguntas = json_decode($preguntas, 1);

        $encuesta = DB::table('encuestas')
        ->where('encuestas.nombre', 'LIKE', '%'. $nombre . '%')
        ->where('encuestas.fase_id', '=', $fase)
        ->select('encuestas.id')
        ->get();
        $encuestaId = json_decode($encuesta, 1);
        $data = [

            "id_negociacion" => $id,
            "encuesta" => $nombre,
            "fase" => $fase,
            "id_encuesta" => $encuestaId[0]["id"]
        ];

        $mensaje = [

            "ASESOR" => "Respecto al asesor",
            "PARA FINALIZAR" => "Para finalizar",
            "APARTADO" => "Apartado",
            "INTEGRACION DE EXPEDIENTE" => "Integracion expediente",
            "FIRMA DE CONTRATO" => "Firma de contrato",
            "SEGUIMIENTO" => "Seguimiento",
            "ESCRITURACION" => "Escrituracion",
            "ENTREGA DE UNIDAD" => "Entrega de unidad",
            "ADMINISTRACION CONDOMINAL" => "Administracion condominal",
            "ATENCION AL PROPIETARIO" => "Atencion al propietario",
        ];

        return view('encuesta', compact('data', 'informacionPreguntas', 'mensaje'));
    }
}
