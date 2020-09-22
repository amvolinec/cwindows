<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => '',
            'code' => '123456789',
            'vat_code' => 'EU123456789',
        ];

        DB::table('settings')->insert($data);
    }
}
