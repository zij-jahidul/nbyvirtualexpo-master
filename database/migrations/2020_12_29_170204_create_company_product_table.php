<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('company_product', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('company_id');
           $table->unsignedBigInteger('product_id');
           $table->timestamps();
           $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
           $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('company_product', function (Blueprint $table) {
            //
        });
    }
}
