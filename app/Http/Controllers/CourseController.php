<?php

namespace App\Http\Controllers;

use App\Area;
use App\Course;
use App\Subject;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Mockery\Exception;

class CourseController extends Controller
{
    /**
     * @param $number
     */
    public static function createCourses($number)
    {
        for($i = 0; $i < $number; $i++) {
            $user_id = random_int(2, sizeof(User::all()));
            $subject_id = random_int(1, sizeof(Subject::all()));
            $area_id = random_int(1, sizeof(Area::all()));
            $fee = random_int(0, 500000);
            $status = random_int(0, 100) >= 80 ? 0 : 1;
            if (!self::createCourse($user_id, $area_id, $subject_id, $fee, $status)) $number++;
        }
    }

    /**
     * @param $user_id
     * @param $area_id
     * @param $subject_id
     * @param $fee
     * @param $status
     * @return bool
     */
    public static function createCourse($user_id, $area_id, $subject_id, $fee, $status)
    {
        try {
            $course = new Course();
            $course->user_id = $user_id;
            $course->area_id = $area_id;
            $course->subject_id = $subject_id;
            $course->fee = $fee;
            $course->status = $status;
            $course->save();
        } catch (QueryException $e) {
            return false;
        }
        return true;
    }
}
