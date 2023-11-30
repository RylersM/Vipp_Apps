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
        Schema::create('videos_formation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_module');
            $table->foreign('id_module')->references('id')->on('modules');
            $table->string('titre');
            $table->string('url');
            $table->string('duree');
            $table->integer('ordre');
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
        Schema::dropIfExists('videos_formation');
    }
};
