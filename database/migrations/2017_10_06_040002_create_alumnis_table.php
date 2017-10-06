<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('alumni_type', ['lay', 'ordained']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('diocese');
            $table->date('birthdate');
            $table->string('ordination');
            $table->string('years_in_sj');
            $table->string('address');
            $table->string('telephone_num');
            $table->string('fax_num');
            $table->string('mobile_num');
            $table->string('email');
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
        Schema::dropIfExists('alumnis');
    }
}
