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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('name');
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('courier');
            $table->string('service');
            $table->float('fee');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('address');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('courier');
            $table->dropColumn('service');
            $table->dropColumn('fee');
            $table->dropColumn('status');
        });
    }
};
