<?php

namespace App\Http\Controllers;

use App\Area;
use App\Course;
use App\Subject;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
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
            if (!self::createCourseDB($user_id, $area_id, $subject_id, $fee, $status)) $number++;
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
    public static function createCourseDB($user_id, $area_id, $subject_id, $fee, $status)
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

    /**
     * @param Request $request
     * @return string
     */
    public function changeStatus(Request $request)
    {
        $id = $request->input('id');
        $course = Course::find($id);

        $user = Sentinel::getUser();
        if ($course != null && $course->user_id == $user->id) {
            $course->status = 1 - $course->status;
            $course->save();

            return json_encode($course);
        }
    }

    /**
     * create new course
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createCourse(Request $request)
    {
        //dd($request);
        $subject = $request->input('subject');
        $areaName = $request->input('area');
        $fee = $request->input('fee');
        $isActive = ($request->input('active') == null) ? 0 : 1;

        $user = Sentinel::getUser();
        if ($areaName == "Tất cả"){
            $areas = Area::all();
        } else {
            $areas = Area::where('name', $areaName)->get();
        }

        $subject = Subject::where('name', $subject)->first();
        $fee = (int)$fee;

        if (!(sizeof($areas) == 0 || $subject == null || gettype($fee) != 'integer')) {
            foreach ($areas as $area) {
                try {
                    $course = new Course();
                    $course->subject_id = $subject->id;
                    $course->area_id = $area->id;
                    $course->user_id = $user->id;
                    $course->fee = $fee;
                    $course->status = $isActive;

                    $course->save();
                } catch (Exception $e) {
                    continue;
                } catch (QueryException $e) {
                    continue;
                }
            }
        }
        return redirect(route('manage'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function updateCourse(Request $request)
    {
//        dd($request);
        $subject = $request->input('subject-update');
        $area = $request->input('area-update');
        $fee = $request->input('fee-update');
        $isActive = ($request->input('active-update') == null) ? 0 : 1;
        $idCourse = $request->input('idCourse');

        $user = Sentinel::getUser();

        $course = Course::find($idCourse);
        if ($course == null || $course->user_id != $user->id) {
            echo 'Permission denied';
            return redirect(route('manage'));
//            return;
        }

        $subject = Subject::where('name', $subject)->first();
        $area = Area::where('name', $area)->first();
        $fee = (int)$fee;

        if ($area == null || $subject == null || gettype($fee) != 'integer') {
            echo 'Permission denied';
            return redirect(route('manage'));
//            return;
        }

        $course->fee = $fee;
        $course->status = $isActive;
        $course->save();

        return redirect(route('manage'));
    }

    public function deleteCourse(Request $request)
    {
//        dd($request);
        $id = $request->input('id');

        $course = Course::find($id);
        $user = Sentinel::getUser();

        if ($course == null || $course->user_id != $user->id) {
            echo 'Permission denied';
            return redirect(route('manage'));
//            return;
        }

        $course->delete();
        return redirect(route('manage'));
    }
}
