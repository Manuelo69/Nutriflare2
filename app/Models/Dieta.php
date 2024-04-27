<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function valoracion()
    {
        return $this->hasOne(Valoracion::class);
    }

    public function platos()
    {
        return $this->belongsToMany(Plato::class);
    }
}