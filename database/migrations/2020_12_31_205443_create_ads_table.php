<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.ghh
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ads_type')->nullable()->comment('1 = video, 0 = image');
            $table->integer('ads_position')->nullable()->comment('1 = home, 2 = loby_center, 3 = loby_right, 4 = loby_left, 5 = loby_bottom_right, 6 = loby_bottom_left, 12 = event_room');
            $table->string('image')->nullable();
            $table->string('video_link')->nullable();
            $table->tinyInteger('status')->nullable()->comment('1 = active, 0 = inactive');
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
        Schema::dropIfExists('ads');
    }
}
