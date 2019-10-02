<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class MemberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = User::create([
            'username' => 'member123',
            'name' => 'Member',
            'email' => 'member@pemilos.test',
            'password' => bcrypt('12345678')
        ]);

        $member->assignRole('member');
    }
}
