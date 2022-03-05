<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 191)->unique();
            $table->bigInteger('phone')->unique();
            $table->bigInteger('organization_id')->nullable();
            $table->bigInteger('owner_id')->nullable();
            $table->bigInteger('subowner_id')->nullable();
            $table->tinyInteger('visiblity');
            $table->text('address');
            $table->string('directory',50)->nullable();
            $table->string('image',255)->nullable();
            $table->string('status')->default('active');
            $table->tinyInteger('email_verified_status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
