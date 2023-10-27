<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasMany;

class Machinery extends Model
{
    use HasFactory;
    public function maquinaria_asignaciones() : HasMany{
        return $this->hasMany(Assignament::class);
    }
}
