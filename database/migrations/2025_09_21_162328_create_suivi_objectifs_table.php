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
        Schema::create('suivi_objectifs', function (Blueprint $table) {
            $table->id('sob_id');
            
            $table->unsignedBigInteger('obc_id');
            $table->foreign('obc_id')
                    ->references('obc_id')
                    ->on('objectifs_commercials')
                    ->cascadeOnDelete();

            $table->date('date_suivi')->nullable();
            $table->integer('quantite_realisee')->nullable();
            $table->decimal('valeur_realisee', 10, 2)->nullable();
            $table->text('commentaire')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_objectifs');
    }
};
