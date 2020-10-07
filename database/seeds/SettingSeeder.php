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
            'name' => 'AG Bespoke Solutions Ltd',
            'code' => '12345678',
            'vat_code' => 'EU12345678',
            'address' => '214 Essex Road, London n1 3AP',
            'phone' => '02081507171',
            'email' => 'info@agbespokesolutions.com',
            'web' => 'agbespokewindows.com'
        ];

        DB::table('settings')->insert($data);
    }
}
