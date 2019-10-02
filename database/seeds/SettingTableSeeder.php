<?php

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'app_name', 'value' => 'Pemilos', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'app_description', 'value' => 'Aplikasi Pemilihan Osis', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'app_author', 'value' => 'Rio Prastiawan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'app_version', 'value' => '1.0.0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'app_logo', 'value' => 'favicon.ico', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'meta_author', 'value' => 'RioPrastiawan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
            array('name' => 'meta_description', 'value' => 'Aplikasi Pemilihan Osis', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()),
        );
        Setting::insert($data);
    }
}
