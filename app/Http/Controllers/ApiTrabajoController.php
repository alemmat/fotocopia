<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

use App\Models\CentroDeCopiado;

use App\Models\Trabajo;

class ApiTrabajoController extends Controller
{

    public function store(Request $request){

      $centroDeCopiado = CentroDeCopiado::find( $request->input('centroDeCopiadoId') );

      $trabajo = new Trabajo();

      $trabajo->centroDeCopiado()->associate($centroDeCopiado);

      $trabajo->save();

      return $trabajo->id;
    }
}
