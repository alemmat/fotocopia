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

    static function crearPrecio($datosNuevoPrecio, $centrosDeCopiado){

      $precio = self::create($datosNuevoPrecio);

      foreach ($centrosDeCopiado as $centroDeCopiado) {

        $precio->centrosDeCopiado()->attach($centroDeCopiado);
      }
    }

    public function centrosDeCopiado(){

      return $this->belongsToMany(CentroDeCopiado::class);
    }
}
