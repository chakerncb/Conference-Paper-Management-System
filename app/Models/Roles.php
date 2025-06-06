<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'description',
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id');
    }
}
