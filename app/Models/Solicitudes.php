<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    protected $table = 'fichaje';

    protected $fillable = [
        'userId',
        'tipo_solicitud',
        'fecha_solicitud',
        'fecha_inicio',
        'fecha_fin',
        'aceptada',
        'fecha_aceptada',
        'rechazada',
        'fecha_rechazada'
    ];

    protected $casts = [
        'aceptada' => 'boolean',
        'rechazada' => 'boolean',
    ];
}
