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
        Schema::create('info_educationals', function (Blueprint $table) {
            $table->id();
            $table->integer('qualification')->nullable();
            $table->string('institute_name')->nullable();
            $table->date('passing_year')->nullable();
            $table->integer('grade')->nullable();
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
        Schema::dropIfExists('info_educationals');
    }
};
