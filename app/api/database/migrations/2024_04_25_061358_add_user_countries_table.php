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
        Schema::create('user_countries', function(Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('country_name');

            $table->foreign('user_id', 'u_country_fk')->on('users')->references('id')->onDelete('cascade');
            $table->unique(['country_name', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_countries');
    }
};
