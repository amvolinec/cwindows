<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Alfredas Ivanauskas', 'phone' => '44551236546', 'setting_id' => 1
        ];

        DB::table('clients')->insert($data);
    }
}
