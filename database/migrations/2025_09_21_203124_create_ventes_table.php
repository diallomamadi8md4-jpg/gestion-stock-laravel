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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('ven_id');
            
            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                    ->references('pve_id')
                    ->on('point_ventes')
                    ->cascadeOnDelete();
            
            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')
                    ->references('pro_id')
                    ->on('produits')
                    ->cascadeOnDelete();

            $table->integer('quantite')->unsigned();
            $table->decimal('prix_unitaire', 10, 2); 
            $table->decimal('prix_total', 10, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
