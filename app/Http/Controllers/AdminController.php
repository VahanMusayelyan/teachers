<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use App\User;
use App\ContactTeacher;
use App\PriceList;
use App\Comment;
use App\Subject;
use App\Certificate;
use App\Notification;
use App\PagesView;
use App\SuggestTeacher;
use DB;
use Image;
use Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller {

    public function index() {

        return view("admin_home");
    }

    public function contact() {
        if(request()->number){
            
            ContactUs::select()->where("id", request()->number)->delete();
        }
        
        $result = ContactUs::select()->orderBy("id", "DESC")->paginate(10);

        return view("admin.contact", ["result" => $result]);
    }

    public function contact_teachers() {
        if(!empty(request()->number)){
        ContactTeacher::where("id",request()->number)->delete();
        Notification::where("contact_id","=",request()->number)->delete();
        }
        
        $result = ContactTeacher::select("contact_teacher.*", "users.id as userId", "users.name as userName", "users.l_name as userLName", "users.email as userEmail")->leftjoin("users", "users.id", "=", "contact_teacher.user_id")->orderBy("id", "DESC")->paginate(10);
        $notifications = Notification::select()->where("contact_id",">","0")->get()->toArray();
        $not = [];
        foreach ($notifications as $key => $value){
           $not[$value['contact_id']] = $value;
        }
        
        return view("admin.contact_teacher", ["result" => $result,"not" => $not]);
    }

    public function teachers() {
        $result = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", "regions.*", "regions.id as regionId")
                ->leftjoin("cities", "cities.id", "=", "users.city_id")
                ->leftjoin("regions", "regions.id", "=", "users.region_id")
                ->where("users.user_role",0)
                ->orderby("users.id",'desc')
                ->paginate(10);
        return view("admin.teachers", ["result" => $result]);
    }

    public function teacher_show(Request $request, $id) {
      
        if($request->number){
            $price_user = $request->price_user;
            $price_student = $request->price_student;
            $price_online = $request->price_online; 
            foreach ($request->number as $key => $value){

             PriceList::where('id', $value)->update([
              'price_user' => $price_user[$key],
              'price_student' => $price_student[$key],
              'price_online' => $price_online[$key]
                ]);
            }
        }
        if($request->description){
            
             User::where('id', $request->user)->update([
              'description' => $request->description
                ]);
        }
        $row = "";
        $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();
        $firstDayofMonth = \Carbon\Carbon::now()->firstOfMonth()->toDateString();

        $pages_views = PagesView::where("user_id", $id)->whereBetween('view_date', [$firstDayofMonth, $lastDayofMonth])->count();


        $teacher_count = User::count();
        $teacher = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", "users.created_at as registerDate", "educations.*")
                        ->leftjoin("cities", "cities.id", "=", "users.city_id")
                        ->leftjoin("educations", "educations.id", "=", "users.education")
                        ->where('users.id', $id)->get()->first();

        $subjects = PriceList::select("price_lists.*", "subjects.*", "subjects.id as subjectId","price_lists.id as priceListsId")->where('user_id', $teacher->userId)->leftjoin("subjects", "subjects.id", "=", "price_lists.subject_id")->get()->toArray();

        $comments = Comment::where("user_id", $id)->where("comments.preview", "1")->get();

        $certificate = Certificate::where("user_id", $id)->get();

        $rate = Comment::where("user_id", $id)->avg('avg_value');

        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');

         $count_notific = Notification::where("user_id",$id)->where('response',1)->count();

        foreach ($all_rating as $key => $value) {

            if ($value->user_id == $id) {
                $row = $key + 1;
            }
        }

        return view("admin.teacher_admin_details", [
            "pages_views" => $pages_views,
            "teacher_count" => $teacher_count,
            "teacher" => $teacher,
            "row" => $row,
            "count_notific" => $count_notific,
            "subjects" => $subjects,
            "comments" => $comments,
            "certificate" => $certificate,
            "rate" => $rate
        ]);
    }

    public function suggest_teachers() {
        if(!empty(request()->number)){
            SuggestTeacher::where("id",request()->number)->delete();
        }
        $result = SuggestTeacher::select("suggest_teachers.*","suggest_teachers.id as suggestTeacherId", "suggest_teachers.id as suggestId", "subjects.*", "subjects.id as subjectId")->leftjoin("subjects", "subjects.id", "=", "suggest_teachers.subject_id")
                        ->orderBy("suggest_teachers.id", "desc")->paginate(10);
        
        return view("admin.suggest_teachers", ["result" => $result]);
    }

    public function subject_teacher($id) {
        $result = SuggestTeacher::where('id', $id)->first();
        
        $men = "";
        $women = "";
        $subject = "";
        $professor_home = "";
        $student_home = "";
        $online = "";
        $pupil = "";
        $student = "";
        $adult = "";
        $minimum = $result->exp_min;
        $medium = $result->exp_med;
        $maximum = $result->exp_max;
        
        $subject_name = Subject::where("id",$result->subject_id)->first();
        

        $min_price = $result->price_min;

        $max_price = $result->price_max;
        
      
        if ($result->subject_id > 0) {
            $subject = "AND subjects.id = $result->subject_id";
        }

        if ($result->loc_proffes == "on") {
            $professor_home = "AND price_lists.location_user = 'on'";
        }
        if ($result->loc_student == "on") {
            $student_home = "AND price_lists.location_student = 'on'";
        }

        if ($result->loc_online == "on") {
            $online = "AND price_lists.location_online = 'on'";
        }
        
        if (!empty($professor_home) && !empty($student_home) && empty($online)) {
            $location = "AND (price_lists.location_user = 'on' OR price_lists.location_student = 'on') ";
        } elseif (empty($professor_home) && !empty($student_home) && !empty($online)) {
            $location = "AND (price_lists.location_online = 'on' OR price_lists.location_student = 'on') ";
        } elseif (!empty($professor_home) && empty($student_home) && !empty($online)) {
            $location = "AND (price_lists.location_online = 'on' OR price_lists.location_user = 'on') ";
        } elseif (!empty($professor_home) && !empty($student_home) && !empty($online)) {
            $location = "";
        } elseif (!empty($professor_home) && empty($student_home) && empty($online)) {
            $location = $professor_home;
        } elseif (empty($professor_home) && !empty($student_home) && empty($online)) {
            $location = $student_home;
        } elseif (empty($professor_home) && empty($student_home) && !empty($online)) {
            $location = $online;
        }elseif(empty($professor_home) && empty($student_home) && empty($online)){
            $location="";
        }
        
       
        if ($result->pupil == "on") {
            $pupil = "AND price_lists.pupil = 1";
        }
        if ($result->student == "on") {
            $student = "AND price_lists.student = 1";
        }
        if ($result->adult == "on") {
            $adult = "AND price_lists.adult = 1";
        }

        if (!empty($pupil) && !empty($student) && empty($adult)) {
            $sphere = "AND (price_lists.pupil = 1 OR price_lists.student = 1) ";
        } elseif (empty($pupil) && !empty($student) && !empty($adult)) {
            $sphere = "AND (price_lists.adult = 1 OR price_lists.student = 1) ";
        } elseif (!empty($pupil) && empty($student) && !empty($adult)) {
            $sphere = "AND (price_lists.adult = 1 OR price_lists.pupil = 1) ";
        } elseif (!empty($pupil) && !empty($student) && !empty($adult)) {
            $sphere = "";
        } elseif (!empty($pupil) && empty($student) && empty($adult)) {
            $sphere = $pupil;
        } elseif (empty($pupil) && !empty($student) && empty($adult)) {
            $sphere = $student;
        } elseif (empty($pupil) && empty($student) && !empty($adult)) {
            $sphere = $adult;
        }elseif((empty($pupil) && empty($student) && empty($adult) ) || (!empty($pupil) && !empty($student) && !empty($adult))){
            $sphere = "";
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
            $work_exp = "AND (users.work_exp < 5 OR users.work_exp > 10) ";
        } elseif (!empty($minimum) && !empty($medium)) {
            $work_exp = "AND users.work_exp < 10";
        } elseif ((empty($minimum) && empty($medium) && empty($maximum)) || (!empty($minimum) && !empty($medium) && !empty($maximum))) {
            $work_exp = "";
        }

      
        if ((!empty($result->gender_male) && !empty($result->gender_female)) || (empty($result->gender_male) && empty($result->gender_female))) {
            $men = "";
            $women = "";
        } else {
            if ($result->gender_male == "on") {
                $men = "AND users.gender = 'male'";
            }
            if ($result->gender_female == "on") {
                $women = "AND users.gender = 'female'";
            }
        }

   
        $sql = "SELECT users.*,users.id as userId,price_lists.*,countries.*,regions.*,cities.*,educations.*,subjects.* from users LEFT JOIN price_lists ON  price_lists.user_id = users.id LEFT JOIN countries ON  countries.id = users.country_id LEFT JOIN regions ON  regions.id = users.region_id LEFT JOIN cities ON  cities.id = users.city_id LEFT JOIN subjects ON  subjects.id = price_lists.subject_id LEFT JOIN educations ON  educations.id = users.education WHERE";


        $query = $sql . " " . $subject . " " . $sphere . " " . $location . " " . $work_exp . " " . $men . " " . $women ;

        $final_query = preg_replace("/AND/", "", $query, 1);

      
        $users = DB::select($final_query . " GROUP BY users.id");
        
  
        $teachers = [];
        $notifications = [];
        
        foreach ($users as $value) {
            if ($value->price_user > $min_price || $value->price_student > $min_price || $value->price_online > $min_price)
                if ($value->price_user < $max_price || $value->price_student < $max_price || $value->price_online < $max_price) {
                    array_push($teachers, $value);
                }
                $res = Notification::where("user_id",$value->user_id)->where("suggest_id",$id)->first();
                $notifications[$value->user_id] = $res;
        }
       
        $rates = [];
        $all_rating = DB::select('select comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments where comments.preview = 1 GROUP BY comments.user_id ORDER BY comments.avg_value DESC');
        foreach ($all_rating as $value) {
            $rates[$value->user_id] = $value;
        }
        
        
        
        
        return view("admin.notification_teachers", ["teachers" => $teachers,"rates" => $rates,"subject_name" => $subject_name,"id"=>$id,"notifications"=>$notifications]);
      
    }
    
    public function other() {
        
        $background = DB::table("other")->select()->where('property','=','background')->first();
        $bottom_img = DB::table("other")->select()->where('property','=','bottom_img')->first();
        $slider = DB::table("other")->select()->where('property','=','slider')->get()->toArray();
        $phone = DB::table("other")->select()->where('property','=','phone')->first();
        $about_img = DB::table("other")->select()->where('property','=','about_img')->first();
        
        return view('admin.other',['phone'=>$phone,'slider'=>$slider,'bottom_img'=>$bottom_img,'background'=>$background,'about_img'=>$about_img]);
    }
    
    public function update_other(Request $request) {
       
        
        if(!empty($request->slider)){
        foreach ($request->slider as $key => $value){
                
                $destinationPath = public_path()."/img/";
                $files = $value;
                $user_cert = 'slider'.$key.''. date('YmdHis') . '.' . $files->getClientOriginalExtension();
           
                $files->move($destinationPath, $user_cert);
            
                DB::table('other')->insert([
                   'value' => $user_cert, 
                   'property' => 'slider',
                ]);

            }
        }
            
        if(!empty($request->phone)){

                DB::table('other')->where('property',"=","phone")->update([
                   'value' => $request->phone, 
                ]);

            }
        if(!empty($request->background)){
                DB::table('other')->where("property", "=", "background")->delete();
                
            $image = $request->background;
            $input['imagename'] = date('YmdHis') . '1.' . $image->getClientOriginalExtension();
            $destinationPath = public_path() . "/img/";
            $img = Image::make($image->path());
            $img->resize(1920, 950, function ($constraint) {
                $constraint->aspectRatio();
                
            })->save($destinationPath . '/' . $input['imagename']);
           
                
                
                
//                $value = $request->background;
//                $destinationPath = public_path()."/img/";
//                $files = $value;
//                $user_cert = date('YmdHis') . '1.' . $files->getClientOriginalExtension();
//           
//                    $files->move($destinationPath, $user_cert);
            
                DB::table('other')->insert([
                   'value' => $input['imagename'], 
                   'property' => 'background',
                ]);

            }
        if(!empty($request->bottom_img)){
                DB::table('other')->where("property", "=", "bottom_img")->delete();
                $value = $request->bottom_img;
                $destinationPath = public_path()."/img/";
                $files = $value;
                $user_cert = date('YmdHis') . '0.' . $files->getClientOriginalExtension();
           
                    $files->move($destinationPath, $user_cert);
            
                DB::table('other')->insert([
                   'value' => $user_cert, 
                   'property' => 'bottom_img',
                ]);

            }
        if(!empty($request->about_img)){
                DB::table('other')->where("property", "=", "about_img")->delete();
                $value = $request->about_img;
                $destinationPath = public_path()."/img/";
                $files = $value;
                $user_cert = date('YmdHis') . '2.' . $files->getClientOriginalExtension();
           
                    $files->move($destinationPath, $user_cert);
            
                DB::table('other')->insert([
                   'value' => $user_cert, 
                   'property' => 'about_img',
                ]);

            }

        $background = DB::table("other")->select()->where('property','=','background')->first();
        $bottom_img = DB::table("other")->select()->where('property','=','bottom_img')->first();
        $slider = DB::table("other")->select()->where('property','=','slider')->get()->toArray();
        $phone = DB::table("other")->select()->where('property','=','phone')->first();
        $about_img = DB::table("other")->select()->where('property','=','about_img')->first();
        
        return view('admin.other',['phone'=>$phone,'slider'=>$slider,'bottom_img'=>$bottom_img,'background'=>$background,'about_img'=>$about_img]);
    }
    
    public function language() {
      
        return view("admin.language");
    }
    
    public function update_language(Request $request) {
        
     
       if(!empty($request->hy)){
                $value = $request->hy;
                $destinationPath = public_path()."/doc/hy/";
                $destinationPath1 = base_path()."/resources/lang/hy/";
                $files = $value;
                $messege = 'messege.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $messege);
                copy($destinationPath.$messege, $destinationPath1.$messege);
                
       }
       if(!empty($request->en)){
                $value = $request->en;
                $destinationPath = public_path()."/doc/en/";
                $destinationPath1 = base_path()."/resources/lang/en/";
                $files = $value;
                $messege = 'messege.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $messege);
                copy($destinationPath.$messege, $destinationPath1.$messege);
           
       }
       if(!empty($request->ru)){
                $value = $request->ru;
                $destinationPath = public_path()."/doc/ru/";
                $destinationPath1 = base_path()."/resources/lang/ru/";
                $files = $value;
                $messege = 'messege.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $messege);
                copy($destinationPath.$messege, $destinationPath1.$messege);
           
       }
       
       return redirect()->back();
    }
    
    public function download( $filename = '' )
    {   
        
        if(!empty($filename)){
            $filename = explode("_", $filename);
        }
        // Check if file exists in app/storage/file folder
        $file_path = public_path() . "/doc/".$filename[0]."/" . $filename[1];
        $headers = array(
            'Content-Type: php',
            'Content-Disposition: attachment; filename='.$filename[1],
        );
        if ( file_exists( $file_path ) ) {
            // Send Download
            return \Response::download( $file_path, $filename[1], $headers );
        } else {
            // Error
            exit( 'Փորձել կրկին' );
        }
    }

    public function search_teacher(Request $request){
        $search = $request->search;
        $result = User::select("users.*", "users.id as userId", "cities.*", "cities.id as cityId", "regions.*", "regions.id as regionId")
            ->leftjoin("cities", "cities.id", "=", "users.city_id")
            ->leftjoin("regions", "regions.id", "=", "users.region_id")
            ->where('name', 'like', '%' . $search . '%')->orWhere('l_name', 'like', '%' . $search . '%')
            ->where("users.user_role",0)
            ->orderby("users.id",'desc')
            ->get();
        return view("admin.teachers_find", ["result" => $result,"search"=>$search]);


    }



}
