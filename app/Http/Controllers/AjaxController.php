<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Region;
use App\Subject;
use DB;
use App\User;
use App\Notification;
use App\Comment;
use Carbon\Carbon;
use App\Certificate;
use App\PriceList;
use App\ContactTeacher;
use App\SuggestTeacher;
use File;
use Illuminate\Support\Facades\Mail;
use Auth;

class AjaxController extends Controller {

    public function regions(Request $request) {

        $region = Region::where('country_id', $request->country)->get();

        if (!empty($region)) {
            return json_encode($region);

        } else {
            return 0;
        }
    }

    public function cities(Request $request) {

        $city = City::where('region_id', $request->region)->get();

        if (!empty($city)) {
            return json_encode($city);

        } else {
            return 0;
        }
    }

    public function subject(Request $request) {
        $column = $request->val;
        $subject = Subject::where($column, 1)->get();

        if (!empty($subject)) {
            return json_encode($subject);
            ;
        } else {
            return 0;
        }
    }

//    public function filter(Request $request) {
//
//        
//        $lang = "";
//        $subject = "";
//        $region = "";
//        $country = "";
//        $professor_home = ""; 
//        $student_home = "";
//        $online = "";
//        $min_price = "";
//        $max_price = "";
//        $pupil = "";
//        $student = "";
//        $adult = "";
//        $minimum = "";
//        $medium = "";
//        $maximum = "";
//        $men = "";
//        $women = "";
//        $minimum_age = "";
//        $medium_age = "";
//        $maximum_age = "";
//        $rate_subject = "";
//        
//        foreach ($request->data as $param) {
//            if($param['name'] == "min_price"){
//                $min_price = $param['value'];
//            }
//            if($param['name'] == "max_price"){
//                $max_price = $param['value'];
//            }
//        }
//        
//        foreach ($request->data as $param) {
//            
//            if($param['name'] == "lang"){
//                $lang = $param['value'];
//            }
//            
//            if($param['name'] == "subject"){
//                $subject = $param['value'];
//                $subject = "AND subjects.id = $subject";
//                $rate_subject = "AND subject_id =".$param['value'];
//            }
//            if($param['name'] == "region" && $param['value'] > 0){
//                $region = $param['value'];
//                $region = "AND regions.id = $region";
//            }
//            if($param['name'] == "country" && $param['value'] > 0){
//                $country = $param['value'];
//                $country = "AND countries.id = $country";
//            }
//            if($param['name'] == "professor_home"){
//                $professor_home = $param['value'];
//                $professor_home = "AND price_lists.location_user = on AND price_lists.price_user BETWEEN $min_price and $max_price";
//            }
//            if($param['name'] == "student_home"){
//                $student_home = $param['value'];
//                $student_home = "AND price_lists.location_student = on AND price_lists.price_student BETWEEN $min_price and $max_price";
//            }
//            if($param['name'] == "online"){
//                $online = $param['value'];
//                $online = "AND price_lists.location_online = on AND price_lists.price_online BETWEEN $min_price and $max_price";
//            }
//            
//            if($param['name'] == "pupil"){
//                $pupil = $param['value'];
//                $pupil = "AND price_lists.pupil = 1";
//            }
//            if($param['name'] == "student"){
//                $student = $param['value'];
//                $student = "AND price_lists.student = 1";
//            }
//            if($param['name'] == "adult"){
//                $adult = $param['value'];
//                $adult = "AND price_lists.adult = 1";
//            }
//            
//            if($param['name'] == "minimum"){
//                $minimum = $param['value'];
//                $minimum = "AND users.work_exp < 5";
//            }
//            
//            if($param['name'] == "medium"){
//                $medium = $param['value'];
//                $medium = "AND users.work_exp BEETWEEN 5 AND 10";
//            }
//            if($param['name'] == "maximum"){
//                $maximum = $param['value'];
//                $maximum = "AND users.work_exp > 10";
//            }
//            
//            if($param['name'] == "men"){
//                $men = $param['value'];
//                $men = "AND users.gender = men";
//            }
//            if($param['name'] == "women"){
//                $women = $param['value'];
//                $women = "AND users.gender = women";
//            }
//            
//            if($param['name'] == "minimum_age"){
//                $minimum_age = $param['value'];
//                $minimum_age = "AND b_day < ".Carbon::now()->subYears(30);
//            }
//            if($param['name'] == "medium_age"){
//                $medium_age = $param['value'];
//                $medium_age = "AND b_day BEETWEEN ".Carbon::now()->subYears(30)." and ".Carbon::now()->subYears(50);
//            }
//            if($param['name'] == "maximum_age"){
//                $maximum_age = $param['value'];
//                $maximum_age = "AND b_day > ".Carbon::now()->subYears(50);
//            }
//           
//        }
//        
//        if(empty($professor_home) && empty($student_home) && empty($online)){
//              $price = "AND (price_lists.price_user BETWEEN $min_price and $max_price  OR price_lists.price_student BETWEEN $min_price and $max_price OR price_lists.price_online BETWEEN $min_price and $max_price)"; 
//        }else{
//            $price = "";
//        }
//            
//        
//        $sql = "SELECT users.*,users.id as userId,price_lists.*,countries.*,regions.*,cities.*,educations.*,subjects.* from users LEFT JOIN price_lists ON  price_lists.user_id = users.id LEFT JOIN countries ON  countries.id = users.country_id LEFT JOIN regions ON  regions.id = users.region_id LEFT JOIN cities ON  cities.id = users.city_id LEFT JOIN subjects ON  subjects.id = price_lists.subject_id LEFT JOIN educations ON  educations.id = users.education WHERE";
//        
//          $query =  $sql." ".$subject." ".$region." ".$country." ".$professor_home." ".$student_home." ".$online.
//            " ".$pupil." ".$student." ".$adult." ".$minimum." ".$medium." ".$maximum." ".$men." ".$women." ".$minimum_age." ".$medium_age." ".$maximum_age." ".$price; 
//
//        $final_query =  preg_replace("/AND/", "", $query, 1);
//
//        $result = DB::select($final_query);
//
//       
//       
//        $rates = [];
//        $response = [];
//       
//        if(!empty($result)){
//            foreach ($result as $key => $value){
//               $all_rating = DB::select('select comments.subject_id, comments.user_id, AVG(comments.avg_value) as teacher_val, count(user_id) as count_comment from comments WHERE user_id = '.$value->user_id);
//             
//               $rates[$value->user_id]['count_comment'] = $all_rating[0]->count_comment;
//               $rates[$value->user_id]['teacher_val'] = $all_rating[0]->teacher_val;
//            }
//        }
// 
//        array_push($response, $rates);
//        array_push($response, $result);
//        
//       
//        if(!empty($response)){
//            return json_encode($response);
//        }else{
//            return 0;
//        }
//    }


