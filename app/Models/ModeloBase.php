<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CentroDeCopiado;

use App\Models\Archivo;

class ModeloBase extends Model
{

    use HasFactory;

    static function modeloPor($centrosDeCopiado){

      return self::whereHas('centrosDeCopiado', function($query) use($centrosDeCopiado){

        $query->whereIn('centro_de_copiado_id', $centrosDeCopiado);
      });
    }
}
