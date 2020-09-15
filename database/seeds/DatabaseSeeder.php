<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(PersonTypeSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StateSeeder::class);
    }
}
