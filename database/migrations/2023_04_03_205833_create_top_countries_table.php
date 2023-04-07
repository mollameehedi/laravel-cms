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
        Schema::create('top_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->integer('click')->default('0');
            $table->integer('conversion')->default('0');
            $table->float('revenue')->default('0');
            $table->float('payout')->default('0');
            $table->float('profit')->default('0');
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
        Schema::dropIfExists('top_countries');
    }
};
