<?php

namespace App\Http\Controllers\Encuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //
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
    public function encuesta($nombre, $fase, $id){

        echo $nombre."<br>".$fase."<br>".$id."<br>";
        // ALMACENA LOS DATOS QUE SE PASARAN A LA VISTA
        $data = [];

        // INFORMACION DEL DEAL
        // OBTIENE LA INFORMACION DE LA NEGOCIACION
        $detailsDeal = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.deal.get?ID='.$id;

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

        array_push($data, [
            "negociacion" => $deal["result"]["TITLE"],
            "desarrollo" => $place,
            "responsable" => $user[0]["NAME"]." ".$user[0]["LAST_NAME"],
            "puesto" => $user[0]["WORK_POSITION"],
            "departamento" => $departament[0]["NAME"],
            "gerente_responsable" => $manager[0]["NAME"]." ".$manager[0]["LAST_NAME"],
            "origen" => $source[0]["NAME"],
            "canal_ventas" => $purchase["NAME"],
        ]);

        return $data;
    }    
}
