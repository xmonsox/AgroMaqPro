<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasMany;

class Activity extends Model
{
    use HasFactory;
    public function actividad_asignacion() : HasMany{
        return $this->hasMany(Assignament::class);
    }
}
