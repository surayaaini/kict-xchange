<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InboundStudent extends Model
{
    protected $fillable = [
        'full_name',
        'university_origin',
        'program',
        'program_type',
        'responsible_lecturer',
        'duration_value',
        'duration_unit',
        'received_date',
        'departure_date',
    ];
        
}
