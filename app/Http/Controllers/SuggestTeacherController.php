<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuggestTeacher;
use App\Subject;
use Illuminate\Support\Facades\Mail;
use DB;


class SuggestTeacherController extends Controller {

    public function index(Request $request) {
        if (app()->getLocale() == 'ru') {
            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email_email = 'Էլ. հասցեն վավեր չէ';
            $phone_req = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $subject = 'Պարտադիր է լրացնել առարկան';
        } elseif (app()->getLocale() == 'en') {

            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email_email = 'Էլ. հասցեն վավեր չէ';
            $phone_req = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $subject = 'Պարտադիր է լրացնել առարկան';
        } elseif (app()->getLocale() == 'hy') {

            $name_req = 'Պարտադիր է լրացնել անունը';
            $email_req = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email_email = 'Էլ. հասցեն վավեր չէ';
            $phone_req = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $subject = 'Պարտադիր է լրացնել առարկան';
        }

        $validatedData = $request->validate([
            'your_name' => ['required'],
            'your_email' => ['required', 'email'],
            'your_phone' => ['required'],
            'subject' => ['required']
                ], [
            'your_name.required' => $name_req,
            'your_email.required' => $email_req,
            'your_email.email' => $email_email,
            'your_phone.required' => $phone_req,
            'subject.required' => $subject,
        ]);

        if (!isset($request->men)) {
            $request->men = null;
        }
        if (!isset($request->women)) {
            $request->women = null;
        }
        if (!isset($request->minimum)) {
            $request->minimum = null;
        }
        if (!isset($request->medium)) {
            $request->medium = null;
        }
        if (!isset($request->maximum)) {
            $request->maximum = null;
        }
        if (!isset($request->professor_home)) {
            $request->professor_home = null;
        }
        if (!isset($request->student_home)) {
            $request->student_home = null;
        }
        if (!isset($request->online)) {
            $request->online = null;
        }
        if (!isset($request->pupil)) {
            $request->pupil = null;
        }
        if (!isset($request->student)) {
            $request->student = null;
        }
        if (!isset($request->adult)) {
            $request->adult = null;
        }

        if (app()->getLocale() == 'ru') {
            $message = 'Ձեր նամակը ուղարկվել է';
        } elseif (app()->getLocale() == 'en') {
           $message = 'Ձեր նամակը ուղարկվել է';
        } elseif (app()->getLocale() == 'hy') {
            $message = 'Ձեր նամակը ուղարկվել է';
        }


        SuggestTeacher::insert([
            'name' => $request->your_name,
            'email' => $request->your_email,
            'phone' => $request->your_phone,
            'subject_id' => $request->subject,
            'gender_male' => $request->men,
            'gender_female' => $request->women,
            'exp_min' => $request->minimum,
            'exp_med' => $request->medium,
            'exp_max' => $request->maximum,
            'loc_proffes' => $request->professor_home,
            'loc_student' => $request->student_home,
            'loc_online' => $request->online,
            'pupil' => $request->pupil,
            'student' => $request->student,
            'adult' => $request->adult,
            'price_min' => $request->min_price,
            'price_max' => $request->max_price,
            'ip' => \Request::ip()
        ]);

        $email = "dasaxos-am@mail.ru";
        $text = '<img src="https://dasaxos.am/dasaxos.jpg"><pre>Առկա է նոր հարցում դասավանդողի ընտրություն բաժնում';
                Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "$text"], function ($message) use($email) {
                $message->to($email)->subject('Նոր հարցում');
                });


        return redirect()->back()->with('success', $message);
    }
    
    public function show_form($lang) {
        
        $subjects = Subject::all();
        $meta_tags= DB::table('meta_tags')->where('page','select_teacher')->first();

        return view("suggest-teacher",["subjects" => $subjects,'meta_tags'=>$meta_tags]);
    }

}
