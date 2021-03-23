<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caracteristica;
use App\Models\Precio;
use App\Models\User;
use App\Models\Trabajo;

class CentroDeCopiado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_del_punto_de_fotocopiado',
        'direccion',
    ];

    public function caracteristicas(){

        return $this->belongsToMany(Caracteristica::class)->withTimestamps();
    }

    public function precios(){

        return $this->belongsToMany(Precio::class);
    }

    public function trabajos(){

        return $this->hasMany(Trabajo::class);
    }

    public function user(){

        return $this->belongsToMany(User::class);
    }

    public function dueno(){

        return $this->user()->whereHas('rol', function ($query)  {
            $query->where('name','=','dueno');
        })->get()->first();
    }

    public function empleado(){

        return $this->user()->whereHas('rol', function ($query)  {
            $query->where('name','=','empleado');
        });
    }
}
