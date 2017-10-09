<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $credentials = [
            "name" => "VUONG",
            "username" => "vuong",
            "email" => "vuongtlt13@gmail.com",
            "password" => "1",
        ];

        Sentinel::registerAndActivate($credentials);
    }
}
