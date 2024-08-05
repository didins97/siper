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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->string('order_number', 50);
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('phone', 25);
            $table->string('size', 25);
            $table->integer('price');
            $table->integer('qty');
            $table->date('expected_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('path_file')->nullable();
            $table->string('url_file')->nullable();
            $table->integer('total_amount');
            $table->enum('status', ['pending', 'inprogress', 'completed', 'cancelled']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
