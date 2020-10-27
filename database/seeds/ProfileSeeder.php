<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Wood'],
            ['name' => 'Wood + All'],
            ['name' => 'Aluminium'],
        ];

        DB::table('profiles')->insert($data);
    }
}
