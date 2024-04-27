<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizacionUser extends Model
{
    use HasFactory;

    protected $table = 'organizacion_user';

    protected $fillable = [
        'user_id',
        'organizacion_id',
    ];
    /*
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }
    */
}
