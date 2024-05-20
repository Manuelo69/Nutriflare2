<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjerciciosRutina extends Model
{
    use HasFactory;

    protected $table = 'ejercicios_rutina';

    protected $fillable = ['rutina_id', 'ejercicio_id', 'series', 'repeticiones'];

    public function rutina()
    {
        return $this->belongsTo(Rutina::class);
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}