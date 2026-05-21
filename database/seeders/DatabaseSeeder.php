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

       
        $user2 = User::updateOrCreate(
            ['email' => 'yaig79@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('yaig79'),
            ]
        );

        $user3 = User::updateOrCreate(
            ['email' => 'Eng_shadi2011@hotmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('shadi2011'),
            ]
        );

        $user2->assignRole(Role::firstOrCreate(['name' => 'Super Admin']));
        $user3->assignRole(Role::firstOrCreate(['name' => 'Super Admin']));
    }
}