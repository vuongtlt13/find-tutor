<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    //
    /**
     * Use for command db:seed
     * @param $name
     */
    public static function createArea($name)
    {
        $area = new Area();
        $area->name = $name;
        $area->save();
    }
}
