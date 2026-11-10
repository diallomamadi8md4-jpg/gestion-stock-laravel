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
        Schema::create('photo_concurrences', function (Blueprint $table) {
            $table->id('pco_id');
            
            $table->unsignedBigInteger('aco_id');
            $table->foreign('aco_id')
                    ->references('aco_id')
                    ->on('activite_concurrentielles')
                    ->cascadeOnDelete();

            $table->string('photo_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_concurrences');
    }
};
