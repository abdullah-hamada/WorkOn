<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();

            $table->integer('partner_order_id')->unsigned()->nullable();
            $table->foreign('partner_order_id')->references('id')->on('partner_orders')->nullOnDelete();
            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')->on('partner_services')->nullOnDelete();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->integer('status');
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
        Schema::dropIfExists('service_orders');
    }
};
