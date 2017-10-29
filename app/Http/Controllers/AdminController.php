<?php

namespace App\Http\Controllers;

use App\Admin;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AdminController extends Controller
{

    /**
     * Use for command db:seed
     * @param $name
     * @param $username
     * @param $email
     * @param $password
     */
    public static function createAdmin($name, $username, $email, $password)
    {
        $credentials = [
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "phone" => '111'
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->save();
    }
}
