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
        Schema::create('commandes', function (Blueprint $table) {
            // Clé primaire
            $table->id('com_id');

            // Relation avec point de vente
            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                  ->references('pve_id')
                  ->on('point_ventes')
                  ->cascadeOnDelete();

            // Relation avec produit
            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')
                  ->references('pro_id')
                  ->on('produits')
                  ->cascadeOnDelete();

            // Données de la commande
            $table->integer('quantite')->unsigned();
            $table->decimal('prix_total', 10, 2)->nullable();

            // Dates
            $table->timestamp('date_commande')->useCurrent();
            $table->timestamp('date_livraison')->nullable();

            // État de la commande (enum)
            $table->enum('etat', ['en attente', 'livré', 'annulé'])->default('en attente');

            // Timestamps Laravel
            $table->timestamps();

            // Index pour optimiser les recherches
            $table->index(['pve_id', 'pro_id', 'etat']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
