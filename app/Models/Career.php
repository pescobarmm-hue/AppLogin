<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
         'name',
         'code', //codigo de cada carrera
         'duration_years', //duracion en años
         'description', //descripcion de curso
         'is_active', //si sigue vigente o no
        ];
    // Scope para filtrar solo carreras activas
    public function users(){
        return $this->hasMany(User::class);
    }

}
