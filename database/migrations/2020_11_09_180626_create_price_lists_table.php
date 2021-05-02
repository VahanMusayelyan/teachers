<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('subject_id');
            $table->string('location_user')->nullable();
            $table->string('location_student')->nullable();
            $table->string('location_online')->nullable();
            $table->integer('price_user')->nullable();
            $table->integer('price_student')->nullable();
            $table->integer('price_online')->nullable();
            $table->string('duration_user')->nullable();
            $table->string('duration_student')->nullable();
            $table->string('duration_online')->nullable();
            $table->string('pupil')->nullable();
            $table->string('student')->nullable();
            $table->string('adult')->nullable();
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
        Schema::dropIfExists('price_lists');
    }
}
