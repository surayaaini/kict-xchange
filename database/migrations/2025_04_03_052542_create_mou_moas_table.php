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
        Schema::create('mou_moas', function (Blueprint $table) {
            $table->id();
            $table->string('collaborator'); // formerly 'university_name'
            $table->date('signed_date');    // formerly 'start_date'
            $table->date('expiry_date')->nullable(); // formerly 'end_date'
            $table->string('focal_person');
            $table->enum('type', ['MoU', 'MoA']); // dropdown
            $table->enum('impact', [
                'Medical – Research Collaboration',
                'General - Research Collaboration and Teaching & Learning',
                'Esport – Teaching & Learning',
                'General – Teaching & Learning',
                'Biometric-Computer-on-Card – Research Collaboration',
                'Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning'
            ]); // dropdown
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mou_moas');
    }
};
