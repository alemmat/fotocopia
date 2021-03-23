<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CentroDeCopiado;
use App\Models\Trabajo;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = [
        'precio',
        'detalle',
    ];

    public function trabajos(){

      return $this->belongsToMany(Trabajo::class);
    }

    static function crearCaracteristicaAsociarLasImprentas($datosNuevaCaracteristica, $centrosDeCopiado){

      $caracteristica = self::create($datosNuevaCaracteristica);

      foreach ($centrosDeCopiado as $centroDeCopiado) {

        $caracteristica->centrosDeCopiado()->attach($centroDeCopiado);
      }
    }

    public function centrosDeCopiado(){

      return $this->belongsToMany(CentroDeCopiado::class);
    }

    static function caracteristicaPorImprenta($centrosDeCopiado){

      return self::whereHas('centrosDeCopiado', function($query) use($centrosDeCopiado){

        $query->whereIn('centro_de_copiado_id', $centrosDeCopiado);
      });
    }
}
