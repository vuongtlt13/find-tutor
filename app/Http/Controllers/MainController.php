<?php

namespace App\Http\Controllers;

use App\Area;
use App\Course;
use App\Subject;
use App\Tutor;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class MainController extends Controller
{
    /**
     * Enter login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login() {
        return view('auth.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('default.index');
    }

    /**
     * Enter page to find tutor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findTutor()
    {
        $areas = Area::all();
        $subjects = Subject::all();
        $courses = Course::all();
        return view('tutor.findtutor', ['areas' => $areas, 'subjects' => $subjects, 'courses' => $courses]);
    }

    /**
     * enter register page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        while (Sentinel::check()) Sentinel::logout();
        return view('auth.register');
    }

    /**
     * Enter complete profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function completeInfo()
    {

        $user = Sentinel::getUser();
        if ($user === null) echo "WRONG";
        else {
            if ($user->hasAccess(['user.completeInfo'])) {
                $type = $this->getTypeOfUser($user);
                return view('auth.complete-info', ['type' => $type]);
            } else {
                echo "No permission";
            }
        }
    }

    /**
     * Enter manage page (Only tutor)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage()
    {
        $user = Sentinel::getUser();
        $type = self::getTypeOfUser($user);
        $tutor = Tutor::where('user_id', '=', $user->id)->first();
        switch ($type) {
            case 0:
                echo "You are not a tutor!";
                break;
            case 1:
                if ($tutor->status == 0) {
                    echo "Your account is not verified! Please contact to admin";
                } else {
                    $areas = Area::all();
                    $subjects = Subject::all();
                    $courses = Course::where('user_id', $user->id)->get();
                    return view('tutor.manage', ['areas' => $areas, 'subjects' => $subjects, 'courses' => $courses]);
                }
                break;
            case 2:
                return view('admin.admin-manage');
                break;
            default:
                echo "No permission";
        }
    }
}
