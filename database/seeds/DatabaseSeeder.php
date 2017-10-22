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

        AreaController::createArea('Quận 1');
        AreaController::createArea('Quận 2');
        AreaController::createArea('Quận 3');
        AreaController::createArea('Quận 4');
        AreaController::createArea('Quận 5');

        SubjectController::createSubject('Môn 1');
        SubjectController::createSubject('Môn 2');
        SubjectController::createSubject('Môn 3');
        SubjectController::createSubject('Môn 4');
        SubjectController::createSubject('Môn 5');
        SubjectController::createSubject('Môn 6');

//        TutorController::createTutor('username', 'name', 'date_of_birth', 'address', status);
    }
}
