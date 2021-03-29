<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Caracteristica;
use App\Models\CentroDeCopiado;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Config;
use Illuminate\Support\Facades\Auth;

class CentroDeCopiadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $user = Auth::user();

      $centrosDeCopiado = $user->centrosDeCopiado()->get();

      return view( 'centrodecopiado.index-empleados' )->with( 'centrosDeCopiado', $centrosDeCopiado );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      return view( 'centrodecopiado.create' );
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
          'direccion' => $request->input('direccion'),
      ]);

      if(User::where( 'email', '=', $request->input( 'email_proprietario' ) )->exists() ){

        $user = User::where( 'email', '=', $request->input( 'email_proprietario' ) )->get()->first();

        $user->centrosDeCopiado()->attach($centroDeCopiado->id);
      }
      else{

        $password = Hash::make( 123456789 );//'password' => Hash::make( Str::random(9) ),

        $user = User::crearDueno([
           'name' => $request->input('nombre_proprietario'),
           'email' => $request->input('email_proprietario'),
           'password' => $password,

           ],
           $centroDeCopiado
        );
      }

      return redirect('/centrodecopiado');


       /*$caracteristicas = Caracteristica::all();

       foreach ($caracteristicas as $caracteristica) {

         if( $request->has("caracteristica-".$caracteristica->id ) ){

           $centroDeCopiado->caracteristicas()->attach($request->input("caracteristica-".$caracteristica->id),['precio'=>$request->input("precio-".$caracteristica->id)]);
         }
       }*/

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
    public function show($id){

      $centroDeCopiado = CentroDeCopiado::find($id);

      return view( 'centrodecopiado.show' )->with( 'centroDeCopiado', $centroDeCopiado );
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
