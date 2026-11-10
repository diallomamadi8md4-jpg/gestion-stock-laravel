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
        Schema::create('objectifs_commercials', function (Blueprint $table) {
            $table->id('obc_id');

            // Relation avec utilisateur
            $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                  ->references('uti_id')
                  ->on('utilisateurs')
                  ->cascadeOnDelete();

            // Relation avec produit (nullable pour objectifs globaux)
            $table->unsignedBigInteger('pro_id')->nullable();
            $table->foreign('pro_id')
                  ->references('pro_id')
                  ->on('produits')
                  ->cascadeOnDelete();

            // Champs de l'objectif
            $table->string('type')->default('ventes');
            $table->integer('quantite')->unsigned();
            $table->decimal('valeur_cible', 15, 2)->nullable(); // valeur monétaire optionnelle
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('etat')->default('en cours');
            $table->timestamps();
        });

        // Contraintes de validation
        DB::statement("ALTER TABLE objectifs_commercials ADD CONSTRAINT chk_obc_type CHECK (type IN ('ventes', 'visites', 'prospections'))");
        DB::statement("ALTER TABLE objectifs_commercials ADD CONSTRAINT chk_obc_etat CHECK (etat IN ('en cours', 'atteint', 'non atteint'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectifs_commercials');
    }
};
