<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Tutor;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $user
     * @return bool
     */
    public static function isAdmin($user)
    {
        if ($user == null) return 0;
        $obj = Admin::where('user_id', $user->id)->first();
        return $obj != null;
    }

    /**
     * @param $user
     * @return bool
     */
    public static function isTutor($user)
    {
        if ($user == null) return 0;
        $obj = Tutor::where('user_id', $user->id)->first();
        return $obj != null;
    }

    /**
     * @param $user
     * @return int
     */
    public static function getTypeOfUser($user)
    {
        if ($user == null) return -1;
        if (Controller::isAdmin($user)) return 2;
        if (Controller::isTutor($user)) return 1;
        return 0;
    }

    /**
     * @param int $length
     * @return string
     */
    public static function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
}
