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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id');
            $table->foreignId('user_id');
            $table->foreignId('country_id');
            $table->string('status')->default('click');
            $table->boolean('unique')->default(0);
            $table->string('source')->nullable();
            $table->string('aff_sub_1')->nullable();
            $table->string('aff_sub_2')->nullable();
            $table->string('aff_sub_3')->nullable();
            $table->string('os_name')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('os_version')->nullable();
            $table->string('device_brand')->nullable();
            $table->string('device_model')->nullable();
            $table->string('ip_address');
            $table->string('geo_city')->nullable();
            $table->string('geo_region')->nullable();
            $table->float('revenue')->nullable();
            $table->float('payout')->nullable();
            $table->float('profit')->nullable();
            $table->string('click_id');
            $table->string('aff_click_id')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('reports');
    }
};
