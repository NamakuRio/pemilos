<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'administrator',
            'name' => 'Admin',
            'email' => 'admin@pemilos.test',
            'password' => bcrypt('12345678'),
            'api_token' => bcrypt('admin@pemilos.test'),
        ]);

        $admin->assignRole('admin');
    }
}
