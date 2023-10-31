<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public function pago() : HasMany{
        return $this->hasMany(Pago::class);
    }
    public function usuarios_asignaciones() : HasMany{
        return $this->hasMany(Assignament::class);
    }

    // protected $fillable = [
    //     'documento',
    //     'email',
    //     'rol',
    //     'id',
    //     'nombre',
    // ];
}

