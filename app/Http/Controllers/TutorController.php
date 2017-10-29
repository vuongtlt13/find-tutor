<?php

namespace App\Http\Controllers;

use App\Tutor;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Mockery\Exception;

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
        $user = null;
        while (true) {
            $credentials = [
                "name" => $name,
                "username" => $username,
                "email" => self::randomString(10) . '@' . self::randomString(5),
                "password" => 1,
                "phone" => self::randomNumber(10),
                "date_of_birth" => $dob,
                "address" => $address,
                "gender" => $gender,
            ];
            try {
                $user = Sentinel::registerAndActivate($credentials);
                break;
            } catch (Exception $e) {
                continue;
            }

        }
        $tutor= new Tutor();
        $tutor->user_id = $user->id;
        $tutor->status = $status;
        $tutor->job = self::randomString(10);
        $tutor->workplace = self::randomString(20);
        $tutor->save();
    }
}
