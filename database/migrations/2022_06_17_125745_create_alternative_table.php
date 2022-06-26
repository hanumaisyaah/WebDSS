<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_mahasiswa');
            $table->double('grade');
            $table->string('major');
            $table->double('gpa');
            $table->double('skkm');
            $table->integer('parent_salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternative');
    }
}
