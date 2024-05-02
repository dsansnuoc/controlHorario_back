<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichaje extends Model
{
    use HasFactory;

    protected $table = 'fichaje';

    protected $fillable = [
        'userId',
        'tipo_fichaje',
        'tipo_pausa',
        'hora_fichaje',
    ];
}