    public function subject_add() {
        $subject = Subject::all();

        if (!empty($subject)) {
            return json_encode($subject);
            ;
        } else {
            return 0;
        }
    }

    public function del_cert(Request $request) {
        $cert = $request->cert;
        $id = $request->number;
        $destinationPathFile = 'images/user_certificates/' . $cert;
        File::delete(public_path($destinationPathFile));

        $result = Certificate::where("certificate", "=", $cert)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function del_sub(Request $request) {
        $number = $request->number;

        $result = PriceList::where("id", "=", $number)->delete();

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function comment(Request $request) {
        $number = $request->number;
        $val = $request->val;

        $comment = Comment::where('id', $number)->update([
            'preview' => $val
        ]);

        if ($comment) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function sendemail(Request $request) {
        $email = $request->email;
        $id = $request->number;
        $text = $request->text_mess;


        Mail::send('admin.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
            $message->to($email)->subject('No Reply');
        });
        $res = ContactTeacher::where("id", $id)->update(['resend' => 1]);
        if ($res) {

            echo 1;
        } else {
            echo 0;
        }
    }

    public function sendemailteacher(Request $request) {
        $email = $request->email;
        $id = $request->number;
        $teacher_id = $request->teacher;
        $subject_id = $request->subject_id;
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>
Համապատասխան նոր հարցում
Բարև՛ Ձեզ: Առկա է Ձեզ համար համապատասխան հարցում: Ըստ մեր խորհրդատուի որոշման՝ դուք համապաատասխանում եք տվյալ հարցումը ներկայացրած ուսանողին: Մանրամասն տեղեկությունը կարող եք տեսնել մեր կայքում՝  « Նոր հարցումներ» բաժնում:

Новая подходящая заявка
Здравствуйте! Для вас есть подходящая заявка. Наш консультант решил, что вы подходите ученику, оставившему данную заявку. Подробную информацию можно увидеть на нашем сайте в разделе "Новые заявки". 

New suitable application 
Hello! There is a suitable application for you. Our consultant has decided that you are suitable for the student who left this application. Detailed information can be found on our website in the "New Applications" section.
';

        Mail::send('admin.visitor_email', ['name' => "Admin", 'email' => "", 'title' => "Նոր հարցում/Новая заявка/New application", 'content' => "$text"], function ($message) use($email) {
            $message->to($email)->subject('No Reply');
        });


        $res = Notification::insert([
                    'user_id' => $teacher_id,
                    'suggest_id' => $id,
                    'subject_id' => $subject_id
        ]);

        if ($res) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function sendemailteachersecond(Request $request) {
        $email = $request->email;
        $id = $request->number;
        $teacher_id = $request->teacher;
        $subject_id = $request->subject_id;
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>
Համապատասխան նոր հարցում
Բարև՛ Ձեզ: Առկա է Ձեզ համար համապատասխան հարցում: Ըստ մեր խորհրդատուի որոշման՝ դուք համապաատասխանում եք տվյալ հարցումը ներկայացրած ուսանողին: Մանրամասն տեղեկությունը կարող եք տեսնել մեր կայքում՝  « Նոր հարցումներ» բաժնում:

Новая подходящая заявка
Здравствуйте! Для вас есть подходящая заявка. Наш консультант решил, что вы подходите ученику, оставившему данную заявку. Подробную информацию можно увидеть на нашем сайте в разделе "Новые заявки". 

New suitable application 
Hello! There is a suitable application for you. Our consultant has decided that you are suitable for the student who left this application. Detailed information can be found on our website in the "New Applications" section.
';

        Mail::send('admin.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
            $message->to($email)->subject('Նոր հարցում/Новая заявка/New application ');
        });


        $res = Notification::insert([
                    'user_id' => $teacher_id,
                    'contact_id' => $id,
                    'subject_id' => $subject_id
        ]);
        
        ContactTeacher::where('id',$id)->update([
                    'resend' => 1
        ]);
        
        

        if ($res) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function sendemailall(Request $request) {
        $emails = $request->email;
        $id = $request->number;
        $teacher_id = $request->teacher;
        $subject_id = $request->subject_id;
       $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Ձեր անկետան կայքում արգելափակված է «ՕԳՏԱՏԻՐԱԿԱՆ ՀԱՄԱՁԱՅՆԱԳՐԻ» խախտման պատճառով: Այն վերաբացելու համար հարկավոր է իրականացնել վճարում ձևակերպված պատվերի համար: Վճարումը կատարելուց անմիջապես հետո Ձեր անկետան կվերականգնվի: 

Ваша анкета на  сайте заблокирована из-за нарушения Пользовательского соглашения. Для ее разблокирования следует осуществить оплату за оформленный заказ. Сразу же после оплаты Ваша анкета будет разблокирована. 

Your profile on the site has been blocked due to violation of the User Agreement. To unblock it, you must pay for the placed order. Immediately after payment, your profile will be unlocked.
';


        foreach ($teacher_id as $key => $value) {
            $result = Notification::where("user_id", $value)->where("suggest_id", $id)->get()->toArray();
            if (empty($result)) {
                $res = Notification::insert([
                            'user_id' => $value,
                            'subject_id' => $subject_id,
                            'suggest_id' => $id
                ]);
            }
            $email = $emails[$key];
            /* ete mi angam uxarkvel e, noric uxarkel? */
            Mail::send('admin.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
                $message->to($email)->subject('Նոր հարցում/Новая заявка/New application ');
            });
        }


        if ($res) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function user_active(Request $request) {
        $number = $request->number;
        $val = $request->val;
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Ձեր անկետան կայքում արգելափակված է «ՕԳՏԱՏԻՐԱԿԱՆ ՀԱՄԱՁԱՅՆԱԳՐԻ» խախտման պատճառով: Այն վերաբացելու համար հարկավոր է իրականացնել վճարում ձևակերպված պատվերի համար: Վճարումը կատարելուց անմիջապես հետո Ձեր անկետան կվերականգնվի: 

Ваша анкета на  сайте заблокирована из-за нарушения Пользовательского соглашения. Для ее разблокирования следует осуществить оплату за оформленный заказ. Сразу же после оплаты Ваша анкета будет разблокирована. 

Your profile on the site has been blocked due to violation of the User Agreement. To unblock it, you must pay for the placed order. Immediately after payment, your profile will be unlocked.
';
        
        $find = User::where("id",$number)->first();
        $user_active = User::where('id', $number)->update([
            'user_active' => $val
        ]);
        $email = $find->email;
        if($find->user_active == 1 && $val == 0){
                 Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => $text], function ($message) use($email) {
                    $message->to($email)->subject('Պրոֆիլի արգելափակում/Блокировка анкеты/ Blocking a profile');
                });
        }
        
        if($find->user_active == 0 && $val == 1){
            Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => '<img src="https://dasaxos.am/dasaxos.jpg"><pre>
Ձեր անկետան վերականգնված է:

Ваша анкета разблокирована. 

Your profile is unlocked.'], function ($message) use($email) {
                    $message->to($email)->subject('Պրոֆիլի վերականգնում /Разблокирование анкеты/Profile unblocking');
                });
        }
               

