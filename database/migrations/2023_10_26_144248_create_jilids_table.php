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
        Schema::create('jilids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('jenis_pengumpulan');
            $table->string('judul');
            $table->integer('page_berwarna');
            $table->integer('page_hitamPutih');
            $table->integer('exemplar');
            $table->integer('soft_jilid');
            $table->integer('hard_jilid');
            $table->integer('total');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('file');
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('jilids');
    }
};
