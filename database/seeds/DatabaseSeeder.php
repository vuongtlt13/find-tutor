<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        AdminController::createAdmin("VUONG", "vuong", "vuongtlt13@gmail.com", "1");

        AreaController::createArea('Quận Ba Đình');
        AreaController::createArea('Quận Bắc Từ Liêm');
        AreaController::createArea('Quận Cầu Giấy');
        AreaController::createArea('Quận Đống Đa');
        AreaController::createArea('Quận Hà Đông');
        AreaController::createArea('Quận Hai Bà Trưng');
        AreaController::createArea('Quận Hoàn Kiếm');
        AreaController::createArea('Quận Hoàng Mai');
        AreaController::createArea('Quận Long Biên');
        AreaController::createArea('Quận Nam Từ Liêm');
        AreaController::createArea('Quận Tây Hồ');
        AreaController::createArea('Quận Thanh Xuân');

        SubjectController::createSubject('Toán học');
        SubjectController::createSubject('Văn học');
        SubjectController::createSubject('Tiếng Anh');
        SubjectController::createSubject('Hóa học');
        SubjectController::createSubject('Vật lý');
        SubjectController::createSubject('Sinh học');
        SubjectController::createSubject('Địa lý');
        SubjectController::createSubject('Lịch sử');
        SubjectController::createSubject('Tiếng Trung');
        SubjectController::createSubject('Tiếng Nhật');
        SubjectController::createSubject('Tiếng Hàn');
        SubjectController::createSubject('Tiếng Pháp');
        SubjectController::createSubject('Tiếng Đức');
        SubjectController::createSubject('Triết học');

        TutorController::createTutor('ngvanan1310', 'Nguyễn Văn An', '1990-10-13', 'Dia chi', 1, 0);
        TutorController::createTutor('maimaiyeuem85', 'Trịnh Tư Cường', '1985-8-12', 'Dia chi', 1, 1);
        TutorController::createTutor('doilabekho', 'Vương Thức Tỉnh', '1993-11-12', 'Dia chi', 1, 1);
        TutorController::createTutor('anhdqlinhtt', 'Đỗ Quốc Anh', '1899-4-19', 'Dia chi', 1, 1);
        TutorController::createTutor('handsometutor317', 'Trần Đinh Sơn', '1991-7-31', 'Dia chi', 1, 1);
        TutorController::createTutor('3tlovely', 'Trịnh Thu Thảo', '1990-1-21', 'Dia chi', 0, 0);
        TutorController::createTutor('idol2112', 'Trương Hoàng Linh', '1992-12-21', 'Dia chi', 0, 1);
        TutorController::createTutor('songchetbennhau87', 'Trương Quốc Thịnh', '1987-9-2', 'Dia chi', 1, 1);
        TutorController::createTutor('v2thao2v', 'Vương Thảo Vy', '1990-2-2', 'Dia chi', 0, 1);
        TutorController::createTutor('khongthidokhonglaytien', 'Trần Bá Vương', '1981-8-15', 'Dia chi', 1, 1);
        TutorController::createTutor('canhbuomtrongmua83', 'Lê Huyền Trang', '1991-3-8', 'Dia chi', 0, 0);
        TutorController::createTutor('linhlp30495', 'Lương Phong Linh', '1994-2-2', 'Dia chi', 1, 1);
        TutorController::createTutor('ngminhduc2210', 'Nguyễn Minh Đức', '1978-10-22', 'Dia chi', 1, 1);
        TutorController::createTutor('benlinhtrondoi', 'Đinh Nhân Khang', '1994-5-25', 'Dia chi', 1, 1);
        TutorController::createTutor('bichcam212', 'Lương Bích Cầm', '1993-2-21', 'Dia chi', 0, 1);
        TutorController::createTutor('vietnamchienthang', 'Khương Thuấn Dật', '1980-12-2', 'Dia chi', 1, 1);
        TutorController::createTutor('baclien191', 'Trần Bắc Liên', '1983-1-19', 'Dia chi', 0, 1);
        TutorController::createTutor('dimotngaydanghocmotsangkhon96', 'Đỗ Xuân Đức', '1996-8-14', 'Dia chi', 1, 1);
        TutorController::createTutor('lacmakvo', 'Phan Vương Hải', '1995-6-20', 'Dia chi', 1, 1);
        TutorController::createTutor('nhokbin99', 'Trịnh Vân Thu', '1984-3-4', 'Dia chi', 0, 1);
        TutorController::createTutor('uoctv192', 'Trần Văn Ước', '1994-1-9', 'Dia chi', 1, 0);

        CourseController::createCourses(100);
    }
}
