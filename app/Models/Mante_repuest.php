<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mante_repuest extends Model
{
    use HasFactory;
    public function repuesto() : BeLongsTo{
        return $this->belongsto(Assignament::class);
    }
    public function asignacion() : BeLongsTo{
        return $this->belongsto(Repuesto::class);
    }
}
