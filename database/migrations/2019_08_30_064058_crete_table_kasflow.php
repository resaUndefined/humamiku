<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteTableKasflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasflow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kas_id')->unsigned();
            $table->date('tanggal');
            $table->boolean('status')->default(1)->comment = '1 for debit, 0 for kredit';
            $table->string('nominal');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kas_id')->references('id')
                    ->on('kas')->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasflow');
    }
}
