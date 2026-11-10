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
        Schema::create('rapport_ventes', function (Blueprint $table) {
            $table->id('rve_id');
            
            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                    ->references('pve_id')
                    ->on('point_ventes')
                    ->cascadeOnDelete();

            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('total', 10, 2);
            $table->integer('nb_ventes')->default(0);
            $table->integer('quantite_totale')->default(0);
            $table->string('statut')->default('provisoire');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_ventes');
    }
};
