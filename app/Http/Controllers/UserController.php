<?php

namespace App\Http\Controllers;

use App\Area;
use App\Course;
use App\Student;
use App\Subject;
use App\Tutor;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    /**
     * create new course
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createCourse(Request $request)
    {
        //dd($request);
        $subject = $request->input('subject');
        $area = $request->input('area');
        $fee = $request->input('fee');
        $isActive = ($request->input('active') == null) ? 0 : 1;

        $user = Sentinel::getUser();
        $subject = Subject::where('name', $subject)->first();
        $area = Area::where('name', $area)->first();
        $fee = (int)$fee;


        if (!($subject == null || $area == null || gettype($fee) != 'integer')) {
            $course = new Course();
            $course->subject_id = $subject->id;
            $course->area_id = $area->id;
            $course->user_id = $user->id;
            $course->fee = $fee;
            $course->status = $isActive;

            $course->save();
        }
        return redirect(route('manage'));
    }

    public function search(Request $request)
    {
        $name = $request->input('name') === 'all' ? '' : $request->input('name');
        $gender = $request->input('gender') === 'all' ? 3 : config('constants.gender' . $request->input('gender'));
        if ($gender == 2) $gender = 3;
        $subject = $request->input('subject') === 'all' ? '' : $request->input('subject');
        $area = $request->input('area') === 'all' ? '' : $request->input('area');
        $minAge = intval($request->input('minage'));
        $maxAge = intval($request->input('maxage'));
        $minPrice = intval($request->input('minprice'));
        $maxPrice = intval($request->input('maxprice'));

//        echo $name . ' ' . PHP_EOL;
//        echo $gender . ' ' . PHP_EOL;
//        echo $subject . ' ' . PHP_EOL;
//        echo $area . ' ' . PHP_EOL;
//        echo gettype($minAge) . ' ' . $minAge . PHP_EOL;
//        echo gettype($maxAge) . ' ' . $maxAge . PHP_EOL;
//        echo gettype($minPrice) . ' ' . $minPrice . PHP_EOL;
//        echo gettype($maxPrice) . ' ' . $maxPrice . PHP_EOL;

//        SELECT c.user_id, c.subject_id, c.area_id, u.name as name, FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) as age, IF(u.gender = 1, "Nam", "Nữ") as gender, s.name as subject, a.name as area, fee
//        FROM courses as c
//        LEFT JOIN users as u
//          ON c.user_id = u.id
//        LEFT JOIN subjects as s
//          ON c.subject_id = s.id
//        LEFT JOIN areas as a
//          ON c.area_id = a.id
//        WHERE u.name LIKE '%%'
//            AND a.name LIKE '%%'
//            AND s.name LIKE '%%'
//            AND gender BETWEEN 0 AND 1
//            AND FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) BETWEEN 0 AND 100
//            AND fee BETWEEN 0 AND 1000000
//        ORDER BY c.user_id;


        $query = DB::table('courses as c')
            ->leftJoin('users as u', 'c.user_id', '=', 'u.id')
            ->leftJoin('subjects as s', 'c.subject_id', '=', 's.id')
            ->leftJoin('areas as a', 'c.area_id', '=', 'a.id')
            ->select('c.user_id', 'c.subject_id', 'c.area_id', 'u.name as name',
                DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) as age'),
                DB::raw('IF(u.gender = 1, "Nam", "Nữ") as gender'),
                's.name as subject', 'a.name as area', 'fee')
            ->where([
                ['u.name', 'like', '%' . $name . '%'],
                ['a.name', 'like', '%' . $area . '%'],
                ['s.name', 'like', '%' . $subject . '%'],
            ])
            ->whereBetween('gender', [$gender == 3 ? 0 : $gender, $gender == 3 ? 1 : $gender])
            ->whereBetween(DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365)'), [$minAge, $maxAge])
            ->whereBetween('fee', [$minPrice, $maxPrice]);

//        return json_encode($query->get());
        return Datatables::of($query)->make(true);
    }
}

