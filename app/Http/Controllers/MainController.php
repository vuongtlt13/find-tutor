<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class MainController extends Controller
{
    /**
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findTutor()
    {
        return view('tutor.findtutor');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        while (Sentinel::check()) Sentinel::logout();
        return view('auth.register');
    }

    public function completeInfo()
    {

        $user = Sentinel::getUser();
        if ($user === null) echo "WRONG";
        else {
            if ($user->hasAccess(['user.completeInfo'])) {
                return view('auth.complete-info');
            } else {
                echo "No permission";
            }
        }

    }
}
