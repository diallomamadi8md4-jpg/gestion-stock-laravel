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
        // On crée la table 'utilisateurs'
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('uti_id');
            $table->string('uti_nom');
            $table->string('uti_prenom');
            $table->string('uti_email')->unique();
            $table->string('uti_password');
            $table->string('role')->default('client');
            $table->string('uti_telephone')->nullable();
            $table->string('etat')->default('actif');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE utilisateurs ADD CONSTRAINT check_role CHECK (role IN ('admin', 'gestionnaire', 'client'))");
        DB::statement("ALTER TABLE utilisateurs ADD CONSTRAINT check_etat CHECK (etat IN ('actif', 'inactif', 'supprimé'))");

        // Ces deux tables sont liées à la table utilisateurs, on les garde et on met à jour les références
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // On fait pointer la clé étrangère vers notre nouvelle table et clé primaire
            $table->foreignid('user_id')->nullable()->index()->constrained('utilisateurs', 'uti_id');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};