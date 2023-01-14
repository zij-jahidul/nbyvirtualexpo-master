<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictStallPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_stall', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stall_id');
            $table->unsignedBigInteger('district_id');
            $table->timestamps();
            $table->foreign('stall_id')->references('id')->on('stalls')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('district_id')->references('id')->on('districts')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_stall');
    }
}
