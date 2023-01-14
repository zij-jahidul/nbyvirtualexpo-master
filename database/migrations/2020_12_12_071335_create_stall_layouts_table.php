<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stall_layouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_sub_category_id');
            $table->foreign('event_sub_category_id')->references('id')->on('event_sub_categories')->cascadeOnDelete();
            $table->string('layout_name',300)->comment('layout Name')->nullable();
            $table->text('layout_img')->nullable()->comment('layout img')->nullable();
            $table->string('layout_color',300)->nullable()->comment('layout color')->nullable();
            $table->string('layout_size',300)->nullable()->comment('layout size')->nullable();
            $table->text('layout_description')->nullable()->comment('layout desc')->nullable();
            $table->tinyInteger('status')->default('1')->comment('status 1=live;0=delete')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('stall_layouts');
    }
}
