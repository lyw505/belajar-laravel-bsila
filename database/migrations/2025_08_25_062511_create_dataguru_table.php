<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataguru', function (Blueprint $table) {
            $table->id('idguru');
            $table->string('nama');
            $table->string('mapel');
            $table->unsignedBigInteger('id')->nullable(); // biar bisa kosong
            $table->foreign('id')->references('id')->on('dataadmin')->onDelete('cascade');
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
        Schema::dropIfExists('dataguru');
    }
};
