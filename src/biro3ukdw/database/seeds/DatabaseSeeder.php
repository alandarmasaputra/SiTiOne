<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = new User;
		$admin->email = "superadmin@gmail.com";
		$admin->username = "admin";
		$admin->password = bcrypt('admin');
		$admin->auth_level = 0;
		$admin->is_aktif = true;
		$admin->save();
        // $this->call(UsersTableSeeder::class);

        $admins = new User;
        $admins->email = "asdad@yahoo.com";
        $admins->username = "admins";
        $admins->password = bcrypt('admins');
        $admins->auth_level = 2;
        $admins->is_aktif = true;
        $admins->save();
    }
}
