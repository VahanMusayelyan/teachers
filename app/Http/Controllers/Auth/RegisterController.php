<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\PriceList;
use App\Certificate;
use Auth;
use ImageResize;
use App\City;
use App\Region;
use App\Country;
use App\Subject;
use App\Education;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Image;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        session()->put("register", "true");
        if (app()->getLocale() == 'ru') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $professor_address = 'Պարտադիր է լրացնել հասցեն';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթությունը';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
            $password1 = 'Պարտադիր է լրացնել գաղտնաբառը';
            $password2 = 'Գաղտնաբառը պետք է լինի նվազագույնը 6 նիշ';
            $password3 = 'Գաղտնաբառերը չեն համընկնում';
            $password4 = 'Պարտադիր է լրացնել կրկնել գաղտնաբառը դաշտը';
        } elseif (app()->getLocale() == 'en') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթությունը';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
            $password1 = 'Պարտադիր է լրացնել գաղտնաբառը';
            $password2 = 'Գաղտնաբառը պետք է լինի նվազագույնը 6 նիշ';
            $password3 = 'Գաղտնաբառերը չեն համընկնում';
            $password4 = 'Պարտադիր է լրացնել կրկնել գաղտնաբառը դաշտը';
        } elseif (app()->getLocale() == 'hy') {
            $name = 'Պարտադիր է լրացնել անունը';
            $professor_fathername = 'Պարտադիր է լրացնել հայրանունը';
            $professor_lname = 'Պարտադիր է լրացնել ազգանունը';
            $country = 'Պարտադիր է լրացնել երկիրը';
            $city = 'Պարտադիր է լրացնել քաղաքը/համայնքը';
            $region = 'Պարտադիր է լրացնել մարզը';
            $birth_date = 'Պարտադիր է լրացնել ծննդյան ամսաթիվը';
            $subject = 'Պարտադիր է լրացնել առարկան';
            $education = 'Պարտադիր է լրացնել կրթությունը';
            $professor_experience = 'Պարտադիր է լրացնել աշխատանքային փորձը';
            $professor_about = 'Պարտադիր է լրացնել ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները';
            $professor_phone = 'Պարտադիր է լրացնել հեռախոսահամարը';
            $email1 = 'Պարտադիր է լրացնել էլ. հասցեն';
            $email2 = 'Տվյալն էլ. հասցեով արդեն գրանցվել են';
            $email3 = 'Էլ. հասցեն վավեր չէ';
            $password1 = 'Պարտադիր է լրացնել գաղտնաբառը';
            $password2 = 'Գաղտնաբառը պետք է լինի նվազագույնը 6 նիշ';
            $password3 = 'Գաղտնաբառերը չեն համընկնում';
            $password4 = 'Պարտադիր է լրացնել կրկնել գաղտնաբառը դաշտը';
        }

        return Validator::make($data, [
            'name' => ['required'],
            'professor_fathername' => ['required'],
            'professor_lname' => ['required'],
            'birth_date' => ['required'],
            'subject' => ['required'],
            'education' => ['required'],
            'professor_experience' => ['required'],
            'professor_about' => ['required'],
            'professor_phone' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required','confirmed', 'min:6'],
            'password_confirmation' => ['required', 'min:6'],
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
            'professor_phone.required' => $professor_phone,
            'email.required' => $email1,
            'email.unique' => $email2,
            'email.email' => $email3,
            'password.required' => $password1,
            'password.min' => $password2,
            'password.confirmed' => $password3,
            'password_confirmation.required' => $password4
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

        if (!empty($data['professor_img'])) {
            $image = $data['professor_img'];
            $input['imagename'] = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path() . "/images/user_images/";
            $img = Image::make($image->path());
            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
        } else {
            $input['imagename'] = null;
        }

        $birth = explode(".", $data['birth_date']);
        $birthday = $birth[2] . "/" . $birth[1] . "/" . $birth[0];
        $location = explode(",", $data['location']);
        $result = new User;

        $result::insert([
            'name' => $data['name'],
            'm_name' => $data['professor_fathername'],
            'l_name' => $data['professor_lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'b_day' => $birthday,
            'phone' => $data['professor_phone'],
            'img' => $input['imagename'],
            'country_id' => $data['country'],
            'region_id' => $data['region'],
            'city_id' => $data['city'],
            'address' => $data['professor_address'],
            'gender' => $data['gender'],
            'education' => $data['education'],
            'work_exp' => $data['professor_experience'],
            'description' => $data['professor_about'],
            'user_north' => $location[0],
            'user_east' => $location[1],
        ]);

        $remember = Str::random(60);
        $email = $data['email'];
        User::where('email', $email)->update(['remember_token' => $remember]);
        $token = "<a href='https://dasaxos.am/hy/verify/$remember'>https://dasaxos.am/hy/verify/$remember</a>";

        Mail::send('emails.visitor_email', ['name' => "", 'email' => "", 'title' => "", 'content' => "
<img src='https://dasaxos.am/dasaxos.jpg'><pre>Էլ. փոստի հաստատում
Բարև՛ Ձեզ: Խնդրում ենք հաստատել Ձեր էլ. փոստը՝ անցում կատարելով հետևյալ հղումով՝ $token
Եթե Ձեզ մոտ չստացվեց հաստատել էլ. փոստը, պատճենե՛ք նշված հղումը և տեղադրե՛ք դիտարկիչի (բրաուզերի) հասցեի տողում:

Подтверждение email
Здравствуйте! Пожалуйста, подтвердите ваш email, перейдя по ссылке $token.

Если у вас не получается подтвердить email, скопируйте данную ссылку и вставьте в адресную строку браузера:

Email confirmation
Hello! Please confirm your email by following the link $token. 

If you are unable to verify your email, copy this link and paste it into your browser address bar."], function ($message) use($email) {
            $message->to($email)->subject('Էլ. փոստի հաստատում/ Подтверждение email/ Email confirmation');
        });


        $find = User::where('email', $data['email'])->get()->first();

        foreach ($data['subject'] as $key => $value) {

            if (!isset($data['online_home'][$key])) {
                $data['online_home'][$key] = null;
            }

            if (!isset($data['student_home'][$key])) {
                $data['student_home'][$key] = null;
            }

            if (!isset($data['professor_home'][$key])) {
                $data['professor_home'][$key] = null;
            }

            if (!isset($data['pupil'])) {
                $data['pupil'] = null;
            } else {
                $data['pupil'] = 1;
            }

            if (!isset($data['student'])) {
                $data['student'] = null;
            } else {
                $data['student'] = 1;
            }

            if (!isset($data['adult'])) {
                $data['adult'] = null;
            } else {
                $data['adult'] = 1;
            }

            PriceList::insert([
                'user_id' => $find->id, //Auth::user-> id bayc skzbic insert heto;
                'subject_id' => $value,
                'location_user' => $data['professor_home'][$key],
                'location_student' => $data['student_home'][$key],
                'location_online' => $data['online_home'][$key],
                'price_user' => $data['professor_home_price'][$key],
                'price_student' => $data['student_home_price'][$key],
                'price_online' => $data['online_price'][$key],
                'duration_user' => $data['professor_home_time'][$key],
                'duration_student' => $data['student_home_time'][$key],
                'duration_online' => $data['online_time'][$key],
                'pupil' => $data['pupil'],
                'student' => $data['student'],
                'adult' => $data['adult'],
            ]);
        }

        if (!empty($data['certificates'])) {

            foreach ($data['certificates'] as $key => $value) {
                $image = $value;
                $input['imagename'] = date('YmdHis')."".$key . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() . "/images/user_certificates/";
                $img = Image::make($image->path());
                $img->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);

                Certificate::insert([
                    'user_id' => $find->id, //Auth::user-> id bayc skzbic insert heto;
                    'certificate' => $input['imagename'],
                ]);
            }
        }


        Auth::loginUsingId($find->id, TRUE);
        session()->put("register", "false");
        return $result;
    }

    public function register_page() {
        $countries = Country::all();
        $regions = Region::all();
        $subjects = Subject::all();
        $education = Education::all();

        return view('auth.register', ['countries' => $countries, 'regions' => $regions, 'subjects' => $subjects, 'education' => $education]);
    }

}
