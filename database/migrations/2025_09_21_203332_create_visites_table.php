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
        Schema::create('visites', function (Blueprint $table) {
            $table->id('vis_id');
            
            $table->unsignedBigInteger('uti_id');
            $table->foreign('uti_id')
                    ->references('uti_id')
                    ->on('utilisateurs')
                    ->cascadeOnDelete();

            $table->unsignedBigInteger('pve_id');
            $table->foreign('pve_id')
                    ->references('pve_id')
                    ->on('point_ventes')
                    ->cascadeOnDelete();

            $table->date('date_planifié');
            $table->date('date_effectué');
            $table->string('etat')->default('planifié');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE visites ADD CONSTRAINT check_vis_etat CHECK (etat IN ('planifié', 'effectué', 'annulé'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
