<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::whereIn('email', [
        //     'ibrahim@ksach.org',
        //     'dr.essam@ksach.org'
        // ])->delete();

        // $this->call([
        //     PermissionSeeder::class,
        //     RolePermissionSeeder::class,
        // ]);

        $user = User::updateOrCreate(
            ['email' => 'ksach.4005@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Elkods@2009'),
            ]
        );
          $user2 = User::updateOrCreate(
            ['email' => 'ksach.4005@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Elkods@2009'),
            ]
        );

        $user->assignRole(Role::firstOrCreate(['name' => 'Super Admin']));
    }
}