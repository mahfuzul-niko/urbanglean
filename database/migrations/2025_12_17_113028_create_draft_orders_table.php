<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();

            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('shipping_address')->nullable();

            $table->unsignedBigInteger('district_id')->nullable();

            $table->decimal('price', 10, 2)->default(0);

            $table->boolean('coupon_status')->default(false);
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount_amount', 10, 2)->default(0);

            $table->decimal('delivery_charge', 10, 2)->default(0);

            $table->decimal('total_payable', 10, 2)->default(0);

            $table->decimal('paid', 10, 2)->default(0);

            $table->text('note')->nullable();

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
        Schema::dropIfExists('draft_orders');
    }
}