        if ($user_active) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function acceptnot(Request $request) {
        $suggest_id = $request->suggest_id;
        $contact_id = $request->contact_id;
        $number = $request->number;
        $user_id = Auth::user()->id;
        
        if(!empty($suggest_id)){
            
            $user_accept = Notification::where('suggest_id', $suggest_id)
                ->where('id', $number)
                ->update([
            'response' => 1
        ]);

        $user_late = Notification::where('suggest_id', $suggest_id)->where('user_id', "<>", $user_id)
                ->update([
            'response' => 3
        ]);
            
        }else{
         
           $user_accept = Notification::where('id', $number)
                ->update([
            'response' => 1
            ]);
        }

        

        $count = Notification::where('user_id', $user_id)->whereIn('response', array(0, 3))->count();

        if (isset($user_accept)) {
           return json_encode($count);
        } else {
            echo -1;
        }
    }

    public function declinenot(Request $request) {
        $suggest_id = $request->suggest_id;
        $user_id = Auth::user()->id;
        $number = $request->number;

        $user_decline = Notification::where('id', $number)
                ->where('user_id', $user_id)
                ->update([
            'response' => 2
        ]);

        $count = Notification::where('user_id', $user_id)->whereIn('response', array(0, 3))->count();

        if (isset($user_decline)) {
           return json_encode($count);
        } else {
            echo -1;
        }
    }

    public function archivenot(Request $request) {
        $suggest_id = $request->suggest_id;
        $user_id = Auth::user()->id;

        $user_archive = Notification::where('suggest_id', $suggest_id)
                ->where('user_id', $user_id)
                ->update([
            'response' => 4
        ]);

        $count = Notification::where('user_id', $user_id)->whereIn('response', array(0, 3))->count();


        if (isset($user_archive)) {
            return json_encode($count);
        } else {
            echo -1;
        }
    }
    public function modal(Request $request) {
        $id = $request->number;

        $price = PriceList::where('user_id', $id)->leftjoin("subjects","subjects.id","=","price_lists.subject_id")->get()->toArray();
                

        if (isset($price)) {
            return $price;
        } else {
            echo -1;
        }
    }
    public function deleteslider(Request $request) {
        $id = $request->number;

        $res = DB::table("other")->where('id', $id)->delete();
                

        if (isset($res)) {
            return 1;
        } else {
            echo -1;
        }
    }

}
