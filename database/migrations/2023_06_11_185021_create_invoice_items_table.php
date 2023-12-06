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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->string('invoice_id')->index();
            $table->string('product_id')->index();
            $table->string('variant_id')->index();
            $table->string('invoice_item_id')->primary();
            $table->smallInteger('qty');
            $table->double('price');

            $table->foreign('invoice_id')
                  ->references('invoice_id')
                  ->on('invoices')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->foreign('variant_id')
                  ->references('variant_id')
                  ->on('product_variants')
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
        Schema::dropIfExists('invoice_items');
    }
};
