<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('supplier_id')->nullable();
            $table->text('product_name');
            $table->text('product_code');
            $table->text('root')->nullable();
            $table->text('image');
            $table->text('buying_price');
            $table->text('selling_price');
            $table->text('buying_date')->nullable();
            $table->text('product_quentity');
            $table->text('product_expiredate')->nullable();
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
        Schema::dropIfExists('products');
    }
}
