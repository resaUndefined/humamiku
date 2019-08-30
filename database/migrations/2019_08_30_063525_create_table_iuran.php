<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iuran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pertemuan_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('iuran')->nullable();
            $table->boolean('hadir')->default(1);
            $table->timestamps();

            $table->foreign('pertemuan_id')->references('id')
                    ->on('pertemuan')->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade')
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
        Schema::dropIfExists('iuran');
    }
}
