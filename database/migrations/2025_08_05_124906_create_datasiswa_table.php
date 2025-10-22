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
        Schema::create('datasiswa', function (Blueprint $table) {
    $table->id('idsiswa'); // primary key custom
    $table->string('nama');
    $table->integer('tb');
    $table->float('bb');
    $table->timestamps();

    $table->unsignedBigInteger('admin_id')->nullable();
    $table->foreign('admin_id')
          ->references('id')
          ->on('dataadmin')
          ->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasiswa');
    }
};
