<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');
    }
}
