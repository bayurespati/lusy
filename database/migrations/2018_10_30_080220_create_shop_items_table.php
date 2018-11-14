<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('sub_title');
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->double('price');
            $table->string('store_link')->nullable();
            $table->boolean('is_displayed');
            $table->boolean('is_showcase');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_items');
    }
}
