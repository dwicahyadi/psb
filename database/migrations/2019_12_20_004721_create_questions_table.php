<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subjects');
            $table->string('question',255);
            $table->string('question_image',255)->nullable();
            $table->string('option_a',255);
            $table->string('option_b',255);
            $table->string('option_c',255);
            $table->string('option_d',255);
            $table->string('answer',1);
            $table->integer('score')->default(1);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('questions');
    }
}
