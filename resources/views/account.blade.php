@extends('layout')

@section('content')
<section id="teacher_account">
        
        
        @if(empty($teacher->email_verify_date))
            <div class="alert alert-danger position-absolute danger-email" >
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul>
                    <li>{{__('messege.verify_email')}}, <form action="{{ route('resend',app()->getLocale())}}" method="POST">@csrf<button class="resend_btn" type="submit" action='/{{app()->getLocale()}}/resend'> {{__('messege.resend')}} </button></form></li>
                </ul>
            </div>
        @endif
    <div class="as-mx-width">
        <div class="f_l_name">
            <h1>{{$teacher->name}}  {{$teacher->l_name}}</h1>
        </div>
        <div class="info-grid">
            <div class="teacher-img">
                @if($teacher->img == null && $teacher->gender == 'female')
                <img src="{{asset("/img/avatar_girl.svg")}}" alt="">
                @elseif($teacher->img == null && $teacher->gender == 'male')
                <img src="{{asset("/img/avatar_man.svg")}}" alt="">
                @else
                <img src="{{asset("/images/user_images/".$teacher->img)}}" alt="">
                @endif
                <div class="stars">
                    <span class="Stars" style="--rating: {{(!empty($rate))?$rate:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                    @if(!empty($rate_count))
                    <span><a href="/{{app()->getLocale()}}/{{$teacher->userId}}/comment">({{$rate_count}})</a></span>
                    @else
                    <span> (0)</span>
                    @endif()
                </div>
            </div>
            <div class="teacher-info">
                        <?php 
                            if (app()->getLocale() == 'ru') {
                                $city = $teacher->city_ru;
                                $univers = $teacher->education_ru;
                                
                            } elseif (app()->getLocale() == 'en') {
                                $city = $teacher->city_en;
                                $univers = $teacher->education_en;
                          
                            } elseif (app()->getLocale() == 'hy') {
                                $city = $teacher->city_hy;
                                $univers = $teacher->education_hy;
                      
                            }
                        ?>
                
                <div class="teacher-info-grid">
                    <p class="ligth-text">{{__('messege.city_community')}}</p>

                    <p class="bold-text">{{$city}}</p>
                    <p class="ligth-text">{{__('messege.age')}}</p>
                    <p class="bold-text">{{Carbon\Carbon::parse($teacher->b_day)->age}} {{__('messege.years_old')}}</p>
                    <p class="ligth-text">{{__('messege.work_experience')}}</p>
                    <p class="bold-text">{{round($teacher->work_exp)}} {{__('messege.year')}}</p>
                    <p class="ligth-text">{{__('messege.select_education_title')}}</p>
                    <p class="bold-text">{{$univers}}</p>
                </div>
                <p class="with-people"> <img src="/img/Friend.svg" alt=""> 
                    <?php
                    foreach ($subjects as $key => $sub) {
                        
                        if ($sub['location_user'] != 'on') {
                            $location_user = __('messege.not_work');
                        }

                        if ($sub['location_student'] != 'on') {
                            $location_student = __('messege.not_work');
                        }

                        if ($sub['location_online'] != 'on') {
                            $location_student = __('messege.not_work');
                        }
                        $sphere = [];
                        if ($sub['pupil'] == 1) {
                            $sphere['pupil'] = __('messege.checkbox_pupil');
                        }
                        if ($sub['student'] == 1) {
                            $sphere['student'] = __('messege.checkbox_student');
                        }

                        if ($sub['adult'] == 1) {
                            $sphere['adult'] = __('messege.checkbox_adult');
                        }
                    }

                    echo "<span>" . implode(", ", $sphere) . "</span>";
                    ?>
                </p>
            </div>
        </div>
        <div id="notification">
            <div class="sub-title title-grid">
                <div class="d-flex">
                    <img src="/img/message.svg" alt="" style="cursor:pointer">
                    <span class="count  mr-2 count_not"> ({{count($notifications)}})</span><a href="/{{app()->getLocale()}}/archive">{{__('messege.new_polls')}}</a>
                </div>
            <div class="d-flex">
                <img src="/img/archive.svg" alt="" style="cursor:pointer">
                <a href="/{{app()->getLocale()}}/archive">{{__('messege.archive')}}</a>
            </div>
            </div>
            <div class="message">
          
                @if(count($notifications) > 0)

                @foreach($notifications as $value)
             
                
                <div class="message-back">
                <div class="message-item">
                    <div class="contact">
                        <h5 class="sub-title">{{__('messege.contact_info')}}</h5>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.name')}}   {{__('messege.lastname')}}</label>
                            @if(!empty($value['name']))
                            <p class="bold-text">{{$value['name']}}</p>
                            @else
                            <p class="bold-text">{{$value['name_lname']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.email')}}</label>
                            @if(!empty($value['email']))
                                @if($value['response'] == 3)
                                <p class="bold-text">***********</p>
                                @else
                                <p class="bold-text">{{$value['email']}}</p>
                                @endif
                            @else
                            <p class="bold-text"><img src="/img/minus.svg"></p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.phonenumber')}}</label>
                            @if($value['response'] == 3)
                            <p class="bold-text">*********</p>
                            @else
                                @if(!empty($value['phone']))
                                <p class="bold-text">{{$value['phone']}}</p>
                                @else
                                <p class="bold-text">{{$value['phoneNumb']}}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="description">
                        <div class="sub-title">
                            <h3 >{{__('messege.teacher_description')}}</h3>

                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.subject')}}</label>
                          
                            @if(!empty($value['subject_hy']))
                            <?php 
                                if (app()->getLocale() == 'ru') {
                                    $subject = $value['subject_ru'];
                                    $univers = $teacher->univers_ru;
                                } elseif (app()->getLocale() == 'en') {
                                    $subject = $value['subject_en'];
                                    $univers = $teacher->univers_en;
 
                                } elseif (app()->getLocale() == 'hy') {
                                    $subject = $value['subject_hy'];
                                    $univers = $teacher->univers_hy;
                                }
                              
                            ?>
                            <p class="bold-text">{{$subject}}</p>
                            @else
                            <?php 
                           
                                if (app()->getLocale() == 'ru') {
                                    $sub = 'subject_ru';
                                } elseif (app()->getLocale() == 'en') {
                                    $sub = 'subject_en';
                                } elseif (app()->getLocale() == 'hy') {
                                    $sub = 'subject_hy';
                                }
                                
                                
                            ?>
                            <p class="bold-text">{{$subjects[$value['subjectId']][$sub]}}</p>
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.gender')}}</label>
                            @if($value['gender_female'] == "on" && $value['gender_male'] == null)
                            <p class="bold-text">{{__('messege.checkbox_female')}}</p>
                            @elseif($value['gender_male'] == "on" && $value['gender_female'] == null)
                            <p class="bold-text">{{__('messege.checkbox_male')}}</p>
                            @elseif(!empty($value['gender_male']) && !empty($value['gender_female'])) 
                            <p class="bold-text">{{__('messege.checkbox_female')}}, {{__('messege.checkbox_male')}}</p>
                            @else
                            <p class="bold-text"><img src="/img/minus.svg"></p>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.work_experience')}}</label>
                            @if(!empty($value['exp_min'])  && empty($value['exp_med']) && empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.checkbox_up_to_5')}}</p>
                            @elseif(empty($value['exp_min'])  && !empty($value['exp_med']) && empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.checkbox_5_to_10')}}</p>
                            @elseif(empty($value['exp_min'])  && empty($value['exp_med']) && !empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.checkbox_more_than_10')}}</p>
                            @elseif(!empty($value['exp_min'])  && !empty($value['exp_med']) && empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.1_to_10')}}</p>
                            @elseif(!empty($value['exp_min'])  && empty($value['exp_med']) && !empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.1_to5_and_more_10')}}</p>
                            @elseif(empty($value['exp_min'])  && !empty($value['exp_med']) && !empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.more_5')}}</p>
                            @elseif(empty($value['exp_min'])  && empty($value['exp_med']) && empty($value['exp_max']))
                            <p class="bold-text"><img src="/img/minus.svg"></p>
                            @elseif(!empty($value['exp_min'])  && !empty($value['exp_med']) && !empty($value['exp_max']))
                            <p class="bold-text">{{__('messege.more_1')}}</p>
                            @endif
                        </div>



                    </div>
                    <div class="price">
                        <h5 class="sub-title">{{__('messege.other_info')}}</h5>
                        <fieldset class="filter-price">
                            <div class="form-group">

                                <label for="" class="ligth-text">{{__('messege.format')}}</label>
                                @if(!empty($value['loc_proffes'])  && empty($value['loc_student']) && empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}</p>
                                @elseif(empty($value['loc_proffes'])  && !empty($value['loc_student']) && empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_student')}}</p>
                                @elseif(empty($value['loc_proffes'])  && empty($value['loc_student']) && !empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_remotely')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && !empty($value['loc_student']) && empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_at_the_student')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && empty($value['loc_student']) && !empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(empty($value['loc_proffes'])  && !empty($value['loc_student']) && !empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_student')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && !empty($value['loc_student']) && !empty($value['loc_online']))
                                <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_at_the_student')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(empty($value['loc_proffes'])  && empty($value['loc_student']) && empty($value['loc_online']))
                                <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif
                            </div>


                            <div class="form-group">
                                <p class="ligth-text">   {{__('messege.applicant')}}  </p>
                                    @if(!empty($value['pupil'])  && empty($value['student']) && empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_pupil')}}</p>
                                @elseif(empty($value['pupil'])  && !empty($value['student']) && empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_student')}}</p>
                                @elseif(empty($value['pupil'])  && empty($value['student']) && !empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_adult')}}</p>
                                @elseif(!empty($value['pupil'])  && !empty($value['student']) && empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_pupil')}},  {{__('messege.checkbox_student')}}</p>
                                @elseif(!empty($value['pupil'])  && empty($value['student']) && !empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_pupil')}} ,  {{__('messege.checkbox_adult')}}</p>
                                @elseif(empty($value['pupil'])  && !empty($value['student']) && !empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_student')}},  {{__('messege.checkbox_adult')}}</p>
                                @elseif(!empty($value['pupil'])  && !empty($value['student']) && !empty($value['adult']))
                                <p class="bold-text"> {{__('messege.checkbox_pupil')}}, {{__('messege.checkbox_student')}} , {{__('messege.checkbox_adult')}} </p>
                                @elseif(empty($value['pupil'])  && empty($value['student']) && empty($value['adult']))
                                <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif                    

                            </div>
                            <div class="form-group">
                                <label for="" class="ligth-text">{{__('messege.price_range')}}</label>
                                @if(!empty($value['price_min']))
                                <p class="bold-text"> {{number_format($value['price_min'],0)}} - {{number_format($value['price_max'],0)}}</p>
                                @else
                                <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="notification_mess">
                            @if($value['response'] == 3)
                            <span class="late_not">{{__('messege.request_other')}}</span>
                             <button class="archive" data-number="{{$value['notId']}}">{{__('messege.archive_button')}}</button>
                            @else
                            <div>
                                <button class="as-btn-y mt-4 accept_decline accept_not" data-number="{{$value['notId']}}" data-suggest="{{$value['suggest_id']}}"  data-contact="{{$value['contact_id']}}">{{__('messege.accept_button')}}</button>
                                <p class="ligth-text">{{__('messege.accept_button_text')}}</p>
                            </div>
                                <button class="as-btn-r mt-4 accept_decline decline_not" data-number="{{$value['notId']}}"  data-suggest="{{$value['suggest_id']}}" data-contact="{{$value['contact_id']}}">{{__('messege.ignor_button')}}</button>


                            @endif
                    </div>
                </div>
                @endforeach
                @else
                <h5 class="pb-5">{{__('messege.not_request')}}</h5>
                @endif
            </div>

        </div>
        <div id="ararkaner">
            <div class="sub-title table-for-desktop">
                <h3 >{{__('messege.menu_matter')}}  </h3>

            </div>
            <table class="lesson-table table-for-desktop">
                <thead>
                <th>{{__('messege.menu_matter')}}</th>
                <th>{{__('messege.checkbox_at_the_teacher')}}</th>
                <th>{{__('messege.checkbox_at_the_student')}} </th>
                <th>{{__('messege.checkbox_remotely')}} </th>
                </thead>
                <tbody>
                    @foreach($subjects as $key => $sub)
                    <?php
                    if (app()->getLocale() == 'ru') {
                        $subject = $sub['subject_ru'];
                    } elseif (app()->getLocale() == 'en') {
                        $subject = $sub['subject_en'];
                    } elseif (app()->getLocale() == 'hy') {
                        $subject = $sub['subject_hy'];
                    }
                    ?> 
                    <tr>
                        <td>{{$subject}}</td>
                        @if($sub['price_user'] != null)
                        <td> {{__('messege.starting')}}{{number_format($sub['price_user'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_user']}} {{__('messege.minute')}} </td>
                        @else
                        <td><hr class="line-minus"></td>
                        @endif

                        @if($sub['price_student'] != null)
                        <td>{{__('messege.starting')}} {{number_format($sub['price_student'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_student']}} {{__('messege.minute')}}</td>
                        @else
                        <td><hr class="line-minus"></td>
                        @endif

                        @if($sub['price_online'] != null)
                        <td>{{__('messege.starting')}} {{number_format($sub['price_online'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_online']}} {{__('messege.minute')}} </td>
                        @else
                        <td><hr class="line-minus"></td>
                        @endif


                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="table-for-mobile">
                <div class="title mt-5 mb-3">
                    <h3 >{{__('messege.menu_matter')}} </h3>

                </div>
                @foreach($subjects as $key => $sub)
                    <?php
                    if (app()->getLocale() == 'ru') {
                        $subject = $sub['subject_ru'];
                    } elseif (app()->getLocale() == 'en') {
                        $subject = $sub['subject_en'];
                    } elseif (app()->getLocale() == 'hy') {
                        $subject = $sub['subject_hy'];
                    }
                    ?>
                    <div class="sub-div">
                        <p class="title-sub">{{$subject}}</p>
                        <div class="sub-grid">
                            <div class="sub">
                                <p> {{__('messege.checkbox_at_the_teacher')}}</p>
                                <p>{{__('messege.checkbox_at_the_student')}} </p>
                                <p>{{__('messege.checkbox_remotely')}} </p>

                            </div>
                            <div class="price">
                                @if($sub['price_user'] != null)
                                    <p>{{__('messege.starting')}} {{number_format($sub['price_user'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_user']}}{{__('messege.minute')}} </p>
                                @else
                                    <td><hr class="line-minus"></td>
                                @endif

                                @if($sub['price_student'] != null)
                                    <p>{{__('messege.starting')}} {{number_format($sub['price_student'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_student']}} {{__('messege.minute')}}</p>
                                @else
                                    <td><hr class="line-minus"></td>
                                @endif

                                @if($sub['price_online'] != null)
                                    <p>{{__('messege.starting')}} {{number_format($sub['price_online'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_online']}}{{__('messege.minute')}} </p>
                                @else
                                    <hr class="line-minus">
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        @if(!empty($certificate))
            <h5 class="more-info-title sub-title">{{__('messege.more_information')}}</h5>
            <div class="more-info">

                <p  class="text more-info-text show-more-height ">
                    {{$teacher->description}}
                </p>
                <p class="show-more"> {{__('messege.see_more_button')}}<img src="/img/Down.svg" alt=""></p>
            </div>
        @endif
        <div id="hascener">
            <div class="sub-title">
                <h3 >{{__('messege.address')}}</h3>

            </div>
            <div class="map">
                <div class="teacher-map">
                    <div id="map" style="width:100%; height:236px;border-radius:30px;"></div>
                    <input type="hidden" id="location" name="location" value="{{$teacher->user_north}},{{$teacher->user_east}}" />
                </div>
            </div>

        </div>
        @if(count($certificate)>0)
        <div id="diplomner">
            <div class="sub-title">
                <h3 >{{__('messege.sidebar_menu_diplom')}}</h3>

            </div>
            <div class="diplom position-relative ">
                <div id="certificatCarousel" class="swiper-container " data-ride="carousel">
                    <div class="swiper-wrapper" role="listbox">
                        <?php
                        $count = 1;
                        $j = 1;
                        ?>

                        @foreach($certificate as $key => $cert)

                        <div class="swiper-slide">

                            <div class="carousel-item-diplom">
                                <a href="/images/user_certificates/{{$cert->certificate}}" class="image-link with-caption">
                                    <img src="/images/user_certificates/{{$cert->certificate}}" alt="" class="dip-img">
                                </a>

                            </div>

                        </div>                        
                        <?php
                        $count++;
                        $j++;
                        ?>

                        @endforeach
                    </div>
                </div>
                <div class="swiper-pag" style="top:-50px">
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <!-- </div> -->
            </div>


        </div>
        @endif
        <div id="varkanish">
            <div class="sub-title">
                <h3 >{{__('messege.sidebar_menu_rating')}}</h3>

            </div>
            <div class="rating">
                <div class="graphic">
                    <img src="/img/bar-chart (1).svg" alt="">
                    @if(!empty($row))
                    <p class="bold-text">{{$row}}  {{__('messege.in_place')}}{{$teacher_count}}{{__('messege.in')}}</p>
                    <h5 class="ligth-text">{{__('messege.all_rating')}}</h5>
                    @else
                    <p class="bold-text">{{__('messege.not_rating')}}</p>
                    <h5 class="ligth-text">{{__('messege.all_rating')}}</h5>
                    @endif
                </div>
                <div class="view">
                    <img src="/img/view.svg" alt="">
                    <p class="bold-text">{{number_format($pages_views)}} {{__('messege.view')}}</p>
                    <h5 class="ligth-text">{{__('messege.monthly_views')}}</h5>
                </div>
                <div class="calendar">

                    <img src="/img/calendar.svg" alt="">
                    <?php
                    ;
                    $date = explode(" ", $teacher->registerDate);

                    $date_final = explode("-", $date[0]);
                    if (app()->getLocale() == 'ru') {
                        $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
                    } elseif (app()->getLocale() == 'en') {
                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    } elseif (app()->getLocale() == 'hy') {
                        $months = ['Հունվար', 'Փետրվար', 'Մարտ', 'Ապրիլ', 'Մայիս', 'Հունիս', 'Հուլիս', 'Օգոստոս', 'Սեպտեմբեր', 'Հոկտեմբեր', 'Նոյեմբեր', 'Դեկտեմբեր'];
                    }
                    ?>
                    <p class="bold-text">

                        {{$date_final[2]}} {{$months[$date_final[1]-1]}} {{$date_final[0]}}
                    </p>
                    <h5 class="ligth-text">{{__('messege.create_date')}}</h5>
                </div>
                <div class="students">
                    <img src="/img/Group 1925.svg" alt="">
                    <p class="bold-text">{{$count_notific}} {{__('messege.learning')}}</p>
                    <h5 class="ligth-text">{{__('messege.create_date2')}}</h5>
                </div>

            </div>
        </div>
    </div>

</section>

<script>
    var mySwiper = new Swiper('#certificatCarousel', {

        loopedSlides: 500,
        breakpoints: {
            '300': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '580': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '650': {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            '990': {
                slidesPerView: 4,
                spaceBetween: 10,
            }
        },

        // Optional parameters
        pagination: {
            el: '#certificatCarousel .swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
        // Navigation arrows

        cubeEffect: {
            slideShadows: false,
            shadow: false,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    //information sitebar menu_active
    $('#information .info-grid .sitebar-menu ul li').click(function () {
        $('#information .info-grid .info-sitebar .sitebar-menu ul li').removeClass('active_sitebar');
        $(this).addClass('active_sitebar');
    })



    $('.carousel-item-diplom a').magnificPopup({
        type: 'image',
        closeBtnInside: false,
        closeOnContentClick: true,
        tLoading: '', // remove text from preloader

        /* don't add this part, it's just to disable cache on image and test loading indicator */
        callbacks: {
            beforeChange: function () {
                this.items[0].src = this.items[0].src + '?=' + Math.random();
            }
        }


    });


    let teacher_location = $('.teacher-map').find('#location').val().split(',');

    let north = teacher_location[0];
    let east = teacher_location[1];
    var mapOptions = {
        zoom: 15,
        center: new google.maps.LatLng(north, east),
        scaleControl: true,
        streetViewControl: true,
        panControl: true,
        mapTypeControl: true,
        overviewMapControlOptions: {opened: true},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var marker_settings = {
        position: new google.maps.LatLng(north, east),
        map: map,
    };

    var marker = new google.maps.Marker(marker_settings);
    var markers = [];

    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
    google.maps.event.addListener(searchBox, 'places_changed', function () {
        searchBox.set('map', null);
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function (place) {
                var marker = new google.maps.Marker({
                    position: place.geometry.location
                });
                marker.bindTo('map', searchBox, 'map');
                google.maps.event.addListener(marker, 'map_changed', function () {
                    if (!this.getMap()) {
                        this.unbindAll();
                    }
                });
                bounds.extend(place.geometry.location);
            }(place));

        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(), 12));

    });

    function clearOverlays() {
        while (markers.length) {
            markers.pop().setMap(null);
        }
        markers.length = 0;
    }

    markers.push(marker);
    google.maps.event.addListener(map, "click", function (event) {
        if (event.latLng) {
            clearOverlays();
            var markerD2_settings = {
                position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                map: map,
                draggable: true
            };
            var markerD2 = new google.maps.Marker(markerD2_settings);
            markers.push(markerD2);
            google.maps.event.addListener(markerD2, "drag", function () {
                document.getElementById("location").value = event.latLng.lat() + ',' + event.latLng.lng();
            });
            document.getElementById("location").value = event.latLng.lat() + ',' + event.latLng.lng();
        }
    });



    

</script>

@endsection