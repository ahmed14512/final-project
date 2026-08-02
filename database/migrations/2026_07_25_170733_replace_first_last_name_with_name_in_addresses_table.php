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
        Schema::table('addresses', function (Blueprint $table) {
           $table->string('name', 255)->after('user_id');
        });

        DB::statement("UPDATE addresses
                       SET name = CONCAT(first_name, ' ', last_name)");

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('first_name', 100)->after('user_id');
            $table->string('last_name', 100)->after('first_name');
        });

        DB::statement("UPDATE addresses
                       SET first_name = SUBSTRING_INDEX(name, ' ', 1),
                           last_name  = SUBSTRING_INDEX(name, ' ', -1)");

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
