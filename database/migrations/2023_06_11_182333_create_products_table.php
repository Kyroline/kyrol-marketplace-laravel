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
        Schema::create('products', function (Blueprint $table) {
            $table->string('store_id')->index();
            $table->string('product_id', 30)->primary();
            $table->string('product_name');
            $table->string('description')->nullable();
            $table->string('image');
            $table->timestamps();

            $table->foreign('store_id')
                  ->references('store_id')
                  ->on('stores')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
};
