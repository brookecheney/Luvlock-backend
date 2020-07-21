<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->float("latitude",14,10)->nullable();
            $table->float("longitude",14,10)->nullable();
            $table->string('date_locked')->nullable();
            $table->string('names')->nullable();
            $table->string('lock_icon')->nullable();
            $table->string('lock_image_url')->nullable();
            $table->text('message')->nullable();
            $table->smallInteger('status')->default(10);
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
        Schema::dropIfExists('locks');
    }
}
