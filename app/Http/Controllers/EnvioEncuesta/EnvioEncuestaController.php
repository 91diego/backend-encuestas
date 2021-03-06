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

    private $bitrixSite;
    private $bitrixToken;

    public function __construct()
    {
        $this->bitrixSite=env('BITRIX_SITE', '');
        $this->bitrixToken = env('BITRIX_TOKEN', '');
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
        ->select('encuestas.nombre', 'negociaciones.cliente', 'negociaciones.desarrollo', 'envio_encuestas.estatus_envio', 'envio_encuestas.fecha_envio',
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

        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y m d h:i:s A');

        $encuesta = DB::table('encuestas')
        ->where('encuestas.nombre', 'LIKE', '%'. $request->nombre . '%')
        ->where('encuestas.fase_id', '=', $request->fase)
        ->select('encuestas.id')
        ->get();
        $encuestaId = json_decode($encuesta, 1);

        // VALIDAMOS SI LA ENCUESTA YA FUE ENVIADA
        $validarEnvio = EnvioEncuestas::where('negociacion_id', '=', $request->id)
        ->where("encuesta_id", $encuestaId[0]["id"])
        ->exists();

        if (!$validarEnvio) {

            // SI LA ENCUESTA NO HA SIDO ENVIADA AL CLIENTE, SE INSERTAN LOS DATOS DE ENVIO
            DB::table('envio_encuestas')->insert([
                [
                    "encuesta_id" => $encuestaId[0]["id"],
                    "negociacion_id" => $request->id,
                    "estatus_envio" => "ENVIADO",
                    "fecha_envio" => $fecha,
                    "numero_envios" => 1,
                    "estatus_respuesta" => "PENDIENTE",
                    "fecha_respuesta" => "SIN RESPUESTA"
                ],
            ]);
        }

        /* GUARDA NEGOCIACION */
        $negociaciones = new Negociaciones;
        $dataDeal = [];
        // INFORMACION DEL DEAL
        // OBTIENE LA INFORMACION DE LA NEGOCIACION
        $detailsDeal = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.deal.get?ID='.$request->id;

        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        $responseAPI = file_get_contents($detailsDeal);

        // CAMPOS DE LA RESPUESTA
        $deal = json_decode($responseAPI, true);
        // FIN INFORMACION DEAL

        // CONTIENE LOS DATOS DEL RESPONSABLE
        $user = $this->users($deal["result"]["ASSIGNED_BY_ID"]);
        // dd($user);

        // CONTIENE LOS DETALLES DEL DEPARTAMENTO
        $departament = $this->departament($user[0]["UF_DEPARTMENT"][0]);
        // dd($departaments);

        // CONTIENE LOS DATOS DEL GERENTE
        $manager = $this->users($departament[0]["UF_HEAD"]);
        // dd($manager);

        // CONTIENE EL CANAL DE VENTAS
        $purchase = $this->purchase($deal["result"]["UF_CRM_5D03F07FB6F84"]);
        // dd($purchase);

        // CONTIENE EL ORIGEN DE LA VENTA
        $source = $this->source($deal["result"]["SOURCE_ID"]);
        // dd($source);

        // CONTIENE EL NOMBRE DEL DESARROLLO
        $place = $this->place($deal["result"]["UF_CRM_5D12A1A9D28ED"]);
        // dd($place);

        $nombreCliente = explode(": ", $deal["result"]["TITLE"]);
        array_push($dataDeal, [
            "id_negociacion" => $request->id,
            "negociacion" => strtoupper($nombreCliente[1]),
            "desarrollo" => strtoupper($place),
            "responsable" => strtoupper($user[0]["NAME"]." ".$user[0]["LAST_NAME"]),
            "puesto" => strtoupper($user[0]["WORK_POSITION"]),
            "departamento" => strtoupper($departament[0]["NAME"]),
            "gerente_responsable" => strtoupper($manager[0]["NAME"]." ".$manager[0]["LAST_NAME"]),
            "origen" => \strtoupper($source[0]["NAME"]),
            "canal_ventas" =>  strtoupper($purchase["NAME"]),
        ]);

        // CONSULTA PARA VALIDAR SI EL REGISTRO EXISTE
        $validarNegociacion = Negociaciones::where('id_negociacion', '=', $request->id)
        ->exists();

        if ($validarNegociacion) {
            
            // SI EXISTE EL REGISTRO, SE HACE LA CONSULTA Y SE DEVUELVE EL ID DEL REGISTRO
            $validarNegociacion = Negociaciones::where('id_negociacion', $request->id)
            ->first();
            $idNegociacion = $validarNegociacion->id;
        } else {

            // SI LA NEGOCIACION NO EXISTE, SE INSERTA A LA BASE DE DATOS
            // SE GUARDAN LOS DATOS EN SUS RESPECTIVOS CAMPOS
            $negociaciones->id_negociacion = $request->id;
            $negociaciones->cliente = $dataDeal[0]["negociacion"];
            $negociaciones->desarrollo = $dataDeal[0]["desarrollo"];
            $negociaciones->responsable = $dataDeal[0]["responsable"];
            $negociaciones->puesto_responsable = $dataDeal[0]["puesto"];
            $negociaciones->departamento_responsable = $dataDeal[0]["departamento"];
            $negociaciones->gerente_responsable = $dataDeal[0]["gerente_responsable"];
            $negociaciones->origen = $dataDeal[0]["origen"];
            $negociaciones->canal_ventas = $dataDeal[0]["canal_ventas"];

            // GUARDAMOS EN LA BASE DE DATOS
            $negociaciones->save();

            // OBTENEMOS EL ID DE LA NEGOCIACION GENERADO EN LA BASE DE DATOS
            $idNegociacion = $negociaciones->id;
        }

        /* FIN GUARDAR NEGOCIACION */
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
