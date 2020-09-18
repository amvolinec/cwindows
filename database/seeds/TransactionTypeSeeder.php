<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Cache'],
            ['name' => 'Credit card'],
            ['name' => 'Bank transfer'],
        ];

        DB::table('transaction_types')->insert($data);
    }
}
