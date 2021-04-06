<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\Trabajo;
use App\Models\Archivo;

class ApiArchivoController extends Controller
{

    public function store(Request $request){

      Log::debug($request);

      $metaDataArchivo = json_decode( $request->input('metaDataArchivo') );

      $path = $request->file('archivo')->store('archivo');

      $nombre = $request->file('archivo')->getClientOriginalName();

      $archivo = Archivo::crearArchivoAsociarTrabajo([
         'path' => $path,
         'desde' => $metaDataArchivo->desde,
         'hasta' => $metaDataArchivo->hasta,
         'comentarios' => $metaDataArchivo->comentarios,
         'nombre' => $nombre,
       ],
      $request->input( 'trabajo' ) );

    }


}
