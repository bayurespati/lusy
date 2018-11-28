<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('gender');
            $table->string('place_of_birth');
            $table->dateTime('date_of_birth');

            $table->string('telephone');
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->unique();

            $table->integer('teacher_id')->unsigned()->nullable();
            $table->dateTime('join_date')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_teacher');

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
        Schema::dropIfExists('members');
    }
}
