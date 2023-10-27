<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BeLongsTo;
use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;

class Assignament extends Model
{
    use HasFactory;
    public function usuarios() : BeLongsTo{
        return $this->belongsto(Usuario::class);
    }
    public function activity() : BeLongsTo{
        return $this->belongsto(Activity::class);
    }
    public function machinery() : BeLongsTo{
        return $this->belongsto(Machinery::class);
    }

    public function mante_repuest() : HasMany{
        return $this->hasMany(Mante_repuest::class);
    }
}
