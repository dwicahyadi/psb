<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCandidates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates',function (Blueprint $table){
           $table->string('parent_name',191)->nullable();
           $table->string('parent_job',191)->nullable();
           $table->string('parent_phone',50)->nullable();
           $table->integer('number_of_siblings')->nullable();
           // $table->renameColumn('sex','gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates',function (Blueprint $table){
            $table->dropColumn('parent_name');
            $table->dropColumn('parent_job');
            $table->dropColumn('parent_phone');
            $table->dropColumn('number_of_siblings');
            // $table->renameColumn('gender','sex');

        });
    }
}
