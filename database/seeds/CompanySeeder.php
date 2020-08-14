<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Nord Ltd',
            'phone' => '+49 (0) 681 9376-4599',
            'email' => 'info@nord.co.uk',
            'address' => 'Unit 52.11, Woolyard 52 Bermondsey Street, London, England, SE1 ',
        ];

        DB::table('companies')->insert($data);
    }
}
