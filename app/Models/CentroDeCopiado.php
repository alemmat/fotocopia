<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caracteristica;
use App\Models\Precio;
use App\Models\User;

class CentroDeCopiado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_del_punto_de_fotocopiado',
        'direccion_nombre_de_la_calle',
        'direccion_numero',
    ];

    public function caracteristicas(){

        return $this->belongsToMany(Caracteristica::class)->withPivot('precio')->withTimestamps();
    }

    public function precio(){

        return $this->belongsToMany(Precio::class);
    }

    public function user(){

        return $this->belongsToMany(User::class);
    }
}
