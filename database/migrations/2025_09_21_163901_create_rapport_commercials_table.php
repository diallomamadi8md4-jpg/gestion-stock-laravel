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
        Schema::create('rapport_commercials', function (Blueprint $table) {
           $table->id('rco_id');
            
           $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();

            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nbre_visite');
            $table->integer('nbre_vente');
            $table->integer('nbre_client');
            $table->string('statut')->default('en dessous');
        });

        DB::statement("ALTER TABLE rapport_commercials ADD CONSTRAINT chk_rco_statut CHECK (statut IN ('en dessous', 'conforme', 'superieur des attentes'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_commercials');
    }
};
