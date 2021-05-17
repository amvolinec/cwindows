<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit documents']);
        Permission::create(['name' => 'delete documents']);
        Permission::create(['name' => 'publish documents']);
        Permission::create(['name' => 'unpublish documents']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit documents');
        $role1->givePermissionTo('delete documents');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish documents');
        $role2->givePermissionTo('unpublish documents');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Jonas Sakalauskas',
            'email' => 'user@example.com',
            'password' => Hash::make('adminas2020'),
            'setting_id' => 1
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Jonas Burbokas',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminas2020'),
            'setting_id' => 1
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Albertas Jonaitis',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('adminas2020'),
            'setting_id' => 1

        ]);
        $user->assignRole($role3);
    }
}

