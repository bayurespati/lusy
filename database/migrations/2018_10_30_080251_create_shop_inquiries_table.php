<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_item_id')->unsigned()->nullable();
            $table->string('buyer_name');
            $table->boolean('gender');
            $table->string('address');
            $table->string('email');
            $table->string('city');
            $table->string('state_province');
            $table->string('postal_code');
            $table->text('notes');
            $table->integer('stock');
            $table->date('date');
            $table->boolean('is_confirmed');
            $table->timestamps();

            $table->foreign('shop_item_id')->references('id')->on('shop_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_inquiries');
    }
}
