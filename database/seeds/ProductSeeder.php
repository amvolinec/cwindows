<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker\Generator();
        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\en_US\Company($faker));
        $faker->addProvider(new Faker\Provider\Lorem($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));

//        $data = [
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//            ['code' => $faker->postcode, 'name' => $faker->city],
//        ];
//
//        DB::table('sites')->insert($data);

        $data = array();

        for($i = 0; $i <= 9; $i++) {
            $item = [ 'site_id' => $faker->numberBetween(1, 9), 'code' => Str::random(8), 'name' => $faker->streetName];
            array_push($data, $item);
        }

        DB::table('warehouses')->insert($data);


    }
}
