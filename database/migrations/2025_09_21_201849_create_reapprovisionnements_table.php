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
        Schema::create('reapprovisionnements', function (Blueprint $table) {
             $table->id('rea_id');
            
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
            $table->string('type')->default('automatique');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE reapprovisionnements ADD CONSTRAINT check_rea_type CHECK (type IN ('automatique', 'manuel'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reapprovisionnements');
    }
};
