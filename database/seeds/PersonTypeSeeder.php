<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'Architect', 'slug' => 'architect' ],
            [ 'name' => 'Maintenance', 'slug' => 'maintenance' ]
        ];

        DB::table('person_types')->insert($data);
    }
}
