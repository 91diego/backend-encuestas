<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuestas extends Model
{
    // RELACION
    public function preguntas()
    {
        return $this->hasMany(Preguntas::class);
    }

}
