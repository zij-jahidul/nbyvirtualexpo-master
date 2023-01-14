<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('stall_layout_id')->nullable();
            $table->foreign('stall_layout_id')->references('id')->on('stall_layouts')->cascadeOnDelete();
            $table->unsignedBigInteger('event_sub_category_id')->nullable();
            $table->foreign('event_sub_category_id')->references('id')->on('event_sub_categories')->cascadeOnDelete();
            $table->string('stall_name',300)->comment('stall Name')->nullable();
            $table->string('brand_name',300)->nullable()->comment('brand name');
            $table->string('manufacturer_name',300)->nullable()->comment('manufact name');
            
            $table->time('open_time')->nullable()->comment('start time');
            $table->time('close_time')->nullable()->comment('close time');
            $table->string('stall_brochure',100)->nullable()->comment('stall_brochure');
            $table->text('stall_description')->nullable()->comment('stall_description');
            $table->text('stall_live_boardcust')->nullable()->comment('bannner');
            $table->text('stall_announcement')->nullable()->comment('stall_announcement');
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
        Schema::dropIfExists('stalls');
    }
}
