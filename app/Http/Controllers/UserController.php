<?php

namespace App\Http\Controllers;

use App\Tutor;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Sentinel;
use Illuminate\Http\Request;
use function Sodium\add;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $credentials = [
            "username" => $username,
            "password" => $password,
        ];

        try {
            if ($user = Sentinel::stateless($credentials)) {
                Sentinel::login($user);
                return redirect(route('index'));
            } else {
                return redirect(route('login')) -> with('result', 'fail');
            }
        } catch (NotActivatedException $ex) {
            return redirect(route('login')) -> with('activation', 'fail');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        //$user = Sentinel::getUser();
        Sentinel::logout();
        return redirect(route('index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $credentials = [
            "username" => $username,
            "password" => $password,
            "email" => $email,
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $user->permissions = [
            'user.completeInfo' => true,
        ];

        $user->save();

        $tutor = new Tutor();
        $tutor->user_id = $user->id;

        Sentinel::login($user);

        return redirect(route('complete-info'));
    }

    public function completeInfo(Request $request)
    {
        //dd($request);
        $name = $request->input('name');
        $dob = $request->input('dob');
        $gender = config('gender.' . $request->input('gender'));
        //dd($gender);
        $cmnd = $request->input('cmnd');
        $phone = $request->input('phone');
        $address = $request->input('address');
        //echo $name . PHP_EOL . $dob . PHP_EOL . $gender . PHP_EOL . $cmnd . PHP_EOL . $phone . PHP_EOL . $address;

        $user = Sentinel::getUser();
        //dd($user);
        $user->name = $name;
        $user->date_of_birth = $dob;
        $user->gender = $gender;
        $user->identification = $cmnd;
        $user->phone = $phone;
        $user->address = $address;

        $user->removePermission('user.completeInfo');

        $user->save();
        return redirect(route('index'));
    }
}
