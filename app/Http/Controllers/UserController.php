<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\ContactUs;
use App\Blog;
use App\Subject;
use App\City;
use App\Region;
use App\Country;
use App\Education;
use App\User;
use App\Comment;
use App\PriceList;
use App\Certificate;
use App\Notification;
use App\PagesView;
use Session;
use Carbon\Carbon;
use Auth;
use Image;
use DB;

class UserController extends Controller {

    public function index() {

//        $count_teachers = "";

        $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")->leftjoin("cities", "cities.id", "=", "users.city_id")->where("users.user_active", "=", 1)->where("users.user_role", "=", 0)->orderBy('users.id', 'desc')->paginate(4);
        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');
        $cities = City::all();
        $subjects_all = Subject::all();
        $regions = Region::all();
        $count_teacher = User::where("users.user_active", "=", 1)->where("users.user_role", "=", 0)->count();
        session()->put("teacher", "no_filter");

        $rates = [];
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }

        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects[$teacher->userId] = $subject;
        }

        $meta_tags= DB::table('meta_tags')->where('page','filter')->first();


        return view('teacher-filter', [
            'teachers' => $teachers,
            'subjects' => $subjects,
            'subjects_all' => $subjects_all,
            'regions' => $regions,
            'subject_id' => "",
            'region_id' => "",
            'city_id' => "",
            'professor_home' => "",
            'student_home' => "",
            'online' => "",
            'min_price' => "",
            'max_price' => "",
            'pupil' => "",
            'student' => "",
            'adult' => "",
            'minimum' => "",
            'medium' => "",
            'maximum' => "",
            'men' => "",
            'women' => "",
            'minimum_age' => "",
            'medium_age' => "",
            'maximum_age' => "",
            'count_teacher' => $count_teacher,
            'cities' => $cities,
            'rates' => $rates,
            'meta_tags'=>$meta_tags
        ]);
    }

    public function show($lang, $id) {

        $ip = \Request::ip();
        $date = date("Y-m-d");
        $row = "";

        $views = PagesView::where("ip", $ip)->where("user_id", $id)->where("view_date", $date)->get()->toArray();

        if (empty($views)) {
            PagesView::insert([
                'ip' => $ip,
                'user_id' => $id,
                'view_date' => $date
            ]);
        }

        $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();
        $firstDayofMonth = \Carbon\Carbon::now()->firstOfMonth()->toDateString();

        $pages_views = PagesView::where("user_id", $id)->whereBetween('view_date', [$firstDayofMonth, $lastDayofMonth])->count();


        $teacher_count = User::where("users.user_active", "=", 1)->count();
        $teacher = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", "users.created_at as registerDate", "educations.*")
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("educations", "educations.id", "=", "users.education")
                        ->where('users.id', $id)->get()->first();

        $subjects = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
       
        $comments = Comment::where("user_id", $id)->where("comments.preview", "1")->get();

        $certificate = Certificate::where("user_id", $id)->get();

        $rate = Comment::where("user_id", $id)->where("comments.preview", "1")->avg('avg_value');
        $rate_count = Comment::where("user_id", $id)->where("comments.preview", "1")->count();

        $count_rate = Comment::where("user_id", $id)->where("comments.preview", "1")->count();


        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');


        foreach ($all_rating as $key => $value) {

            if ($value->user_id == $id) {
                $row = $key + 1;
            }
        }


        $other_teacher = [];

        foreach ($subjects as $key => $value) {

            $result_teacher = User::select("users.*", "users.id as user_id", "subjects.*", "subjects.id as subject_id")
                            ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                            ->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")
                            ->where('subjects.id', $value['subject_id'])
                            ->where('users.id', "<>", $id)
                            ->where("users.user_active", "=", 1)
                            ->get()->toArray();

            array_push($other_teacher, $result_teacher);
        }




        $rates = [];

        foreach ($other_teacher as $key => $values) {
            foreach ($values as $key => $value) {
                $result = Comment::where("user_id", $value['user_id'])->avg('avg_value');
                $rates[$value['user_id']] = $result;
            }
        }

        $count_notific = Notification::where("user_id", $id)->where('response', 1)->count();

        $meta_tags_info= DB::table('meta_tags')->where('page','information')->first();

        return view('teacher-details', [
            'teacher' => $teacher,
            'subjects' => $subjects,
            'comments' => $comments,
            'certificate' => $certificate,
            'other_teacher' => $other_teacher,
            'count_rate' => $count_rate,
            'count_notific' => $count_notific,
            'teacher_count' => $teacher_count,
            'pages_views' => $pages_views,
            'row' => $row,
            'rate_count' => $rate_count,
            'rates' => $rates,
            'rate' => $rate,
            'meta_tags_info'=> $meta_tags_info
        ]);
    }

    public function search($lang) {
        session()->put("teacher", "filter");
        $search = request()->search;
        $subjects_all = Subject::all();
        $regions = Region::all();
        $cities = City::all();
        $subject_id = "";
        $region_id = "";
        $city_id = "";
        $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->where("users.user_active", "=", 1)->where('name', 'like', '%' . $search . '%')->orWhere('l_name', 'like', '%' . $search . '%')->paginate(4);


        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');


        $rates = [];
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }

        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects[$teacher->userId] = $subject;
        }

        $count_teacher = count($teachers);

        return view('teacher-filter', [
            'teachers' => $teachers,
            'subjects' => $subjects,
            'rates' => $rates,
            'count_teacher' => $count_teacher,
            'subjects_all' => $subjects_all,
            'regions' => $regions,
            'cities' => $cities,
            'region_id' => $region_id,
            'city_id' => $city_id,
            "subject_id" => $subject_id
        ]);
    }

    public function account($lang) {
        if (Auth::check()) {
            $row = "";
            $id = Auth::user()->id;
            $teacher_count = User::where("users.user_active", "=", 1)->count();
            $teacher = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", "users.created_at as registerDate", "educations.*")
                            ->leftjoin("cities", "cities.id", "=", "users.city_id")
                            ->leftjoin("educations", "educations.id", "=", "users.education")
                            ->where('users.id', $id)->get()->first();

            $subjects_all = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects=[];
            foreach ($subjects_all as $key => $value) {
                $subjects[$value['id']] = $value;
            }
//        $comments = Comment::where("user_id",$id)->get();

            $certificate = Certificate::where("user_id", $id)->get();


            $rate = Comment::where("user_id", $id)->where("comments.preview", "1")->avg('avg_value');
            $rate_count = Comment::where("user_id", $id)->where("comments.preview", "1")->count();

//        $count_rate = Comment::where("user_id",$id)->count();


            $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');


            foreach ($all_rating as $key => $value) {

                if ($value->user_id == $id) {
                    $row = $key + 1;
                }
            }
            $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();
            $firstDayofMonth = \Carbon\Carbon::now()->firstOfMonth()->toDateString();
            $pages_views = PagesView::where("user_id", $id)->whereBetween('view_date', [$firstDayofMonth, $lastDayofMonth])->count();

            $notifications = Notification::select("notifications.*","notifications.id as notId","notifications.subject_id as subjectId","suggest_teachers.*","suggest_teachers.phone as phoneNumb",
                            "suggest_teachers.id as suggestId","subjects.*","contact_teacher.*","contact_teacher.id as contactId")
                            ->where("notifications.user_id", Auth::user()->id)->whereIn('notifications.response', array(0, 3))    
                            ->leftjoin("suggest_teachers", "suggest_teachers.id", "=", "notifications.suggest_id")
                            ->leftjoin("subjects", "subjects.id", "=", "suggest_teachers.subject_id")
                            ->leftjoin("contact_teacher", "contact_teacher.id", "=", "notifications.contact_id")
                            ->get()->toArray();
          
            
            $count_notific = Notification::where("user_id", Auth::user()->id)->where('response', 1)->count();
        } else {
            return route('welcome');
        }

        return view("account", [
            "teacher" => $teacher,
            "teacher_count" => $teacher_count,
            "subjects" => $subjects,
            "pages_views" => $pages_views,
            "certificate" => $certificate,
            "rate" => $rate,
            "count_notific" => $count_notific,
            "notifications" => $notifications,
            "rate_count" => $rate_count,
            "row" => $row
        ]);
    }

    public function choosen_subject($lang) {
        session()->put("teacher", "filter");
        $cities = City::all();
        $subjects_all = Subject::all();
        $regions = Region::all();
        $count_teacher = User::where("users.user_active", "=", 1)->where("users.user_role", "=", 0)->count();
        $choosen_subject = request()->choosen_subject;
        $choose_subject_cat = request()->choose_subject_cat;

        if(!empty($choosen_subject)){
        $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")
                ->leftjoin("cities", "cities.id", "=", "users.city_id")
                ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                ->where("price_lists.subject_id", $choosen_subject)
                ->where("users.user_active", "=", 1)
                ->get();
        }elseif(!empty($choose_subject_cat)){
            $where = "subjects.".$choose_subject_cat;
           $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")
                ->leftjoin("cities", "cities.id", "=", "users.city_id")
                ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                ->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")
                ->where($where, 1)
                ->where("users.user_active", "=", 1)
                ->get(); 
        }elseif (empty($choose_subject_cat) && empty($choosen_subject)){
            return redirect()->back();
        }

        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');


        $rates = [];
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }

        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")
                            ->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")
                            ->where('price_lists.user_id', $teacher->userId)
                            ->get()->toArray();

            $subjects[$teacher->userId] = $subject;
        }



        return view('teachers_subjects', [
            'teachers' => $teachers,
            'subjects' => $subjects,
            'rates' => $rates,
            'cities' => $cities,
            'regions' => $regions,
            'subjects_all' => $subjects_all]);
    }

    public function choosen_subjects_second($lang, $choosen_subject) {
        session()->put("teacher", "filter");
        request()->session()->put('subject', $choosen_subject);
        $cities = City::all();
        $subjects_all = Subject::all();
        $regions = Region::all();
        $count_teacher = User::where("users.user_active", "=", 1)->where("users.user_role", "=", 0)->count();

        $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")
                ->leftjoin("cities", "cities.id", "=", "users.city_id")
                ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                ->where("price_lists.subject_id", $choosen_subject)
                ->where("users.user_active", "=", 1)
                ->paginate(4);

        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');

        $rates = [];
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }

        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects[$teacher->userId] = $subject;
        }


        return view('teachers_subjects', [
            'teachers' => $teachers,
            'subjects' => $subjects,
            'rates' => $rates,
            'cities' => $cities,
            'regions' => $regions,
            'subjects_all' => $subjects_all]);
    }

    public function subject_city($lang) {
        session()->put("teacher", "filter");
        $cities = City::all();
        $subjects_all = Subject::all();
        $regions = Region::all();
        $count_teacher = User::where("users.user_active", "=", 1)->where("users.user_role", "=", 0)->count();
        $choosen_subject = request()->subject;
        $city = request()->city;

        if ($choosen_subject > 0 && $city != 0) {
            request()->session()->put('subject', $choosen_subject);
                             
            if (strpos($city, '1.') !== false) {
                $data = explode('.', $city);
                $region_id = $data[1];
               
                $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", 'regions.*', 'regions.id as regionId')
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("regions", "regions.id", "=", "cities.region_id")
                        ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                        ->where("price_lists.subject_id", $choosen_subject)
                        ->where("users.region_id", $region_id)
                        ->where("users.user_active", "=", 1)
                        ->get();
            } else {
                                 
               
                $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                        ->where("price_lists.subject_id", $choosen_subject)
                        ->where("users.city_id", $city)
                        ->where("users.user_active", "=", 1)
                        ->get();
            }
            
        } elseif ($choosen_subject > 0) {


            $teachers = User::select("users.*", "users.id as userId", "cities.*")
                    ->leftjoin("cities", "cities.id", "=", "users.city_id")
                    ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                    ->where("price_lists.subject_id", $choosen_subject)
                    ->where("users.user_active", "=", 1)
                    ->get();
        } else {
            if (strpos($city, '1.') !== false) {
                $data = explode('.', $city);
                $region_id = $data[1];
                $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", 'regions.*', 'regions.id as regionId')
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("regions", "regions.id", "=", "cities.region_id")
                        ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                        ->where("users.region_id", $region_id)
                        ->where("users.user_active", "=", 1)
                        ->get();
            } else {
                $teachers = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId")
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("price_lists", "price_lists.user_id", "=", "users.id")
                        ->where("users.city_id", $city)
                        ->where("users.user_active", "=", 1)
                        ->get();
            }
        }



        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');

        $rates = [];
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }

        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects[$teacher->userId] = $subject;
        }


        return view('teachers_subjects', [
            'teachers' => $teachers,
            'subjects' => $subjects,
            'count_teacher' => $count_teacher,
            'rates' => $rates,
            'cities' => $cities,
            'regions' => $regions,
            'subjects_all' => $subjects_all]);
    }

    public function filter(Request $request) {
        session()->put("teacher", "filter");

        $subject = "";
        $region = "";
        $city = "";
        $professor_home = "";
        $student_home = "";
        $online = "";
        $pupil = "";
        $student = "";
        $adult = "";
        $minimum = "";
        $medium = "";
        $maximum = "";
        $minimum_age = "";
        $medium_age = "";
        $maximum_age = "";
        $rate_subject = "";

        $min_price = $request->min_price;

        $max_price = $request->max_price;

        if ($request->subject > 0) {
            $subject = "AND subjects.id = $request->subject";
        }

        if ($request->region > 0) {
            $region = "AND regions.id = $request->region";
        }
        if ($request->city > 0) {

            $city = "AND cities.id = $request->city";
        }



        if ($request->professor_home == "on") {
            $professor_home = "AND price_lists.location_user = 'on'";
        }
        if ($request->student_home == "on") {
            $student_home = "AND price_lists.location_student = 'on'";
        }

        if ($request->online == "on") {
            $online = "AND price_lists.location_online = 'on'";
        }

        if (!empty($professor_home) && !empty($student_home) && empty($online)) {
            $location = "AND price_lists.location_user = 'on' OR price_lists.location_student = 'on'";
        } elseif (empty($professor_home) && !empty($student_home) && !empty($online)) {
            $location = "AND price_lists.location_online = 'on' OR price_lists.location_student = 'on'";
        } elseif (!empty($professor_home) && empty($student_home) && !empty($online)) {
            $location = "AND price_lists.location_online = 'on' OR price_lists.location_user = 'on'";
        } elseif (!empty($professor_home) && !empty($student_home) && !empty($online)) {
            $location = "";
        } elseif (!empty($professor_home) && empty($student_home) && empty($online)) {
            $location = $professor_home;
        } elseif (empty($professor_home) && !empty($student_home) && empty($online)) {
            $location = $student_home;
        } elseif (empty($professor_home) && empty($student_home) && !empty($online)) {
            $location = $online;
        } elseif (empty($professor_home) && empty($student_home) && empty($online)) {
            $location = "";
        }


        if ($request->pupil == "on") {
            $pupil = "AND price_lists.pupil = 1";
        }
        if ($request->student == "on") {
            $student = "AND price_lists.student = 1";
        }
        if ($request->adult == "on") {
            $adult = "AND price_lists.adult = 1";
        }

        if (!empty($pupil) && !empty($student) && empty($adult)) {
            $sphere = "AND price_lists.pupil = 1 OR price_lists.student = 1";
        } elseif (empty($pupil) && !empty($student) && !empty($adult)) {
            $sphere = "AND price_lists.adult = 1 OR price_lists.student = 1";
        } elseif (!empty($pupil) && empty($student) && !empty($adult)) {
            $sphere = "AND price_lists.adult = 1 OR price_lists.pupil = 1";
        } elseif (!empty($pupil) && !empty($student) && !empty($adult)) {
            $sphere = "";
        } elseif (!empty($pupil) && empty($student) && empty($adult)) {
            $sphere = $pupil;
        } elseif (empty($pupil) && !empty($student) && empty($adult)) {
            $sphere = $student;
        } elseif (empty($pupil) && empty($student) && !empty($adult)) {
            $sphere = $adult;
        } elseif ((empty($pupil) && empty($student) && empty($adult) ) || (!empty($pupil) && !empty($student) && !empty($adult))) {
            $sphere = "";
        }


        if ($request->minimum == "on") {
            $minimum = $request->minimum;
        }

        if ($request->medium == "on") {
            $medium = $request->medium;
        }

        if ($request->maximum == "on") {
            $maximum = $request->maximum;
        }


        if (empty($minimum) && empty($medium) && !empty($maximum)) {
            $work_exp = "AND users.work_exp > 10";
        } elseif (empty($minimum) && !empty($medium) && empty($maximum)) {
            $work_exp = "AND users.work_exp BETWEEN 5 AND 10";
        } elseif (!empty($minimum) && empty($medium) && empty($maximum)) {
            $work_exp = "AND users.work_exp < 5";
        } elseif (!empty($medium) && !empty($maximum)) {
            $work_exp = "AND users.work_exp > 5";
        } elseif (!empty($minimum) && !empty($maximum)) {
            $work_exp = "AND users.work_exp < 5 OR users.work_exp > 10";
        } elseif (!empty($minimum) && !empty($medium)) {
            $work_exp = "AND users.work_exp < 10";
        } elseif ((empty($minimum) && empty($medium) && empty($maximum)) || (!empty($minimum) && !empty($medium) && !empty($maximum))) {
            $work_exp = "";
        }


        if ((!empty($request->men) && !empty($request->women)) || (empty($request->men) && empty($request->women))) {
            $men = "";
            $women = "";
        } else {
            if ($request->men == "on") {
                $men = "AND users.gender = 'male'";
            } else {
                $men = "";
            }
            if ($request->women == "on") {
                $women = "AND users.gender = 'female'";
            } else {
                $women = "";
            }
        }

        if ($request->minimum_age == "on") {
            $minimum_age = $request->minimum_age;
        }
        if ($request->medium_age == "on") {
            $medium_age = $request->medium_age;
        }
        if ($request->maximum_age == "on") {
            $maximum_age = $request->maximum_age;
        }

        if (!empty($minimum_age) && !empty($medium_age) && !empty($maximum_age)) {
            $age = "";
        } elseif (empty($minimum_age) && !empty($medium_age) && !empty($maximum_age)) {
            $age = "AND b_day > '" . Carbon::now()->subYears(30)->toDateString() . "' ";
        } elseif (!empty($minimum_age) && !empty($medium_age) && empty($maximum_age)) {
            $age = "AND b_day < '" . Carbon::now()->subYears(30)->toDateString() . "' ";
        } elseif (!empty($minimum_age) && empty($medium_age) && !empty($maximum_age)) {
            $age = "AND b_day < '" . Carbon::now()->subYears(30)->toDateString() . "' OR b_day > '" . Carbon::now()->subYears(30)->toDateString() . "' ";
        } elseif (empty($minimum_age) && empty($medium_age) && empty($maximum_age)) {
            $age = "";
        } elseif (!empty($minimum_age) && empty($medium_age) && empty($maximum_age)) {
            $age = "AND b_day > '" . Carbon::now()->subYears(30)->toDateString() . "' ";
        } elseif (empty($minimum_age) && !empty($medium_age) && empty($maximum_age)) {
            $age = "AND b_day BETWEEN '" . Carbon::now()->subYears(50)->toDateString() . "' AND '" . Carbon::now()->subYears(30)->toDateString() . "' ";
        } elseif (empty($minimum_age) && empty($medium_age) && !empty($maximum_age)) {
            $age = "AND b_day < '" . Carbon::now()->subYears(50)->toDateString() . "'";
        }



        $sql = 'SELECT users.*,users.id as userId,price_lists.*,countries.*,regions.*,cities.*,educations.*,subjects.* from users LEFT JOIN price_lists ON  price_lists.user_id = users.id LEFT JOIN countries ON  countries.id = users.country_id LEFT JOIN regions ON  regions.id = users.region_id LEFT JOIN cities ON  cities.id = users.city_id LEFT JOIN subjects ON  subjects.id = price_lists.subject_id LEFT JOIN educations ON  educations.id = users.education WHERE users.user_active = 1 AND';
        



        $query = $sql . " " . $subject . " " . $region . " " . $city . " " . $sphere . " " . $location . " " . $work_exp . " " . $men . " " . $women . " " . $age;

        $final_query = preg_replace("/AND/", "", $query, 1);
        

        if (!empty($subject) || !empty($region) || !empty($city) || !empty($pupil) || !empty($student) || !empty($adult) || !empty($professor_home) || !empty($student_home) || !empty($online) || !empty($work_exp) || !empty($men) || !empty($women) || !empty($age)) {

            $users = DB::select($final_query . " GROUP BY users.id");
        } else {


            $users = DB::select($final_query . " GROUP BY users.id");
        }
        $users = array_reverse($users);
       


        $teachers = [];
    
        foreach ($users as $key => $value) {
            if ($value->price_user >= $min_price || $value->price_student >= $min_price || $value->price_online >= $min_price)
                if ($value->price_user <= $max_price || $value->price_student <= $max_price || $value->price_online <= $max_price) {
                    array_push($teachers, $value);
                }
        }




        $rates = [];
        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');
        foreach ($all_rating as $key => $value) {
            $rates[$value->user_id] = $value;
        }


        $subjects = [];
        foreach ($teachers as $key => $teacher) {
            $subject = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects[$teacher->userId] = $subject;
        }

        $cities = City::all();
        $subjects_all = Subject::all();
        $regions = Region::all();
        $count_teacher = count($teachers);



        return view('teacher-filter', [
            'teachers' => $teachers,
            'subject_id' => $request->subject,
            'region_id' => $request->region,
            'city_id' => $request->city,
            'professor_home' => $professor_home,
            'student_home' => $student_home,
            'online' => $online,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'pupil' => $pupil,
            'student' => $student,
            'adult' => $adult,
            'minimum' => $minimum,
            'medium' => $medium,
            'maximum' => $maximum,
            'men' => $men,
            'women' => $women,
            'minimum_age' => $minimum_age,
            'medium_age' => $medium_age,
            'maximum_age' => $maximum_age,
            'rate_subject' => $rate_subject,
            'count_teacher' => $count_teacher,
            'subjects' => $subjects,
            'subjects_all' => $subjects_all,
            'regions' => $regions,
            'cities' => $cities,
            'rates' => $rates
        ]);
    }

    public function profile($lang) {
        if (!Auth::check()) {
            return route("welcome");
        } else {
            $mess = "";
            $teacher = User::where("id", Auth::user()->id);
            $subject_us = PriceList::where("user_id", Auth::user()->id)->get();
            $countries = Country::all();
            $regions = Region::all();
            $subjects = Subject::all();
            $education = Education::all();
            $cities = City::where("region_id", Auth::user()->region_id)->get();

            $subject_user = [];
            foreach ($subject_us as $value) {
                $subject_user[$value->subject_id] = $value;
            }


            $certificates = Certificate::where("user_id", Auth::user()->id)->get();

            return view('profile', ["mess" => $mess, "teacher" => $teacher, "certificates" => $certificates, "subjects" => $subjects, 'countries' => $countries, 'regions' => $regions, 'cities' => $cities, 'subjects' => $subjects, 'education' => $education, 'subject_user' => $subject_user]);
        }
    }

    public function update_profile(Request $request, $lang) {

        if (app()->getLocale() == 'ru') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթություն';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
        } elseif (app()->getLocale() == 'en') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթություն';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
        } elseif (app()->getLocale() == 'hy') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթություն';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
        }
        $data = [];
        $data['email'] = $request->email;

        Validator::make($data, [
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id),],
//            'name' => ['required', 'string'],
//            'professor_fathername' => ['required', 'string'],
//            'professor_lname' => ['required', 'string'],
//            'country' => ['required', 'string'],
//            'city' => ['required', 'string'],
//            'region' => ['required', 'string'],
//            'professor_address' => ['required'],
//            'birth_date' => ['required'],
//            'subject' => ['required'],
//            'education' => ['required'],
//            'professor_experience' => ['required'],
//            'professor_about' => ['required'],
//            'professor_phone' => ['required', 'numeric'],
                ], [
//            'name.required' => $name,
//            'professor_fathername.required' => $professor_fathername,
//            'professor_lname.required' => $professor_lname,
//            'country.required' => $country,
//            'city.required' => $city,
//            'region.required' => $region,
//            'professor_address.required' => $professor_address,
//            'birth_date.required' => $birth_date,
//            'subject.required' => $subject,
//            'education.required' => $education,
//            'professor_experience.required' => $professor_experience,
//            'professor_about.required' => $professor_about,
//            'professor_phone.required' => $professor_phone,
            'email.required' => $email1,
            'email.unique' => $email2,
            'email.email' => $email3
        ]);

       $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'professor_fathername' => ['required', 'string'],
            'professor_lname' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'region' => ['required', 'string'],
            'birth_date' => ['required'],
            'subject' => ['required'],
            'education' => ['required'],
            'professor_experience' => ['required'],
            'professor_about' => ['required'],
            'professor_phone' => ['required', 'numeric'],
                ], [
            'name.required' => $name,
            'professor_fathername.required' => $professor_fathername,
            'professor_lname.required' => $professor_lname,
            'country.required' => $country,
            'city.required' => $city,
            'region.required' => $region,
            'birth_date.required' => $birth_date,
            'subject.required' => $subject,
            'education.required' => $education,
            'professor_experience.required' => $professor_experience,
            'professor_about.required' => $professor_about,
            'professor_phone.required' => $professor_phone
        ]);

        $result = User::find(Auth::user()->id);

        if (!empty($request->pass) || !empty($request->pass_confirmation)) {
            if (!empty($request->pass) && !empty($request->pass_confirmation)) {
                if ($request->pass != $request->pass_confirmation) {
                    return redirect()->back()->with("message", "Գաղտնաբառերը չեն համընկնում:");
                } else {
                    $result->password = Hash::make($request->pass);
                }
            } else {
                return redirect()->back()->with("message", "Փոփոխել/կրկնել գաղտնաբառը լրացված չէ:");
            }
        }

        $birth = explode(".", $request->birth_date);
        $birthday = $birth[2] . "/" . $birth[1] . "/" . $birth[0];
        $location = explode(",", $request->location);

        $result->name = $request->name;
        $result->m_name = $request->professor_fathername;
        $result->l_name = $request->professor_lname;
        $result->email = $request->email;
        $result->b_day = $birthday;
        $result->phone = $request->professor_phone;

        $result->country_id = $request->country;
        $result->region_id = $request->region;
        $result->city_id = $request->city;
        $result->address = $request->professor_address;
        $result->gender = $request->gender;
        $result->education = $request->education;
        $result->work_exp = $request->professor_experience;
        $result->description = $request->professor_about;
        $result->user_north = $location[0];
        $result->user_east = $location[1];



        
        if (!empty($request->professor_img)) {

            $image = $request->professor_img;
            $input['imagename'] = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path() . "/images/user_images/";
            $img = Image::make($image->path());
            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                
            })->save($destinationPath . '/' . $input['imagename']);
            $result->img = $input['imagename'];
        }



        $result->save();
        $online_home = [];
        $student_home = [];
        $professor_home = [];


        PriceList::where("user_id", Auth::user()->id)->delete();


        foreach ($request->subject as $key => $value) {

            if (!isset($request->online_home[$key])) {
                $online_home = null;
                $online_price = null;
                $online_time = null;
            } else {
                $online_home = $request->online_home;
                $online_price = $request->online_price[$key];
                $online_time = $request->online_time[$key];
            }

            if (!isset($request->student_home[$key])) {
                $student_home = null;
                $student_home_price = null;
                $student_home_time = null;
               
            } else {
                $student_home = $request->student_home;
                $student_home_price = $request->student_home_price[$key];
                $student_home_time = $request->student_home_time[$key];
                
            }

            if (!isset($request->professor_home[$key])) {
                $professor_home =  null;
                $professor_home_price = null;
                $professor_home_time = null;
            } else {
                $professor_home = $request->professor_home;
                $professor_home_price = $request->professor_home_price[$key];
                $professor_home_time = $request->professor_home_time[$key];
            }

            if (!isset($request->pupil)) {
                $pupil = $request->pupil = null;
            } else {
                $pupil = 1;
            }

            if (!isset($request->student)) {
                $student = $request->student = null;
            } else {
                $student = 1;
            }

            if (!isset($request->adult)) {
                $adult = $request->adult = null;
            } else {
                $adult = 1;
            }

            PriceList::insert([
                'user_id' => Auth::user()->id, //Auth::user-> id bayc skzbic insert heto;
                'subject_id' => $value,
                'location_user' => $professor_home[$key],
                'location_student' => $student_home[$key],
                'location_online' => $online_home[$key],
                'price_user' => $professor_home_price,
                'price_student' => $student_home_price,
                'price_online' => $online_price,
                'duration_user' => $professor_home_time,
                'duration_student' => $student_home_time,
                'duration_online' => $online_time,
                'pupil' => $pupil,
                'student' => $student,
                'adult' => $adult,
            ]);
        }

        if (!empty($request->certificates)) {

            foreach ($request->certificates as $key => $value) {

                $image = $value;
                $input['imagename'] = date('YmdHis').''.$key . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() . "/images/user_certificates/";
                $img = Image::make($image->path());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);


                Certificate::insert([
                    'user_id' => Auth::user()->id, //Auth::user-> id bayc skzbic insert heto;
                    'certificate' => $input['imagename'],
                ]);
            }
        }

        Auth::loginUsingId(Auth::user()->id, TRUE);
        if (Auth::check()) {
            $mess = 'Անձնական տվյալները փոփոխված են';
        } else {
            $mess = "";
        }

        $teacher = User::where("id", Auth::user()->id);
        $subject_us = PriceList::where("user_id", Auth::user()->id)->get();
        $countries = Country::all();
        $regions = Region::all();
        $subjects = Subject::all();
        $education = Education::all();
        $cities = City::where("region_id", Auth::user()->region_id)->get();

        $subject_user = [];
        foreach ($subject_us as $key => $value) {
            $subject_user[$value->subject_id] = $value;
        }


        $certificates = Certificate::where("user_id", Auth::user()->id)->get();

        return view('profile', [
            "teacher" => $teacher,
            "certificates" => $certificates,
            "subjects" => $subjects,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'subjects' => $subjects,
            'education' => $education,
            'subject_user' => $subject_user,
            'mess' => $mess
        ]);
    }

    public function archive($lang) {
//        $notifications = Notification::where("user_id", Auth::user()->id)
//                        ->leftjoin("suggest_teachers", "suggest_teachers.id", "=", "notifications.suggest_id")
//                        ->leftjoin("subjects", "subjects.id", "=", "suggest_teachers.subject_id")->orderBy("response", "asc")
//                        ->get()->toArray();
        $notifications = Notification::select("notifications.*","notifications.id as notId","notifications.subject_id as subjectId","suggest_teachers.*","suggest_teachers.phone as phoneNumb",
                            "suggest_teachers.id as suggestId","subjects.*","contact_teacher.*","contact_teacher.id as contactId")
                            ->where("notifications.user_id", Auth::user()->id)  
                            ->leftjoin("suggest_teachers", "suggest_teachers.id", "=", "notifications.suggest_id")
                            ->leftjoin("subjects", "subjects.id", "=", "suggest_teachers.subject_id")
                            ->leftjoin("contact_teacher", "contact_teacher.id", "=", "notifications.contact_id")
                            ->get()->toArray();
        
            $subjects_all = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId")->where('user_id', Auth::user()->id)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();
            $subjects=[];
            foreach ($subjects_all as $key => $value) {
                $subjects[$value['id']] = $value;
            }
           

        return view('archive', ["notifications" => $notifications,"subjects" => $subjects]);
    }

}
