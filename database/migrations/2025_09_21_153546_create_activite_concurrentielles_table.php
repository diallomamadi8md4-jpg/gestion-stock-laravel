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
        Schema::create('activite_concurrentielles', function (Blueprint $table) {
            $table->id('aco_id');
            
            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                    ->references('pve_id')
                    ->on('point_ventes')
                    ->cascadeOnDelete();

            $table->string('aco_nom');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_concurrentielles');
    }
};
