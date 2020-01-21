<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('major_id')->nullable();
            $table->string('full_name',191);
            $table->string('nisn', 20)->unique();
            $table->string('school_origin', 191);
            $table->float('nem');
            $table->string('sex',1)->nullable()->default('L');
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('photo',191)->nullable();
            $table->string('ijazah_file',191)->nullable();
            $table->string('nisn_file',191)->nullable();
            $table->string('skl_file',191)->nullable();
            $table->date('test_schedule')->nullable();
            $table->boolean('test_access')->default(false);
            $table->string('school_year',9)->nullable();
            $table->boolean('be_accepted')->default(false);
            $table->boolean('document_pass')->default(false);
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
        Schema::dropIfExists('candidates');
    }
}
