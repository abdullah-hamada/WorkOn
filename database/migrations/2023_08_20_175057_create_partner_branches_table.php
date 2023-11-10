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
        Schema::create('partner_branches', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('address');

            $table->string('location');
            $table->integer('partner_order_id')->unsigned()->nullable();
            $table->foreign('partner_order_id')->references('id')->on('partner_orders')->nullOnDelete();

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
        Schema::dropIfExists('partner_branches');
    }
};
