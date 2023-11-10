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
        Schema::create('user_subscribes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
//            $table->string('name');
//            $table->string('email');
//            $table->string('whatsapp_number');
//            $table->string('job_title')->nullable();
//             $table->string('user_type');
//            $table->string('employment_area');
//            $table->string('website_url')->nullable();
//            $table->string('facebook_url')->nullable();
//            $table->string('instagram_url')->nullable();
//            $table->string('linkedIn_url')->nullable();
//            $table->string('image');
            $table->text('charge_id')->nullable();
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
        Schema::dropIfExists('user_subscribes');
    }
};
