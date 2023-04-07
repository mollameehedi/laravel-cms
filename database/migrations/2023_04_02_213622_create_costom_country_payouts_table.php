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
        Schema::create('costom_country_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->foreignId('user_id');
            $table->foreignId('offer_id');
            $table->float('revenue');
            $table->float('payout');
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
        Schema::dropIfExists('costom_country_payouts');
    }
};
