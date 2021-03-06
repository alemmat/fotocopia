<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Precio;
use App\Models\CentroDeCopiado;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $user = Auth::user();

      $centrosDeCopiadoId = $user->centrosDeCopiadoId();

      $centrosDeCopiado = $user->centrosDeCopiado()->get();

      $precios = Precio::precioPorImprenta($centrosDeCopiadoId)->get();

      return view( 'precio.index' )
      ->with( 'precios', $precios )
      ->with( 'centrosDeCopiado', $centrosDeCopiado );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

      $user = Auth::user();

      if( $request->has('imprentas') ){

        $centrosDeCopiado = CentroDeCopiado::find( $request->input('imprentas') );

        Precio::crearPrecioAsociarLasImprentas([
           'precio' => $request->input('precio'),
           'numero_de_impresiones' => $request->input('numero_de_impresiones'),
           ],
           $centrosDeCopiado);

      }else {

        $centrosDeCopiado = $user->centrosDeCopiado()->get();

        Precio::crearPrecioAsociarLasImprentas([
           'precio' => $request->input('precio'),
           'numero_de_impresiones' => $request->input('numero_de_impresiones'),
           ],
           $centrosDeCopiado);
      }

      return redirect('/precios');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $precio = Precio::find($id);

        $precio->centrosDeCopiado()->detach();

        $precio->delete();

        return redirect('/precios');
    }
}
