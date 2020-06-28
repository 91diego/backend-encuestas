<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;
use App\Negociaciones;
use App\Respuestas;
use App\EnvioEncuestas;
use App\Encuestas;
use App\Fases;
use App\Preguntas;

class ExportExcel implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Encuesta',
            'Fase',
            'ID Negociacion',
            'Cliente',
            'Desarrollo',
            'Responsable CLiente',
            'Puesto Responsable Cliente',
            'Departamento Responsable Cliente',
            'Gerente del Responsable Cliente',
            'Origen Negociacion',
            'Canal Ventas Negociacion',
            'No Pregunta',
            'Pregunta',
            'Respuesta'
        ];
    }
    public function collection()
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

        return $data;//json_encode($data);
    }
}
