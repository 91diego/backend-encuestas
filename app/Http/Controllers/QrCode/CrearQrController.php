<?php

namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CrearQrController extends Controller
{

    private $bitrixSite;
    private $bitrixToken;

    public function __construct()
    {
        $this->bitrixSite=env('BITRIX_SITE', '');
        $this->bitrixToken = env('BITRIX_TOKEN', '');
    }

	public function writeToLog($data, $title = '') {
		$log = "\n------------------------\n";
		$log .= date("Y.m.d G:i:s") . "\n";
		$log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
		$log .= print_r($data, 1);
		$log .= "\n------------------------\n";
		file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
		return true;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return 'QR GENEARATOR';   
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
        $this->writeToLog($request->id, "ADD QR");

        // OBTIENE LA RESPUESTA DE LA API REST BITRIX
        /*$responseAPI = file_get_contents($urlDeals);
        $datos = json_decode($responseAPI, true);*/
        $qrCodePrimerContacto = base64_encode(QrCode::format('png')
        ->size(300)->color(40, 40, 40)
        ->backgroundColor(255,255,0)
        // ->margin(200)
        ->generate("https://encuestas.idex.cc/encuesta-IDEX/$request->encuesta/1/$request->id"));
        // return $qrCode;
        // UF_CRM_1589138577 -> QR Primer contacto, tipo de dato cadena

        // URL PARA ACTUALIZAR EL DEAL
        $updateDeal = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.deal.update?ID='.$request->id;
        $queryData =  http_build_query(

            array(

                "ID" => $request->id,
                "fields" => array(
                    "UF_CRM_1589138577" => $qrCodePrimerContacto //$qrCodePrimerContacto
                ),
                "params" => array("REGISTER_SONET_EVENT" => "Y")
            )
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(

            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $updateDeal,
            CURLOPT_POSTFIELDS => $queryData
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function generarQr($id) 
    {

        $this->writeToLog($id, 'incoming');
        $qrCodePrimerContacto = base64_encode(QrCode::format('png')
        ->size(300)->color(40, 40, 40)
        ->backgroundColor(255,255,0)
        // ->margin(200)
        ->generate("https://encuestas.idex.cc/encuesta-IDEX/EVALUACION%20ASESOR/1/$id"));
        // return $qrCode;
        // UF_CRM_1589138577 -> QR Primer contacto, tipo de dato cadena

        // URL PARA ACTUALIZAR EL DEAL
        $updateDeal = $this->bitrixSite.'/rest/117/'.$this->bitrixToken.'/crm.deal.update?ID='.$id;
        $queryData =  http_build_query(

            array(

                "ID" => $id,
                "fields" => array(
                    "UF_CRM_1589138577" => $id //$qrCodePrimerContacto
                ),
                "params" => array("REGISTER_SONET_EVENT" => "Y")
            )
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(

            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $updateDeal,
            CURLOPT_POSTFIELDS => $queryData
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);
        return $result;
    }
}
