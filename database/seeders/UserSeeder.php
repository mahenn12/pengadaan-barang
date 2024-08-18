<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //membuat sample role
        $adminRole = new role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Administrator";
        $adminRole->save();

        $petugasRole = new role();
        $petugasRole->name = "petugas";
        $petugasRole->display_name = "Petugas";
        $petugasRole->save();

        //membuat sample user
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('12345678');
        $admin->save();
        $admin->attachRole($adminRole);

        $petugas = new User();
        $petugas->name = "Petugas";
        $petugas->email = "petugas@gmail.com";
        $petugas->password = bcrypt('12345678');
        $petugas->save();
        $petugas->attachRole($petugasRole);

    }
}
