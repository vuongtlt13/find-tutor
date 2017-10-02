<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
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
     * Display view find tutor by name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findByName()
    {
        return view('tutor.findbyname');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findTutor()
    {
        return view('tutor.findtutor');
    }
}
