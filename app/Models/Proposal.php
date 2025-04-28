<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'submitted_by_name',
        'submitted_by_email',
        'submitted_by_phone',
        'partner_university',
        'start_date',
        'end_date',
        'responsible_staff',
        'lecturers',
        'students',
        'objective',
        'documents',
        'status',
    ];

    protected $casts = [
        'responsible_staff' => 'array',
        'lecturers' => 'array',
        'students' => 'array',
        'documents' => 'array',
    ];
}
