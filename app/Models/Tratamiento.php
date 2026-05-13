<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tratamiento extends Model
{

    use HasFactory,SoftDeletes;

    protected $fillable = [
        'consulta_id',
        'descripcion',
        'dosis',
        'duracion'
    ];
    
    protected $guarded = ['id'];

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }
}
