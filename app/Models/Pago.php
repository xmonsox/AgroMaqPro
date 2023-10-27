<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BeLongsTo;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    public function usuarios() : BeLongsTo{
        return $this->belongsto(Usuario::class);
    }
}
