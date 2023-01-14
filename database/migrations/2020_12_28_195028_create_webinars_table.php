<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('speaker')->nullable();
            $table->string('meet_pass')->nullable();
            $table->tinyInteger('schedule_type')->nullable();
            $table->text('topic')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('recurrance')->nullable()->comment('1 = Daily, 2 = Weekly, 3 = Monthly');
            $table->tinyInteger('day_dt')->nullable()->comment('Numeric representation of day and week');
            $table->integer('repeat_every')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->timestamp('class_date_end_time')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->integer('d_hour')->nullable();
            $table->integer('d_min')->nullable();
            $table->string('meeting_id')->nullable();
            $table->integer('total_meeting')->nullable();
            $table->text('host_id')->nullable();
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();
            $table->tinyInteger('cancel_status')->nullable();
            $table->string('timezone')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('webinars');
    }
}
