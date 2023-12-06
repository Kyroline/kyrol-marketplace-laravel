<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {      
            $table->string('cart_id')->index();
            $table->string('variant_id')->index();
            $table->integer('qty');

            $table->foreign('cart_id')
                 ->references('cart_id')
                 ->on('carts')
                 ->onDelete('cascade');
                  
            $table->foreign('variant_id')
                 ->references('variant_id')
                 ->on('product_variants')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
