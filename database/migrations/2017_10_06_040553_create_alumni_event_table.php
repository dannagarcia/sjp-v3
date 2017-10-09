<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_event', function (Blueprint $table) {
            $table->integer('alumni_id')->unsigned()->nullable();
            // $table->foreign('alumni_id')->references('id')->on('alumnis')->onDelete('cascade');

            $table->integer('event_id')->unsigned()->nullable();
            // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

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
        Schema::dropIfExists('alumni_event');
    }
}
