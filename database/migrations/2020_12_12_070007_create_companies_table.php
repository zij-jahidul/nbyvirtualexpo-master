<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_sub_category_id');
            $table->foreign('event_sub_category_id')->references('id')->on('event_sub_categories')->cascadeOnDelete();
            $table->string('company_name',200)->comment('company Name')->nullable();
            $table->text('company_img')->comment('img')->nullable();
            $table->text('company_description')->comment('company_description')->nullable();
            $table->date('company_expire_date')->comment('company_expire_date')->nullable();
            $table->tinyInteger ('status')->default('1')->comment('status 1=live;0=delete')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
