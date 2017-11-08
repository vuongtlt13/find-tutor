<?php

namespace App\Http\Controllers;

use App\Area;
use App\Course;
use App\Student;
use App\Subject;
use App\Tutor;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mockery\Exception;
use function PHPSTORM_META\type;
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
     * searching info about courses
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case "admin":
                return $this->searchAdmin($request);
                break;
            case "course":
                return $this->searchCourse($request);
                break;
            default:
                echo "No Permission";
        }
    }

    /**
     * Tutor search
     * @param Request $request
     * @return mixed
     */
    public function tutorSearch(Request $request)
    {
        $user = Sentinel::getUser();
        $subject = $request->input('subject') === 'all' ? '' : $request->input('subject');
        $area = $request->input('area') === 'all' ? '' : $request->input('area');

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
            ->leftJoin('subjects as s', 'c.subject_id', '=', 's.id')
            ->leftJoin('areas as a', 'c.area_id', '=', 'a.id')
            ->select('c.id', 'c.user_id', 'c.subject_id', 'c.area_id',
                     's.name as subject', 'a.name as area', 'c.fee', 'c.status')
            ->where([
                ['user_id', '=', $user->id],
                ['a.name', 'like', '%' . $area . '%'],
                ['s.name', 'like', '%' . $subject . '%'],
            ]);
//        return json_encode($query->get());
        return Datatables::of($query)->make(true);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getAdminInfo(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('users as u')
                ->where('u.id', '=', $id)
                ->leftJoin('tutors as t', 't.user_id', '=', 'id')
                ->select('u.name', DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) as age'),
                    DB::raw('IF(u.gender = 1, "Nam", "Nữ") as gender'), 't.job', 't.workplace', 'u.phone', 'u.email')
                ->first();

        return json_encode($res);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function searchAdmin($request)
    {
//        dd($request);
        $name = $request->name === 'all' ? '' : $request->name;
        $gender = $request->gender === 'all' ? 3 : config('constants.gender.' . $request->gender);
        if ($gender == 2) $gender = 3;
        $minAge = intval($request->minage);
        $maxAge = intval($request->maxage);
        $query = DB::table('users as u')
            ->rightJoin('tutors as t', 't.user_id', '=', 'u.id')
            ->select('u.id', 'u.name', 't.job', 't.workplace',
                DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) as age'),
                DB::raw('IF(gender = 1, "Nam", "Nữ") as gender'),
                't.status', 'u.phone', 'u.email')
            ->where([
                ['u.name', 'like', '%' . $name . '%'],
            ])
            ->whereBetween('gender', [$gender == 3 ? 0 : $gender, $gender == 3 ? 1 : $gender])
            ->whereBetween(DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365)'), [$minAge, $maxAge]);
//        return json_encode($query->get());
        return Datatables::of($query)->make(true);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function searchCourse($request)
    {
        $name = $request->name === 'all' ? '' : $request->name;
        $gender = $request->gender === 'all' ? 3 : config('constants.gender.' . $request->gender);
        if ($gender == 2) $gender = 3;
        $subject = $request->subject === 'all' ? '' : $request->subject;
        $area = $request->area === 'all' ? '' : $request->area;
        $minAge = intval($request->minage);
        $maxAge = intval($request->maxage);
        $minPrice = intval($request->minprice);
        $maxPrice = intval($request->maxprice);

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
            ->leftJoin('tutors as t', 't.user_id', '=', 'u.id')
            ->leftJoin('subjects as s', 'c.subject_id', '=', 's.id')
            ->leftJoin('areas as a', 'c.area_id', '=', 'a.id')
            ->select('c.id', 'c.user_id', 'c.subject_id', 'c.area_id', 'u.name as name',
                DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365) as age'),
                DB::raw('IF(u.gender = 1, "Nam", "Nữ") as gender'),
                's.name as subject', 'a.name as area', 'fee')
            ->where([
                ['u.name', 'like', '%' . $name . '%'],
                ['a.name', 'like', '%' . $area . '%'],
                ['s.name', 'like', '%' . $subject . '%'],
                ['c.status', '=', 1],
                ['t.status', '=', 1],
            ])
            ->whereBetween('gender', [$gender == 3 ? 0 : $gender, $gender == 3 ? 1 : $gender])
            ->whereBetween(DB::raw('FLOOR(DATEDIFF(CURDATE(), u.date_of_birth)/365)'), [$minAge, $maxAge])
            ->whereBetween('fee', [$minPrice, $maxPrice]);

        return Datatables::of($query)->make(true);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function changeStatus(Request $request)
    {
//        dd($request);
        $id = $request->input('adminId');

        $user = Sentinel::getUser();
        if (self::getTypeOfUser($user) == 2) {
            $tutor = Tutor::find($id);
            if ($tutor != null) {
                $tutor->status = 1 - $tutor->status;
                $tutor->save();
                return json_encode($tutor);
            }
        }
        echo "Permission denied";
    }

    /**
     * @param Request $request
     * @return string
     */
    public function updateProfile(Request $request)
    {
//        dd($request);
        $user = Sentinel::getUser();
        $user_id = $request->input('user_id');
        if ($user->id != $user_id) return 'Permission denied';

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $pass = $request->input('password');

        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        if (!($pass == null || $pass == '')) $user->password = bcrypt($pass);
        $user->save();

        return redirect(route('profile'));
    }
}

