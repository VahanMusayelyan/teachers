<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggest_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('gender_male')->nullable();
            $table->string('gender_female')->nullable();
            $table->string('exp_min')->nullable();
            $table->string('exp_med')->nullable();
            $table->string('exp_max')->nullable();
            $table->string('loc_proffes')->nullable();
            $table->string('loc_student')->nullable();
            $table->string('loc_online')->nullable();
            $table->string('pupil')->nullable();
            $table->string('student')->nullable();
            $table->string('adult')->nullable();
            $table->integer('price_min')->nullable();
            $table->integer('price_max')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('suggest_teachers');
    }
}
