<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_cost')->nullable();
            $table->string('tax_cost')->nullable();
            $table->string('offer')->nullable();
            $table->unsignedBigInteger('stall_id')->nullable();
            $table->timestamps();
            $table->foreign('stall_id')->references('id')->on('stalls')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
