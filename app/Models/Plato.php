<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;

    public function valorNutricional()
    {
        return $this->hasOne(ValorNutricional::class);
    }

    public function dietas()
    {
        return $this->belongsToMany(Dieta::class);
    }
}