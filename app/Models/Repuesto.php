<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BeLongsTo;
use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;
    public function supplier() : BeLongsTo{
        return $this->belongsto(Supplier::class);
    }

    public function mante_repuest() : HasMany{
        return $this->hasMany(Mante_repuest::class);
    }
}
