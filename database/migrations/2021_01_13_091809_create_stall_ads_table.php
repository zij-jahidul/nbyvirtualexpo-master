<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallAdsTable extends Migration
{
    /**
     * Run the migrations.gff
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stall_ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stall_id');
            $table->foreign('stall_id')->references('id')->on('stalls');
            $table->text('ads')->nullable()->comment('stall_announcement');
            $table->tinyInteger('ads_type')->nullable()->comment('1 = video, 0 = image');
            $table->integer('ads_position')->nullable()->comment('1 = center, 2 = sponsor, 3 = small_right, 4 = big_right, 5 = small_left, 6 = big_left');
            $table->string('image')->nullable();
            $table->text('video_link')->nullable();
            $table->tinyInteger('status')->nullable()->comment('1 = active, 0 = inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
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
        Schema::dropIfExists('stall_ads');
    }
}
