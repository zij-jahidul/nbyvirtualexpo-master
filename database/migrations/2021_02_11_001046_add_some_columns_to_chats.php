<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToChats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dateTime('chat_time')->nullable();
            $table->string('message_class')->nullable();
            $table->bigInteger('receiver_id')->nullable();
            $table->string('user_name')->nullable();
            $table->text('user_photo')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn('chat_time');
            $table->dropColumn('message_class');
            $table->dropColumn('receiver_id');
            $table->dropColumn('user_name');
            $table->dropColumn('user_photo');
        });
    }
}
