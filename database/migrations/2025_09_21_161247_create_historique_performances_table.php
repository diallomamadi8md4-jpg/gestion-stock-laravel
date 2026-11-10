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
        Schema::create('historique_performances', function (Blueprint $table) {
            $table->id('hpe_id');
            
            $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();
            
            $table->string('type')->default('vente');
            $table->decimal('valeur', 8, 2);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE historique_performances ADD CONSTRAINT chk_hpe_type CHECK (type IN ('ventes', 'visites', 'objectifs atteint'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_performances');
    }
};
