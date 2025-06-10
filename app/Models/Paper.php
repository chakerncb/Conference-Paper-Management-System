<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //
    protected $fillable = [
        'author_id',
        'title',
        'abstract',
        'keywords',
        'file_path',
        'status',
    ];

}
