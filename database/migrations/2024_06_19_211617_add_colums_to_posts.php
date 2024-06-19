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
        Schema::disableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {

            $table->foreignId('store_id')->constrained()->after('user_id');
            $table->foreignId('item_id')->constrained()->after('store_id');
            $table->dropColumn('item_store_id');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('store_id');
            $table->dropColumn('item_id');
            $table->foreignId('item_store_id');
        });
    }
};
