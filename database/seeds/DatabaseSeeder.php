<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
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

        AdminController::createAdmin("VUONG", "vuong", "vuongtlt13@gmail.com", "1");

        //AreaController::createArea('Quận Ba Đình');

        //SubjectController::createSubject('Toán');

//        TutorController::createTutor('username', 'name', 'date_of_birth', 'address', status);
    }
}
