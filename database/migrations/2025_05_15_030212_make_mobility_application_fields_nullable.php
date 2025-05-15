<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeMobilityApplicationFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            // Common nullable string fields
            $nullableFields = [
                'phone',
                'university',
                'mailing_address',
                'passport_copy',
                'emergency_name',
                'emergency_relationship',
                'emergency_phone',
                'emergency_email',
                'emergency_address',
                'language_proficiency',
                'fully_funded',
                'sponsor',
                'sponsoring_amount',
                'mobility_type',
                'host_institution',
                'host_country',
                'indemnity_file',
                'student_declaration_name',
                'student_declaration_matric',
            ];

            foreach ($nullableFields as $field) {
                if (Schema::hasColumn('mobility_applications', $field)) {
                    $table->string($field)->nullable()->change();
                }
            }

            // Nullable dates
            if (Schema::hasColumn('mobility_applications', 'mobility_start_date')) {
                $table->date('mobility_start_date')->nullable()->change();
            }

            if (Schema::hasColumn('mobility_applications', 'mobility_end_date')) {
                $table->date('mobility_end_date')->nullable()->change();
            }

            if (Schema::hasColumn('mobility_applications', 'student_declaration_date')) {
                $table->date('student_declaration_date')->nullable()->change();
            }

            // Nullable CGPA (if numeric/decimal)
            if (Schema::hasColumn('mobility_applications', 'cgpa')) {
                $table->decimal('cgpa', 3, 2)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // No need to reverse since it's just adding nullable
    }
}
