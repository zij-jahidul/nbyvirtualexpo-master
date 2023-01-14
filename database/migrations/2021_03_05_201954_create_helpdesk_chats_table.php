<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpdeskChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('message')->nullable();
            $table->text('chat_document')->nullable();
            $table->dateTime('chat_time')->nullable();
            $table->string('message_class')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->string('user_name')->nullable();
            $table->text('user_photo')->nullable();
            $table->tinyInteger('message_reading')->nullable();
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
        Schema::dropIfExists('helpdesk_chats');
    }
}
