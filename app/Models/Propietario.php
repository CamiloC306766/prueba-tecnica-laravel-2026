<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propietario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
    ];

    protected $guarded = [
        'id'
    ];

    public function mascotas(): HasMany
    {
        return $this->hasMany(Mascota::class);
    }
}
