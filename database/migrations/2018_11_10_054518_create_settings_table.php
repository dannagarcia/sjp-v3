<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Setting;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string("key");
            $table->text("value"); // Usually a JSON string
            $table->timestamps();
        });

        $defaultIdSettings = Setting::getDefaultIdSettings();


        DB::table('settings')->insert([
            'id' => 1,
            'key' => "id",
            'value' => json_encode($defaultIdSettings),
            'updated_at' => date('Y-m-d'),
            'created_at' => date('Y-m-d'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
