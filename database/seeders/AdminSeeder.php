<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::query()->create([
            'nick_name' => 'admin',
            'age' => 40,
            'country_id' => 230,
            'state' => 'California',
            'gender' => '1',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::query()->where('name', 'admin')->get();
        $admin->assignRole($role);
        UserSetting::query()->create(['user_id' => $admin->id]);
    }
}
