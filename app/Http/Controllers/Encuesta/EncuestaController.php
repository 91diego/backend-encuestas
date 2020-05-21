<?php

namespace App\Http\Controllers\Encuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Fases;
use App\Encuestas;
use App\EnvioEncuestas;

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
     * OBTIENE LOS DATOS DEL DEPARTAMENTO
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function departament($id) {

        // INFORMACION DEL DEPARTAMENTO
        $detailsDepartament = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/department.get?ID='.$id;
        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($detailsDepartament);

        // CAMPOS DE LA RESPUESTA
        $departament = json_decode($responseAPI, true);
        return $departament["result"];
        // FIN INFORMACION DEPARTAMENTO
    }
  
    /**
     * OBTIENE LOS DATOS DEL RESPONSABLE
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users($id) {

        // INFORMACION RESPONSABLE
        $detailsResponsable = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/user.get?ID='.$id;
        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($detailsResponsable);

        // CAMPOS DE LA RESPUESTA
        $responsable = json_decode($responseAPI, true);
        // FIN INFORMACION RESPOSABLE
        return $responsable["result"];
    }

    /**
     * OBTIENE EL ORIGEN DE LA NEGOCIACION
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function source($name) {

        // INFORMACION RESPONSABLE
        $detailsResponsable = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.status.list?FILTER[STATUS_ID]='.$name;
        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($detailsResponsable);

        // CAMPOS DE LA RESPUESTA
        $responsable = json_decode($responseAPI, true);
        // FIN INFORMACION RESPOSABLE
        return $responsable["result"];
    }

    /**
     * OBTIENE EL CANAL DE VENTAS
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function purchase($id) {

        // INFORMACION RESPONSABLE
        $detailPurchase = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.status.get?ID='.$id;
        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($detailPurchase);

        // CAMPOS DE LA RESPUESTA
        $purchase = json_decode($responseAPI, true);
        // FIN INFORMACION RESPOSABLE
        return $purchase["result"];
    }

    /**
     * Obtiene el nombre del desarrollo del CRM
     * @param  int  $id
     * @return string $nombreDeesarrollo
     */
    public function place($id){

        $fieldsDeals = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.deal.fields';

        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($fieldsDeals);

        // CAMPOS DE LA RESPUESTA
        $fields = json_decode($responseAPI, true);

        // NUMERO DE CAMPOS EN LA POSICION DEL ARRAY
        $numberItems = count($fields['result']['UF_CRM_5D12A1A9D28ED']['items']);
        // ARRAY DE ITEMS
        $items = [];
        for ($i=0; $i < $numberItems; $i++) {

            array_push($items, [

                "id" => $fields['result']['UF_CRM_5D12A1A9D28ED']['items'][$i]["ID"],
                "nombre" => $fields['result']['UF_CRM_5D12A1A9D28ED']['items'][$i]["VALUE"]
            ]);
        }

        for ($i=0; $i < count($items); $i++) { 
            
            if ($items[$i]["id"] == $id) {

                $nombreDesarrollo = $items[$i]["nombre"];
                return $nombreDesarrollo;
            }
        }
        return $nombreDesarrollo;
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
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y m d h:i:s A');

        $encuesta = DB::table('encuestas')
        ->where('encuestas.nombre', 'LIKE', '%'. $nombre . '%')
        ->where('encuestas.fase_id', '=', $fase)
        ->select('encuestas.id')
        ->get();
        $encuestaId = json_decode($encuesta, 1);

        // VALIDAMOS SI LA ENCUESTA YA FUE ENVIADA
        $validarEnvio = EnvioEncuestas::where('negociacion_id', '=', $id)
        ->where("encuesta_id", $encuestaId[0]["id"])
        ->exists();

        if (!$validarEnvio) {

            // SI LA ENCUESTA NO HA SIDO ENVIADA AL CLIENTE, SE INSERTAN LOS DATOS DE ENVIO
            DB::table('envio_encuestas')->insert([
                [
                    "encuesta_id" => $encuestaId[0]["id"],
                    "negociacion_id" => $id,
                    "estatus_envio" => "Enviado",
                    "fecha_envio" => $fecha,
                    "estatus_respuesta" => "Pendiente",
                    "fecha_respuesta" => ""
                ],
            ]);
        }
        // ALMACENA LOS DATOS QUE SE PASARAN A LA VISTA
        $data = [];

        $preguntas = DB::table('encuestas')
        ->join('preguntas', 'preguntas.encuesta_id', '=', 'encuestas.id')
        ->join('mediciones', 'mediciones.id', '=', 'preguntas.medicion_id')
        ->where('encuestas.nombre', 'LIKE', '%'. $nombre . '%')
        ->where('encuestas.fase_id', '=', $fase)
        ->select('preguntas.id', 'preguntas.numero', 'preguntas.descripcion', 
        'preguntas.multiple', 'mediciones.nombre')
        ->get();

        $informacionPreguntas = json_decode($preguntas, 1);
        // dd($informacionPreguntas[0]["nombre"]);

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
