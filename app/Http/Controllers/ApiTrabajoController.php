<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Models\CentroDeCopiado;
use App\Models\Trabajo;
use App\Models\Cliente;

class ApiTrabajoController extends Controller
{

    public function store(Request $request){

      Log::debug($request);

      /*$centroDeCopiado = CentroDeCopiado::find( $request->input('centroDeCopiadoId') );

      $trabajo = new Trabajo();

      $trabajo->centroDeCopiado()->associate($centroDeCopiado);

      $trabajo->save();

      $cliente = Cliente::create([
         'email' => $request->input('email'),
         'telefono' => $request->input('telefono'),
       ]);

      $trabajo->cliente()->associate($cliente);

      $trabajo->save();*/

      return Trabajo::createWorkAndAssociateClientAndPrintingShop($request);
    }
}
