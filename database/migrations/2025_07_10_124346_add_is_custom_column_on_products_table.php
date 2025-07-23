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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_custom')->default(0);
            $table->integer('price_per_size')->nullable();
            // $table->json('sizes')->nullable()->change();
            // $table->json('prices')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_custom');
            $table->dropColumn('price_per_size');
            // $table->json('sizes')->change();
            // $table->json('prices')->change();
        });
    }
};
