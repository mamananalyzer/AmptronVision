<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id('id_account');
            $table->string('application');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('phonenumber');
            $table->string('registrationDate');
            $table->string('isActive');
            $table->string('link');
            $table->string('image');
            $table->timestamp('join_date');
            // $table->timestamp('expire_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
    }
};
