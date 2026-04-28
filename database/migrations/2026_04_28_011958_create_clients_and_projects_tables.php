<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_clients_and_projects_tables.php

public function up()
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nom de l'entreprise (ex: Sea Fast Boat)
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('contact_name'); // Nom du chef de projet
        $table->timestamps();
    });

    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Nom du projet (ex: Site Vitrine 2024)
        $table->string('domain')->nullable(); // ex: seafastboat.fr
        $table->string('token')->unique(); // Le token sécurisé pour le lien onboarding
        $table->enum('status', ['draft', 'onboarding', 'developing', 'live'])->default('draft');

        // C'EST LA COLONNE MAGIQUE : Elle stockera TOUTES les infos du questionnaire
        $table->json('data')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('clients');
    }
};
