<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\CentroDeCopiado;
use App\Models\Rol;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function centrosDeCopiado(){

      return $this->belongsToMany(CentroDeCopiado::class);
    }

    function rol(){

      return $this->belongsToMany(Rol::class);
    }

    static function crearUsuario($datosNuevoUsuario, $centroDeCopiado){

      $newUser = self::create($datosNuevoUsuario);

      $newUser->centrosDeCopiado()->attach($centroDeCopiado);

      return $newUser;
    }

    static function crearDueno($datosNuevoUsuario, $centroDeCopiado){

      $newUser = self::crearUsuario($datosNuevoUsuario, $centroDeCopiado);

      $rol = Rol::where('name', '=', 'dueno')->get()->first();

      $newUser->rol()->attach($rol);

      return $newUser;
    }

    static function crearEmpleado($datosNuevoUsuario, $centroDeCopiado){

      $newUser = self::crearUsuario($datosNuevoUsuario, $centroDeCopiado);

      $rol = Rol::where('name', '=', 'empleado')->get()->first();

      $newUser->rol()->attach($rol);

      return $newUser;
    }

    public function chequearRol($rol){

      $es = false;

      if($this->whereHas('rol', function ($query) use ($rol){

          $query->where('name','=', $rol);
      })->count() > 0 ){

        $es = true;
      }

      return $es;
    }

    public function admin(){

        return $this->chequearRol('admin');
    }

    public function dueno(){

      return $this->chequearRol('dueno');
    }

    public function empleado(){

      return $this->chequearRol('empleado');
    }

    public function centrosDeCopiadoId(){

      return $this->centrosDeCopiado()->pluck('centro_de_copiados.id')->toArray();
    }
}
