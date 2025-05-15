<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobilityApplication extends Model
{
    protected $guarded = [];
    protected $table = 'mobility_applications';

    protected $fillable = [
        'user_id',
        'proposal_id',
        'full_name',
        'matric_no',
        'date_of_birth',
        'home_address',
        'mailing_address',
        'email',
        'mobile_no',
        'nationality',
        'passport_no',
        'passport_expiry',
        'passport_copy',

        'emergency_name',
        'emergency_relationship',
        'emergency_phone',
        'emergency_email',
        'emergency_address',

        'kulliyyah',
        'level_of_study',
        'year_of_study',
        'semester',
        'programme',
        'cgpa',

        'language_proficiency',

        'fully_funded',
        'sponsor',
        'sponsoring_amount',

        'mobility_type',
        'host_institution',
        'host_country',
        'mobility_start_date',
        'mobility_end_date',

        'student_declaration_name',
        'student_declaration_matric',
        'student_declaration_date',
        'indemnity_file',
    ];
}
