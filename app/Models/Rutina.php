<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $fillable = ['dia_semana', 'activa', 'user_id'];

    public function ejerciciosRutina()
    {
        return $this->hasMany(EjerciciosRutina::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class);
    }
}
