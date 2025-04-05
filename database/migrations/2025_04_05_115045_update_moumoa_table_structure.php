<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mou_moas', function (Blueprint $table) {
            $table->renameColumn('university_name', 'collaborator');
            $table->renameColumn('start_date', 'signed_date');
            $table->renameColumn('end_date', 'expiry_date');
            $table->string('focal_person')->after('expiry_date');
            $table->enum('type', ['MoU', 'MoA'])->after('focal_person');
            $table->enum('impact', [
                'Medical – Research Collaboration',
                'General - Research Collaboration and Teaching & Learning',
                'Esport – Teaching & Learning',
                'General – Teaching & Learning',
                'Biometric-Computer-on-Card – Research Collaboration',
                'Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning',
                'Others'
            ])->after('type');
            $table->dropColumn('details'); // optional
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
