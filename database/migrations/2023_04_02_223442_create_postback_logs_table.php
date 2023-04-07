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
        Schema::create('postback_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('offer_id')->nullable();
            $table->foreignId('country_id');
            $table->longText('ip_address');
            $table->longText('url');
            $table->longText('user_agent')->nullable();
            $table->longText('referrer')->nullable();
            $table->string('status')->default('pending');
            $table->date('date');
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
        Schema::dropIfExists('postback_logs');
    }
};
