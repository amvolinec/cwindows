<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'First contact', 'color' => 'aaabbc', 'class' => 'first' ],
            [ 'name' => 'Enquiry', 'color' => '8b8982', 'class' => 'enquiry' ],
            [ 'name' => 'Proposal', 'color' => 'aab4b3', 'class' => 'proposal' ],
            [ 'name' => 'Negotiation', 'color' => '373f47', 'class' => 'negotiation' ],
            [ 'name' => 'Contract', 'color' => 'c3dbd9', 'class' => 'contract' ],
            [ 'name' => 'Manufacturing', 'color' => '006a4e', 'class' => 'manufacturing' ],
            [ 'name' => 'Completed', 'color' => '6dacaa', 'class' => 'completed' ],
            [ 'name' => 'Lost', 'color' => 'ff82a9', 'class' => 'lost' ],
            [ 'name' => 'Canceled', 'color' => 'ffc0be', 'class' => 'canceled' ],

        ];

        DB::table('states')->insert($data);
    }
}
