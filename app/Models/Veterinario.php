<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veterinario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'numero_colegiado',
        'email'
    ];

    protected $guarded = ['id'];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class);
    }
    
}
