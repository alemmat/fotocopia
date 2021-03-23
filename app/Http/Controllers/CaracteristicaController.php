<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Caracteristica;
use App\Models\CentroDeCopiado;

class CaracteristicaController extends Controller
{

  public function __construct(){

      //$this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $user = Auth::user();

      $centrosDeCopiadoId = $user->centrosDeCopiadoId();

      $centrosDeCopiado = $user->centrosDeCopiado()->get();

      $caracteristicas = Caracteristica::caracteristicaPorImprenta($centrosDeCopiadoId)->get();

      return view( 'caracteristica.index' )
      ->with( 'caracteristicas', $caracteristicas )
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

        Caracteristica::crearCaracteristicaAsociarLasImprentas([
           'precio' => $request->input('precio'),
           'detalle' => $request->input('detalle'),
           ],
           $centrosDeCopiado);

      }else {

        $centrosDeCopiado = $user->centrosDeCopiado()->get();

        Caracteristica::crearCaracteristicaAsociarLasImprentas([
           'precio' => $request->input('precio'),
           'detalle' => $request->input('detalle'),
           ],
           $centrosDeCopiado);
      }

      return redirect('/caracteristicas');
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
        //
    }
}
