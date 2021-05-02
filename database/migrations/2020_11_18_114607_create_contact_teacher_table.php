<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name_lname')->nullable();
            $table->string('phone')->nullable();
            $table->integer('resend')->default(0);
            $table->integer('subject_id')->default(0);
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
        Schema::dropIfExists('contact_teacher');
    }
}
