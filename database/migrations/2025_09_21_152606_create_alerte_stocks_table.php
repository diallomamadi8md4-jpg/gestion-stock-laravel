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
        Schema::create('alerte_stocks', function (Blueprint $table) {
            $table->id('als_id');
            
            $table->unsignedBigInteger('sto_id');
            $table->foreign('sto_id')
                    ->references('sto_id')
                    ->on('stocks')
                    ->cascadeOnDelete();

            $table->timestamp('date_alerte')->useCurrent();
            $table->string('type')->default('rupture');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE alerte_stocks ADD CONSTRAINT check_als_type CHECK (type IN ('stock faible', 'rupture', 'sur stock'))");
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerte_stocks');
    }
};
