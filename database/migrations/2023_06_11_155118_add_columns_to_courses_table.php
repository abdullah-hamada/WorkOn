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
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('trainer_id')->unsigned()->nullable();
            $table->foreign('trainer_id')->references('id')->on('trainers')->nullOnDelete();
            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')->on('services')->nullOnDelete();
            $table->integer('price_before_discount')->nullable();
            $table->integer('price_after_discount')->nullable();
            $table->string('promotional_video_image')->nullable();
            $table->string('promotional_video_title')->nullable();
            $table->string('promotional_video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
