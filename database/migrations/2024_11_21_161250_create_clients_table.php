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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->index();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->string('cui');
            $table->string('denumire');
            $table->string('regcom');
            $table->string('cod_client')->nullable();
            $table->boolean('platitor_tva')->default(true);
            $table->string('adresa');
            $table->string('tara');
            $table->string('judet');
            $table->string('localitate')->nullable();
            $table->string('iban')->nullable();
            $table->string('banca')->nullable();
            $table->string('email')->nullable();
            $table->string('persoana_de_contact')->nullable();
            $table->string('telefon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
