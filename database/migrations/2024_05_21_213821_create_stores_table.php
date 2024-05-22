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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('');
            $table->text('description');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('postal_code');
            $table->string('address');
            $table->string('phone_number')->nullable();
            $table->string('holidays')->nullable();
            $table->string('homepage')->nullable();
            $table->float('latitude', 10, 8)->nullable();
            $table->float('longitude', 11, 8)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
