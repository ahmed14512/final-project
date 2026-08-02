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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name', 255)->after('user_id');
        });

         DB::statement("UPDATE orders
                       SET name = CONCAT(first_name, ' ', last_name)");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name')->after('user_id');
            $table->string('last_name')->after('first_name');
        });
         DB::statement("UPDATE orders
                       SET first_name = SUBSTRING_INDEX(name, ' ', 1),
                           last_name  = SUBSTRING_INDEX(name, ' ', -1)");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
