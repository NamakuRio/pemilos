<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'Admin'
        ]);

        Role::create([
            'name' => 'member',
            'guard_name' => 'Member'
        ]);
    }
}
