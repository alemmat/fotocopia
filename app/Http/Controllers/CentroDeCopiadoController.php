<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Caracteristica;

use App\Models\CentroDeCopiado;

use App\Models\User;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use Config;

class CentroDeCopiadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      $caracteristicas = Caracteristica::orderBy('detalle')->get();
      return view( 'centrodecopiado.create' )->with( 'caracteristicas', $caracteristicas );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

       $centroDeCopiado = CentroDeCopiado::create([
          'nombre_del_punto_de_fotocopiado' => $request->input('nombre_del_punto_de_fotocopiado'),
          'direccion_nombre_de_la_calle' => $request->input('direccion_nombre_de_la_calle'),
          'direccion_numero' => $request->input('direccion_numero'),
      ]);

       $caracteristicas = Caracteristica::all();

       foreach ($caracteristicas as $caracteristica) {

         if( $request->has("caracteristica-".$caracteristica->id ) ){

           $centroDeCopiado->caracteristicas()->attach($request->input("caracteristica-".$caracteristica->id),['precio'=>$request->input("precio-".$caracteristica->id)]);
         }
       }



       $user = User::crearUsuario([
          'name' => $request->input('nombre_proprietario'),
          'email' => $request->input('email_proprietario'),
          'password' => Str::random(9),
      ]);




       //Config::set('mail.username', $this->empresa->empresa_mail);
       //Config::set('mail.password', $this->empresa->empresa_mail_password);
       //Config::set('mail.encryption', 'ssl');
       //Config::set('mail.port', $this->empresa->empresa_mail_puerto);
       //Config::set('mail.host', $this->empresa->empresa_mail_servidor);
       //Config::set('mail.driver', 'smtp');

       //Mail::to($cliente->email)->send( new Personalizado( $this->empresa->empresa_mail, 'hola', "hola" ) );
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
