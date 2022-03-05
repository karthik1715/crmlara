<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id');
            $table->string('sender_name', 100);
            $table->string('sender_email', 100);
            $table->tinyInteger('sender_reply_email_status')->default(0);
            $table->string('sender_reply_email', 100)->nullable();
            $table->tinyInteger('sender_email_service_type')->default(0);
            $table->tinyInteger('schedule_status')->default(0);
            $table->timestamp('schedule_datetime')->nullable();
            $table->text('template_content')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_details');
    }
}
