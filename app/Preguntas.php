<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    //
    public function preguntas()
    {
        return $this->belongsTo(Encuestas::class);
    }
}
