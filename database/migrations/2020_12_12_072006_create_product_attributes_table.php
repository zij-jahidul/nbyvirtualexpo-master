<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->string('color',200)->nullable()->comment('color');
            $table->string('size',200)->nullable()->comment('size');
            $table->decimal('cost_price',9,2)->nullable()->comment('Cost Price');
            $table->decimal('selling_price',9,2)->nullable()->comment('selling Price');
            $table->decimal('wholesale_price',9,2)->nullable()->comment('Cost Price');
            $table->decimal('offer_price',9,2)->nullable()->comment('offer Price');
            $table->tinyInteger('status')->default('1')->comment('status 1=live;0=delete')->nullable();

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
        Schema::dropIfExists('product_attributes');
    }
}
