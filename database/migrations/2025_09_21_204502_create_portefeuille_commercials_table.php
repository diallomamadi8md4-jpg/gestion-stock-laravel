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
        Schema::create('portefeuille_commercials', function (Blueprint $table) {
            $table->id('pfc_id');
            
            $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();

            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                    ->references('pve_id')
                    ->on('point_ventes')
                    ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portefeuille_commercials');
    }
};
