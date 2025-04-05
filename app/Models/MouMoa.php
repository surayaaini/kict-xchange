<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouMoa extends Model
{
    protected $fillable = [
        'title',
        'partner',
        'start_date',
        'end_date',
        'description',
    ];

}
