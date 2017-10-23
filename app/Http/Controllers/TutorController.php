<?php

namespace App\Http\Controllers;

use App\Tutor;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class TutorController extends Controller
{
    //
    /**
     * @param $username
     * @param $name
     * @param $dob
     * @param $address
     * @param $status
     * @param $gender
     */
    public static function createTutor($username, $name, $dob, $address, $status, $gender)
    {
        $credentials = [
            "name" => $name,
            "username" => $username,
            "email" => self::randomString(10) . '@' . self::randomString(5),
            "password" => 1,
            "date_of_birth" => $dob,
            "address" => $address,
            "gender" => $gender,
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $tutor= new Tutor();
        $tutor->user_id = $user->id;
        $tutor->status = $status;
        $tutor->save();
    }
}
