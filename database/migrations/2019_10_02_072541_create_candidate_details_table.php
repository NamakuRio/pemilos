<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('candidate_id')->unsigned();
            $table->string('name');
            $table->string('class');
            $table->string('majors');
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('picture');
            $table->enum('type', ['ketua', 'wakil']);
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_details');
    }
}
