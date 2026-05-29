<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(

            [
                'email' => 'admin@gmail.com'
            ],

            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        // REMOVE OLD ROLES
        $admin->syncRoles([]);

        // ASSIGN NEW ROLE
        $admin->assignRole('super-admin');




        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */

        $hr = User::updateOrCreate(

            [
                'email' => 'hr@gmail.com'
            ],

            [
                'name' => 'HR User',
                'password' => Hash::make('1234567'),
            ]
        );

        $hr->syncRoles([]);

        $hr->assignRole('hr');




        /*
        |--------------------------------------------------------------------------
        | MANAGER
        |--------------------------------------------------------------------------
        */

        $manager = User::updateOrCreate(

            [
                'email' => 'manager@gmail.com'
            ],

            [
                'name' => 'Manager',
                'password' => Hash::make('123456'),
            ]
        );

        $manager->syncRoles([]);

        $manager->assignRole('manager');




        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */

        $employee = User::updateOrCreate(

            [
                'email' => 'employee@gmail.com'
            ],

            [
                'name' => 'Employee User',
                'password' => Hash::make('123456'),
            ]
        );

        $employee->syncRoles([]);

        $employee->assignRole('employee');
    }
}

/*namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   /* public function run(): void*/
   /* {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
                'role' => 'super-admin'
            ]
        );

        // HR
        User::firstOrCreate(
            ['email' => 'hr@gmail.com'],
            [
                'name' => 'HR User',
                'password' => Hash::make('1234567'),
                'role' => 'hr'
            ]
        );

        // MANAGER
        User::firstOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name' => 'Manager',
                'password' => Hash::make('123456'),
                'role' => 'manager'
            ]
        );

        // EMPLOYEE
        User::firstOrCreate(
            ['email' => 'employee@gmail.com'],
            [
                'name' => 'Employee User',
                'password' => Hash::make('12345'),
                'role' => 'employee'
            ]
        );
    }
}*/
