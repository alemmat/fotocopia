<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CentroDeCopiado;

class Precio extends Model
{
    use HasFactory;

    protected $fillable = [
        'precio',
        'numero_de_impresiones',
    ];

    static function crearPrecioAsociarLasImprentas($datosNuevoPrecio, $centrosDeCopiado){

      $precio = self::create($datosNuevoPrecio);

      foreach ($centrosDeCopiado as $centroDeCopiado) {

        $precio->centrosDeCopiado()->attach($centroDeCopiado);
      }
    }

    public function centrosDeCopiado(){

      return $this->belongsToMany(CentroDeCopiado::class);
    }

    static function precioPorImprenta($centrosDeCopiado){

      return self::whereHas('centrosDeCopiado', function($query) use($centrosDeCopiado){

        $query->whereIn('centro_de_copiado_id', $centrosDeCopiado);
      });
    }
}
