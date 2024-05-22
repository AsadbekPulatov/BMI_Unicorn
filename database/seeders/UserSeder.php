<?php

namespace Database\Seeders;

use App\Models\KafedraUser;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = `{"id": 29, "data": {"hash": "e4c476b5dff2fc773c9ff396968d6fabbed47065dccc02accdbfb5e4e7841fa8", "email": "polatovasadbek311@gmail.com", "group": {"id": 72, "name": "942-20DIo'", "educationLang": {"code": "11", "name": "O‘zbek"}}, "image": "https://hemis.ubtuit.uz/static/crop/1/7/320_320_90_1713629299.png", "level": {"code": "14", "name": "4-kurs"}, "phone": "+998919846045", "gender": {"code": "11", "name": "Erkak"}, "address": " Pitnak qishlog'i Sayapir mahallasi", "country": {"code": "UZ", "name": "O‘zbekiston"}, "faculty": {"id": 5, "code": "390-102", "name": "Telekommunikatsiya texnologiyalari", "active": true, "parent": null, "localityType": {"code": "11", "name": "Mahalliy"}, "structureType": {"code": "11", "name": "Fakultet"}}, "district": {"code": "1733220", "name": "Xazorasp tumani", "_parent": "1733"}, "province": {"code": "1733", "name": "Xorazm viloyati", "_parent": "1733"}, "semester": {"id": 32, "code": "18", "name": "8-semestr", "current": true, "education_year": {"code": "2023", "name": "2023-2024", "current": true}}, "full_name": "PO‘LATOV ASADBEK DILMUROD O‘G‘LI", "specialty": {"code": "5330600", "name": "Dasturiy injiniring"}, "birth_date": 1027900800, "first_name": "ASADBEK", "short_name": "PO‘LATOV A. D.", "third_name": "DILMUROD O‘G‘LI", "university": "Muhammad al-Xorazmiy nomidagi Toshkent axborot texnologiyalari universiteti Urganch filiali", "paymentForm": {"code": "11", "name": "Davlat granti"}, "second_name": "PO‘LATOV", "accommodation": {"code": "15", "name": "Talabalar turar joyida"}, "educationForm": {"code": "11", "name": "Kunduzgi"}, "educationLang": {"code": "11", "name": "O‘zbek"}, "educationType": {"code": "11", "name": "Bakalavr"}, "studentStatus": {"code": "11", "name": "O‘qimoqda"}, "socialCategory": {"code": "12", "name": "1 va 2-guruh nogironligi bo‘lgan talabalar"}, "student_id_number": "390201100321"}, "name": "Asadbek Po‘latov", "type": "student", "uuid": "ad192cfe-36f9-13f9-16fb-80401d66944d", "email": "polatovasadbek311@gmail.com", "login": "390201100321", "phone": "+998919846045", "roles": [], "groups": [{"id": 72, "name": "942-20DIo'", "curriculum": {"id": 4, "name": "Dasturiy inginiring(kunduzgi, 2020-2021)"}, "education_form": {"code": "11", "name": "Kunduzgi"}, "education_lang": {"code": "11", "name": "O‘zbek"}, "education_type": {"code": "11", "name": "Bakalavr"}}], "picture": "https://hemis.ubtuit.uz/static/crop/1/7/120_120_90_1713629299.png", "surname": "PO‘LATOV", "firstname": "ASADBEK", "birth_date": "29-07-2002", "patronymic": "DILMUROD O‘G‘LI", "university_id": "390", "student_id_number": "390201100321"}`;
        $teacher = `{"id": 69, "name": "BEKMUROD XO‘JAMURATOV", "type": "employee", "uuid": "b06ceece-3ab1-655c-c339-104713b3e743", "email": "hujamuratov@ubtuit.uz", "login": "bekmurod_xo_jamuratov", "phone": "+998977913883", "roles": [{"code": "teacher", "name": "O'qituvchi"}, {"code": "department", "name": "Kafedra mudiri"}, {"code": "academic_board", "name": "O'quv bo'limi"}], "picture": "https://hemis.ubtuit.uz/static/crop/2/1/120_120_90_2170006031.jpg", "surname": "XO‘JAMURATOV", "firstname": "BEKMUROD", "birth_date": "18-09-1992", "patronymic": "XO‘JAMUROT O‘G‘LI", "employee_id": 47, "university_id": "390", "employee_id_number": "3901511005"}`;
        DB::table('users')->insert([
            'id' => "390201100321",
            'data' => 'student',
            'selected_role' => 'student',
            'selected_department' => '0',
        ]);
        DB::table('users')->insert([
            'id' => "3901511005",
            'data' => 'teacher',
            'selected_role' => 'teacher',
            'selected_department' => '8',
        ]);
    }
}
