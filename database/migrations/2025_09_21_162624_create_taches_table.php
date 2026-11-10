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
        Schema::create('taches', function (Blueprint $table) {
           $table->id('tac_id');
            
           $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();

            $table->text('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('etat')->default('en cours');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE taches ADD CONSTRAINT chk_tac_etat CHECK (etat IN ('en cours', 'terminé', 'en reatard'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
