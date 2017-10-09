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
            $table->string('diocese')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('ordination')->nullable();
            $table->string('years_in_sj')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone_num')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('mobile_num')->nullable();
            $table->string('email')->nullable();
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
