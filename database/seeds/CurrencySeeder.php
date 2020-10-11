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
            ['country' => 'Europe', 'currency' => 'Euro', 'code' => 'EUR', 'symbol' => '€', 'locale' => 'de_DE'],
            ['country' => 'Great Britain', 'currency' => 'Pounds', 'code' => 'GBP', 'symbol' => '£', 'locale' => 'en_GB'],
        ];

        DB::table('currencies')->insert($data);
    }
}
