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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['Admin', 'Advertiser', 'Manager', 'Affiliate'])->default('Affiliate');
            $table->string('status')->default('Pending');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('country');
            $table->string('skype');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('manager_id')->nullable();
            $table->integer('refer_id')->nullable();
            $table->float('balance')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
