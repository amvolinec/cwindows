<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles and assign existing permissions
        $role_manager = Role::create(['name' => 'manager']);

        $user = Factory(App\User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('adminas2020'),
        ]);

        $user->assignRole($role_manager);
    }
}
