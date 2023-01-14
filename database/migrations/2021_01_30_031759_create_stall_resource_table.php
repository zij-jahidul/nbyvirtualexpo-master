<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stall_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('resource_file_name')->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('stall_id');
            $table->timestamps();
            $table->foreign('stall_id')->references('id')->on('stalls')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stall_resources');
    }
}
