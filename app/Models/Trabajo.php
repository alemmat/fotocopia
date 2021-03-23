<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CentroDeCopiado;

use App\Models\Archivo;

class Trabajo extends Model
{

    protected $fillable = [
        'name',
    ];
    use HasFactory;

    public function caracteristicas(){

      return $this->belongsToMany(Caracteristica::class);
    }

    public function centroDeCopiado(){

      return $this->belongsTo(CentroDeCopiado::class);
    }

    public function archivos(){

        return $this->hasMany(Archivo::class);
    }
}
