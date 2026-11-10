<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('point_ventes', function (Blueprint $table) {
            $table->id('pve_id');
            $table->string('pve_nom');
            $table->string('pve_adresse');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('etat')->default('actif');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE point_ventes ADD CONSTRAINT check_etat CHECK (etat IN ('actif', 'inactif', 'fermé'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_ventes');
    }
};
