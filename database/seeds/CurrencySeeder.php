<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['country' => 'Europe', 'currency' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['country' => 'Great Britain', 'currency' => 'Pounds', 'code' => 'GBP', 'symbol' => '£'],
        ];

        DB::table('currencies')->insert($data);
    }
}
