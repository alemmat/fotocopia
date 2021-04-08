<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use App\Models\CentroDeCopiado;
use App\Models\Archivo;
use App\Models\Cliente;

class Trabajo extends Model
{

    use HasFactory;

    public function caracteristicas(){

      return $this->belongsToMany(Caracteristica::class);
    }

    public function centroDeCopiado(){

      return $this->belongsTo(CentroDeCopiado::class);
    }

    public function archivos(){

      return $this->hasMany(Archivo::class);
    }

    public function archivosPendientes(){

      return $this->archivos()->where('estado', '=', 'pendiente')->count();
    }

    public function cliente(){

      return $this->belongsTo(Cliente::class);
    }

    static function createWorkAndAssociateClientAndPrintingShop(Request $request){

      $newJob = self::create();

      $centroDeCopiado = CentroDeCopiado::find( $request->input('centroDeCopiadoId') );

      $newJob->centroDeCopiado()->associate($centroDeCopiado);

      $cliente = Cliente::create([
         'email' => $request->input('email'),
         'telefono' => $request->input('telefono'),
       ]);

      $newJob->cliente()->associate($cliente);

      $newJob->save();

      return $newJob->id;
    }
}
