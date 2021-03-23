<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Trabajo;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'desde',
        'hasta',
        'comentarios',
        'nombre'
    ];

    public function trabajo(){

        return $this->belongsTo(Trabajo::class);
    }

    static function crearArchivoAsociarTrabajo($datosNuevoArchivo, $trabajoId){

      $archivo = self::create($datosNuevoArchivo);

      $trabajo = Trabajo::find( $trabajoId );

      $archivo->trabajo()->associate($trabajo);

      $archivo->save();
    }
}
