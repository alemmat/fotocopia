<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;


class ArchivoController extends Controller
{

    public function show($id){

      $archivo = Archivo::find($id);

      return Storage::download($archivo->path, $archivo->nombre);
    }
}
