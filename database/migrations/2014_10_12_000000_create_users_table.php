<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('enseigne')->nullable();
            $table->string('pays')->nullable();
            $table->string('prefixe')->nullable();
            $table->string('telephone')->nullable();
            $table->enum('role', ['admin', 'entreprise', 'employe']);
            $table->string('nombre_utilisateurs_requis')->nullable();
            $table->unsignedBigInteger('entreprise_id')->nullable(); // Clé étrangère pour lier les employés à une entreprise
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
