<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_notification_logs', function (Blueprint $table) {
            $table->id();
           $table->string('notificationable_type');
            $table->integer('notificationable_id');
            $table->integer('type');
            $table->string('content');
            $table->string('phone_number');
            $table->string('status')->nullable();
            $table->string('status_code')->nullable();
            $table->string('status_text')->nullable();
            $table->json('sending_request')->nullable();
            $table->json('sending_response')->nullable();
            $table->json('webhook_response')->nullable();
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
        Schema::dropIfExists('sms_notification_logs');
    }
}
