<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;


    protected $fillable = ['nombre_ejercicio', 'slug', 'imagen', 'explicacion', 'musculo', 'aprobado'];

    public function ejerciciosRutina()
    {
        return $this->hasMany(EjerciciosRutina::class);
    }

    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class);
    }
}