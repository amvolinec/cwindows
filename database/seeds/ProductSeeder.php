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

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $item = ['code' => $faker->postcode, 'name' => $faker->streetName];
            array_push($data, $item);
        }
        DB::table('sites')->insert($data);

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $item = ['site_id' => $faker->numberBetween(1, 10), 'code' => Str::random(8), 'name' => $faker->streetName];
            array_push($data, $item);
        }
        DB::table('warehouses')->insert($data);

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $item = ['code' => Str::random(8), 'name' => $faker->firstName];
            array_push($data, $item);
        }
        DB::table('manufacturers')->insert($data);

        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $item = ['manufacturer_id' => $faker->numberBetween(1, 10), 'code' => Str::random(8), 'name' => $faker->company];
            array_push($data, $item);
        }
        DB::table('brands')->insert($data);

        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $item = ['code' => Str::random(8), 'name' => $faker->word];
            array_push($data, $item);
        }
        DB::table('categories')->insert($data);

        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $item = ['code' => Str::random(8), 'name' => $faker->word];
            array_push($data, $item);
        }
        DB::table('groups')->insert($data);

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $item = ['name' => $faker->word];
            array_push($data, $item);
        }
        DB::table('generics')->insert($data);

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $item = ['code' => Str::random(6), 'name' => $faker->colorName];
            array_push($data, $item);
        }
        DB::table('attributes')->insert($data);
    }
}
