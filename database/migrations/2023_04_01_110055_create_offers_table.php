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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');;
            $table->foreignId('advertiser_id')
                ->constrained('advertisers')
                ->onDelete('cascade');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('preview')->nullable();
            $table->string('url');
            $table->string('type');
            $table->float('revenue');
            $table->float('payout');
            $table->boolean('conversion_status')->default(true);
            $table->integer('alt_offer_id')->nullable();
            $table->string('daily_cap')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('offers');
    }
};
