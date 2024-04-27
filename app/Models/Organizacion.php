<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;

    protected $table = 'organizacion';

    protected $fillable = [
        'name',
        'nif',
        'email',
        'conection',
        'smtpPort',
        'smtpUser',
        'smtpPassword',
        'smtpServer',
        'activate'
    ];

    protected $casts = [
        'activate' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
