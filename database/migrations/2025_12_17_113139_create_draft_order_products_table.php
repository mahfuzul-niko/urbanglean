<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('draft_order_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->double('price');
            $table->unsignedInteger('qty');
            $table->double('total');
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
        Schema::dropIfExists('draft_order_products');
    }
}
