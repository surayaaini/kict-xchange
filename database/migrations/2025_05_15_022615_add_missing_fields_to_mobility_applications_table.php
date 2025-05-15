<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('mobility_applications', 'programme')) {
                $table->string('programme')->nullable()->after('semester');
            }
            if (!Schema::hasColumn('mobility_applications', 'host_institution')) {
                $table->string('host_institution')->nullable()->after('mobility_type');
            }
            if (!Schema::hasColumn('mobility_applications', 'host_country')) {
                $table->string('host_country')->nullable()->after('host_institution');
            }
            if (!Schema::hasColumn('mobility_applications', 'mobility_start_date')) {
                $table->date('mobility_start_date')->nullable()->after('host_country');
            }
            if (!Schema::hasColumn('mobility_applications', 'mobility_end_date')) {
                $table->date('mobility_end_date')->nullable()->after('mobility_start_date');
            }
            if (!Schema::hasColumn('mobility_applications', 'student_declaration_name')) {
                $table->string('student_declaration_name')->nullable()->after('mobility_end_date');
            }
            if (!Schema::hasColumn('mobility_applications', 'student_declaration_matric')) {
                $table->string('student_declaration_matric')->nullable()->after('student_declaration_name');
            }
            if (!Schema::hasColumn('mobility_applications', 'student_declaration_date')) {
                $table->date('student_declaration_date')->nullable()->after('student_declaration_matric');
            }
            if (!Schema::hasColumn('mobility_applications', 'indemnity_file')) {
                $table->string('indemnity_file')->nullable()->after('student_declaration_date');
            }
        });
    }


    public function down()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn([
                'matric_no',
                'programme',
                'host_institution',
                'host_country',
                'mobility_start_date',
                'mobility_end_date',
                'student_declaration_name',
                'student_declaration_matric',
                'student_declaration_date',
                'indemnity_file'
            ]);
        });
    }
};

