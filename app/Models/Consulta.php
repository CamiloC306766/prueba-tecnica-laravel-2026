<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consulta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mascota_id',
        'veterinario_id',
        'motivo',
        'diagnostico',
        'estado',
        'fecha_consulta',
    ];

    protected $guarded = ['id'];

    public function mascota(): BelongsTo
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario(): BelongsTo
    {
        return $this->belongsTo(Veterinario::class);
    }

    public function tratamientos(): HasMany
    {
        return $this->hasMany(Tratamiento::class);
    }
    
}

