<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_setting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id');
            $table->integer('jumlah_soal');
            $table->integer('waktu');
            $table->boolean('urutan_soal')->default(false);
            $table->boolean('urutan_pilihan')->default(false);
            $table->boolean('tampil_nilai')->default(false);
            $table->timestamps();


            $table->foreign('ujian_id')->references('id')->on('ujian')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_settings');
    }
}
