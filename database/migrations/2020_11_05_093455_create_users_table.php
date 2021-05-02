<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->date('b_day')->nullable();
            $table->string('phone')->nullable();
            $table->string('img')->nullable();
            $table->string('country_id')->nullable();
            $table->string('region_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('education')->nullable();
            $table->float('work_exp')->nullable();
            $table->text('description')->nullable();
            $table->integer('user_active')->default(1);
            $table->string('user_north')->default('40.177200');
            $table->string('user_east')->default('44.503490');
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
        Schema::dropIfExists('users');
    }
}
