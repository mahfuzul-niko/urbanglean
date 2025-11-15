<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_histories', function (Blueprint $table) {
            $table->id();

            $table->string('sms_count')->default(1)->nullable();
            $table->string('length')->nullable();
            $table->string('send_to')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('info')->nullable();

            $table->integer('status_code')->nullable();
            $table->string('status',16)->nullable();
            $table->string('response_result')->nullable();
            $table->string('trxn_id',32)->nullable();
            $table->string('sms_type',2)->nullable();

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
        Schema::dropIfExists('sms_histories');
    }
}
