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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_proof')->nullable();
        });

        \DB::statement("ALTER TABLE orders MODIFY status ENUM('menunggu_pembayaran', 'pending', 'inprogress', 'completed', 'cancelled') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });

        \DB::statement("ALTER TABLE orders MODIFY status ENUM('pending', 'inprogress', 'completed', 'cancelled') NOT NULL");
    }
};
