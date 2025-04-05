<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouMoa extends Model
{
    protected $fillable = [
        'collaborator',
        'signed_date',
        'expiry_date',
        'focal_person',
        'type',
        'impact',
    ];



}
