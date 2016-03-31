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
		$admin->username = "admin";
		$admin->password = bcrypt('admin');
		$admin->auth_level = 0;
		$admin->is_aktif = true;
		$admin->save();
        // $this->call(UsersTableSeeder::class);
    }
}
