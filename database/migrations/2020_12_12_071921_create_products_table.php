<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('stall_id')->nullable();
            $table->foreign('stall_id')->references('id')->on('stalls')->cascadeOnDelete();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->cascadeOnDelete();
            $table->unsignedBigInteger('product_sub_category_id')->nullable();
            $table->foreign('product_sub_category_id')->references('id')->on('product_sub_categories')->cascadeOnDelete();
            $table->string('product_name',200)->comment('product Name')->nullable();
            $table->string('product_code',200)->comment('product code')->nullable();
            $table->string('product_img',200)->comment('img')->nullable();
            $table->string('color',200)->nullable()->comment('color');
            $table->string('size',200)->nullable()->comment('size');
            $table->decimal('cost_price',9,2)->nullable()->comment('Cost Price');
            $table->decimal('selling_price',9,2)->nullable()->comment('selling Price');
            $table->decimal('wholesale_price',9,2)->nullable()->comment('Cost Price');
            $table->decimal('offer_price',9,2)->nullable()->comment('selling Price');
            $table->text('description')->nullable()->comment('stall_description');

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
        Schema::dropIfExists('products');
    }
}
