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
        Schema::create('partner_orders', function (Blueprint $table) {
            $table->increments('id');
             $table->string('email')->unique();
             $table->string('whatsapp_number');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();
            $table->string('city')->nullable();

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

            $table->integer('partner_category_id')->unsigned()->nullable();
            $table->foreign('partner_category_id')->references('id')->on('partner_categories')->nullOnDelete();


            $table->string('company_name');
            $table->string('employment_filed');
            $table->text('company_info');
            $table->string('website_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linked_in_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('logo');
            $table->string('slugn')->nullable();
             $table->string('communication_officer');
             $table->string('address');
             $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->integer('cancel_order_request')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('partner_orders');
    }
};
