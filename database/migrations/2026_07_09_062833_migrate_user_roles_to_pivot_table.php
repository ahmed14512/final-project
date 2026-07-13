<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;

return new class extends Migration
{

    public function up(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            $oldRole = \DB::table('users')
                          ->where('id', $user->id)
                          ->value('role');

            if (!$oldRole) {
                $oldRole = 'customer';
            }

            $role = Role::where('name', $oldRole)->first();

            if ($role) {
                \DB::table('role_user')->insertOrIgnore([
                    'user_id'    => $user->id,
                    'role_id'    => $role->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('role_user')->truncate();
    }
};
