<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class superadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Create role*/
        $roles = [
            ['name'=>'superadmin','guard_name'=>'web'],
            ['name'=>'calon siswa','guard_name'=>'web'],
            ['name'=>'admin','guard_name'=>'web'],
            ['name'=>'kepsek','guard_name'=>'web'],
        ];
        \Spatie\Permission\Models\Role::insert($roles);

        /*Create permissions*/
        $permissions = [
            ['name'=>'manage users','guard_name'=>'web'],
            ['name'=>'manage data','guard_name'=>'web'],
            ['name'=>'view reports','guard_name'=>'web'],
            ['name'=>'test','guard_name'=>'web'],
        ];
        \Spatie\Permission\Models\Permission::insert($permissions);

        $user =  User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('superadmin');



    }
}
