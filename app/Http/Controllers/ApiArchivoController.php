<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\Trabajo;
use App\Models\Archivo;

class ApiArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
