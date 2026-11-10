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
        Schema::create('prospections', function (Blueprint $table) {
            $table->id('prp_id');
            
            $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();

            $table->string('npvp');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('statut')->default('en cours');
            $table->text('remarques');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE prospections ADD CONSTRAINT chk_prp_statut CHECK (statut IN ('en cours', 'validé', 'rejeté', 'en dessous'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospections');
    }
};
