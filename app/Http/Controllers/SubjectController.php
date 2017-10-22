<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    /**
     * Use for command db:seed
     * @param $name
     */
    public static function createSubject($name)
    {
        $subject = new Subject();
        $subject->name = $name;
        $subject->save();
    }
}
