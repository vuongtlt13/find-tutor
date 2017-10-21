<?php

namespace App\Http\Controllers;

use App\Student;
use App\Tutor;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Sentinel;
use Illuminate\Http\Request;

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
        $type = $request->input('result-type');
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

        if ($type == 0) {
            $tutor = new Tutor();
            $tutor->user_id = $user->id;
            $tutor->save();
        } elseif ($type == 1) {
            $student = new Student();
            $student->user_id = $user->id;
            $student->save();
        }

        Sentinel::login($user);
        return redirect(route('complete-info'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function completeInfo(Request $request)
    {
        //dd($request);
        $name = $request->input('name');
        $dob = $request->input('dob');
        $gender = config('constants.gender.' . $request->input('gender'));
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

        $type = $this->getTypeOfUser($user);

        if ($type == 1) {
            $tutor = Tutor::where('user_id', $user->id)->first();
            $tutor->job = $request->input('job');
            $tutor->workplace = $request->input('workplace');

            $tutor->save();
        } elseif($type == 0) {
            $student = Student::where('user_id', $user->id)->first();
            $student->school = $request->input('school');

            $student->save();
        }
        return redirect(route('index'));
    }
}
