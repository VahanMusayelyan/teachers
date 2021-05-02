@extends('layout')

@section('content')

<section id="information">
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
    <div class="as-mx-width">
        <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-md-8 mt-3 text-left"><h1 >{{$teacher->name}} {{$teacher->l_name}} {{__('messege.count_teach_title3')}} </h1></div>
        </div>
        <div class="info-grid">
            <div class="info-sitebar">
                <div class="sitebar-card">
                    <?php
                    foreach ($subjects as $key => $sub) {
                         if (app()->getLocale() == 'ru') {
                                    $subject = $sub['subject_ru'];
                                } elseif (app()->getLocale() == 'en') {
                                    $subject = $sub['subject_en'];
                                } elseif (app()->getLocale() == 'hy') {
                                    $subject = $sub['subject_hy'];
                                }
                        $min = 0;
                        $time = 0;
                        if ($sub['price_user'] != null && $sub['price_student'] != null && $sub['price_online'] != null) {

                           
                            
                            if ($sub['price_user'] >= $sub['price_student']) {
                                $min = $sub['price_student'];
                                $time = $sub['duration_student'];
                            } else {
                                $min = $sub['price_user'];
                                $time = $sub['duration_user'];
                            }


                            if ($min > $sub['price_online']) {
                                $min = $sub['price_online'];
                                $time = $sub['duration_online'];
                            }
                        } else {
                            if ($sub['price_user'] == null) {
                                if ($sub['price_student'] == null) {
                                    $min = $sub['price_online'];
                                    $time = $sub['duration_online'];
                                } elseif ($sub['price_online'] == null) {
                                    $min = $sub['price_student'];
                                    $time = $sub['duration_student'];
                                } else {
                                    if ($sub['price_online'] >= $sub['price_student']) {
                                        $min = $sub['price_student'];
                                        $time = $sub['duration_student'];
                                    } else {
                                        $min = $sub['price_online'];
                                        $time = $sub['duration_online'];
                                    }
                                }
                            } elseif ($sub['price_student'] == null) {
                                if ($sub['price_user'] == null) {
                                    $min = $sub['price_online'];
                                    $time = $sub['duration_online'];
                                } elseif ($sub['price_online'] == null) {
                                    $min = $sub['price_user'];
                                    $time = $sub['duration_user'];
                                } else {
                                    if ($sub['price_online'] >= $sub['price_user']) {
                                        $min = $sub['price_user'];
                                        $time = $sub['duration_user'];
                                    } else {
                                        $min = $sub['price_online'];
                                        $time = $sub['duration_online'];
                                    }
                                }
                            } else {
                                if ($sub['price_online'] == null) {
                                    $min = $sub['price_student'];
                                    $time = $sub['duration_student'];
                                } elseif ($sub['price_student'] == null) {
                                    $min = $sub['price_user'];
                                    $time = $sub['duration_user'];
                                } else {
                                    if ($sub['price_student'] >= $sub['price_user']) {
                                        $min = $sub['price_user'];
                                        $time = $sub['duration_user'];
                                    } else {
                                        $min = $sub['price_student'];
                                        $time = $sub['duration_student'];
                                    }
                                }
                            }
                        }

                        echo '<p class="min-price">' .$subject.'</p>';
                        echo '<p class="price">'.__('messege.starting').' ' . $min . ' <img src="/img/dram.svg" alt=""> /' . $time .''.__("messege.minute").'</p>';
                    }
                    ?>

                    <button type="button" data-number="{{$teacher->userId}}" data-toggle="modal" data-target=".bs-example-modal-new" class="kap-hastatel">{{__('messege.contact_teacher_button')}}</button>
                </div>
                <div class="sitebar-menu">
                    <ul>
                        <li class="active_sitebar"><a href="#texekatvutyun" class="texekatvutyunNavItem navItem">{{__('messege.sidebar_menu_information')}} </a></li>
                        <li><a href="#ararkaner" class="ararkanerNavItem navItem">{{__('messege.sidebar_menu_subject')}} </a></li>
                        <li><a href="#hascener" class="hascenerNavItem navItem">{{__('messege.sidebar_menu_address')}} </a></li>
                        <li><a href="#meknabanutyun" class="meknabanutyunNavItem navItem">{{__('messege.sidebar_menu_comment')}} </a></li>
                        <li><a href="#diplomner" class="diplomnerNavItem navItem">{{__('messege.sidebar_menu_diplom')}} </a></li>
                        <li><a href="#varkanish" class="varkanishNavItem navItem">{{__('messege.sidebar_menu_rating')}} </a></li>
                        <li><a href="#dasaxosner" class="dasaxosnerNavItem navItem">{{__('messege.sidebar_menu_liketeacher')}} </a></li>
                    </ul>
                </div>
            </div>

            <div  class="info-block">
                <section id="texekatvutyun" class="prof-card texekatvutyun">
                    <div class="card-img">
                                @if($teacher->img == null && $teacher->gender == 'female')
                                <img src="{{asset("/img/avatar_girl.svg")}}" alt="">
                                @elseif($teacher->img == null && $teacher->gender == 'male')
                                <img src="{{asset("/img/avatar_man.svg")}}" alt="">
                                @else
                                <img src="{{asset("/images/user_images/".$teacher->img)}}" alt="">
                                @endif
                            <div class="stars">
                                <span class="star_ratem">
                                    <span class="Stars" style="--rating: {{(!empty($rate))?$rate:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                    @if(!empty($rate_count))
                                <span>({{$rate_count}})</span>
                                @else
                                <span> (0)</span>
                                @endif()
                                </span>
                                <button type="button" data-number="{{$teacher->userId}}" data-toggle="modal" data-target=".bs-example-modal-new" class="kap-hastatel for-mobile as-btn">{{__('messege.contact_teacher_button')}}</button>
                                <button type="button"  data-toggle="modal" data-target="#exampleModal" class="review_btn">{{__('messege.write_comment_button')}}</button>

                            </div>
                    </div>
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

                    <div class="card-info">
                    {{--<h3 class="f_l_name">{{$teacher->name}} {{$teacher->l_name}}</h3>--}}
                    <p class="bold-text"></p>
                        <div class="grid-info">
                            <p class="ligth-text">{{__('messege.city')}}</p>
                            <p class="bold-text">{{$city}}</p>
                            <p class="ligth-text">{{__('messege.age')}}</p>
                            <p class="bold-text">{{Carbon\Carbon::parse($teacher->b_day)->age}} {{__('messege.years_old')}}</p>
                            <p class="ligth-text">{{__('messege.input_work_exp_placeholder')}}</p>
                            <p class="bold-text">{{round($teacher->work_exp)}} {{__('messege.year')}}</p>
                            <p class="ligth-text">{{__('messege.select_education_title')}}</p>
                            <div class="boldtext">
                                <p class="more-info-text show-more-height ">{{$univers}}</p>
                            </div>
                        </div>
                            <p class="with-people"> <img src="/img/Friend.svg" alt="">
                                <?php
                                $sphere = [];
                                foreach ($subjects as $key => $sub) {
                                    if ($sub['location_user'] != 'on') {
                                        $location_user = 'Չի գործում';
                                    }

                                    if ($sub['location_student'] != 'on') {
                                        $location_student = 'Չի գործում';
                                    }

                                    if ($sub['location_online'] != 'on') {
                                        $location_student = 'Չի գործում';
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

                </section>
                <section id="ararkaner" class="ararkaner">
                    <div class="title table-for-desktop">
                        <h3 >{{__('messege.subjects')}}</h3>

                    </div>
                    <table class="lesson-table table-for-desktop">
                        <thead>
                        <th>{{__('messege.subjects')}}</th>
                        <th>{{__('messege.checkbox_at_the_teacher')}}</th>
                        <th> {{__('messege.checkbox_at_the_student')}}</th>
                        <th> {{__('messege.checkbox_remotely')}}</th>
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
                                <td>{{__('messege.starting')}} {{number_format($sub['price_user'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_user']}} {{__('messege.minute')}}</td>
                                @else
                                <td><hr class="line-minus"></td>
                                @endif

                                @if($sub['price_student'] != null)
                                <td>{{__('messege.starting')}} {{number_format($sub['price_student'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_student']}} {{__('messege.minute')}}</td>
                                @else
                                <td><hr class="line-minus"></td>
                                @endif

                                @if($sub['price_online'] != null)
                                <td>{{__('messege.starting')}} {{number_format($sub['price_online'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_online']}} {{__('messege.minute')}}</td>
                                @else
                                <td><hr class="line-minus"></td>
                                @endif


                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="table-for-mobile">
                        <div class="title">
                            <h3 >{{__('messege.subjects')}}</h3>

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
                                    <p>{{__('messege.checkbox_at_the_teacher')}} </p>
                                    <p>{{__('messege.checkbox_at_the_student')}} </p>
                                    <p>{{__('messege.checkbox_remotely')}} </p>
                                </div>
                                <div class="price">
                                    @if($sub['price_user'] != null)
                                        <p>{{__('messege.starting')}} {{number_format($sub['price_user'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_user']}} </p>
                                    @else
                                        <td><hr class="line-minus"></td>
                                    @endif

                                    @if($sub['price_student'] != null)
                                        <p>{{__('messege.starting')}}  {{number_format($sub['price_student'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_student']}} </p>
                                    @else
                                        <td><hr class="line-minus"></td>
                                    @endif

                                    @if($sub['price_online'] != null)
                                        <p>{{__('messege.starting')}}  {{number_format($sub['price_online'])}}<img src="/img/dram.svg" alt=""> /{{$sub['duration_online']}} </p>
                                    @else
                                       <hr class="line-minus">
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </section>
                <section id="hascener" class="hascener">
                    <div class="title">
                        <h3 >{{__('messege.address')}} </h3>

                    </div>
                    <div class="map">
                        <div class="teacher-map">
                            <div id="map" style="width:100%; height:236px;border-radius:30px;"></div>
                            <input type="hidden" id="location" name="location" value="{{$teacher->user_north}},{{$teacher->user_east}}" />
                        </div>
                    </div>

                </section>
               
                <div class="more-info">
                    <h5 class="more-info-title">{{__('messege.more_information')}}</h5>
                    <p  class="text more-info-text show-more-height ">
                        {{$teacher->description}}
                    </p>
                    <p class="show-more">{{__('messege.see_more_button')}}<img src="/img/Down.svg" alt=""></p>
                </div>
                
                <section id="meknabanutyun" class="meknabanutyun">
                        <div class="title">
                            <h3 >{{__('messege.sidebar_menu_comment')}} </h3>

                        </div>

                    <div class="comments">
                        @if(count($comments)>0)
                            @foreach($comments as $key => $comment)
                            <div class="comment-card">
                               <div class="inner-card">
                                   <img src="/img/comment_avatar.svg" alt="">
                                   <div class="comment">
                                       <div class="comment-flex">
                                           <div class="user-name">
                                               <h3 >{{$comment->name}} {{$comment->l_name}}</h3>

                                           </div>
                                           <div class="star"><span class="Stars" style="--rating: {{(!empty($comment->avg_value))?$comment->avg_value:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span></div>
                                       </div>
                                       <p class="text">{{$comment->comment}}</p>
                                       <p class="show-more">{{__('messege.see_more_button')}}<img src="/img/Down.svg" alt=""></p>

                                   </div>
                               </div>
                            </div>
                            @endforeach
                


                                <button type="submit" class="show-more-btn" style="margin: 0 auto"><a href="/{{app()->getLocale()}}/{{$teacher->userId}}/comment">{{__('messege.see_more_button')}}</a></button>
                             

                    </div>
                    @else
                        <p class="ligth-text" style="font-size:18px;text-align: center">{{__('messege.no_comment')}}</p>
                   </div>


                    @endif
                </section>
                <section id="diplomner" class="diplomner">
                    <div class="title">
                        <h3 >{{__('messege.sidebar_menu_diplom')}}</h3>

                    </div>
                    <div class="diplom position-relative">
                @if(count($certificate)>0)

                        <div id="diplomCarousel" class="swiper-container "  data-ride="carousel">
                            <div class="swiper-wrapper" role="listbox">
                                <?php $count = 1;
                                $j = 1; ?>
                                @foreach($certificate as $key => $cert)
                                 <div class="swiper-slide">
                                    <div class="carousel-item-diplom">
                                        <a href="/images/user_certificates/{{$cert->certificate}}" class="image-link with-caption">
                                            <img src="/images/user_certificates/{{$cert->certificate}}" alt="" class="dip-img">
                                        </a>
                                    </div>
                                    
                                </div>                        
                                <?php $count++;
                                $j++; ?>
                                @endforeach


                            </div>
                        </div>
                        <div class="swiper-pag" style="top:-35px">
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                        

                    @else
                            <p class="ligth-text" style="font-size:18px;text-align: center">{{__('messege.no_diplom')}}</p>
                    @endif
                    </div>
                </section>
                <div id="varkanish" class="varkanish">
                    <div class="title">
                        <h3 > {{__('messege.sidebar_menu_rating')}}</h3>

                    </div>
                    <div class="rating">
                        <div class="graphic">
                            <img src="/img/bar-chart (1).svg" alt="">
                            @if(!empty($row))
                            <p class="bold-text">{{$row}} {{__('messege.in_place')}} {{$teacher_count}}{{__('messege.in')}}</p>
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
               
                <div id="dasaxosner" class="dasaxosner">
                    <div class="p-0 m-auto">
                        <div class="text-center m-0 p-0">
                            <div id="otherteachersCarousel" class="swiper-container m-0 " >
                                <div class="title text-left">
                                    <h3 >{{__('messege.sidebar_menu_liketeacher')}}  </h3>

                                </div>

                                <div class="swiper-wrapper pt-5 pb-5">
                                   
                                    @foreach($other_teacher as $values)
                                    @foreach($values as $key => $value)
                                    <?php
                                    if (app()->getLocale() == 'ru') {
                                        $subject = $value['subject_ru'];
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value['subject_en'];
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value['subject_hy'];
                                    }
                                    ?>
                                    <div class="swiper-slide">
                                        <a href="/{{app()->getLocale()}}/teacher/{{$value['user_id']}}">
                                            <div class="carousel-item-lecturer">
                                                @if($value['img'] == null && $value['gender'] == 'female')
                                                <img src="{{asset("/img/avatar_girl.svg")}}" alt="" class="lecturer-card-img">
                                                @elseif($value['img'] == null && $value['gender'] == 'male')
                                                <img src="{{asset("/img/avatar_man.svg")}}" alt="" class="lecturer-card-img">
                                                @else
                                                <img src="{{asset("/images/user_images/".$value['img'])}}" alt="" class="lecturer-card-img">
                                                @endif
                                                <div class="lecturer-card-star mt-4">
                                                    <span class="Stars" style="--rating: {{(!empty($rates[$value['user_id']]))?$rates[$value['user_id']]:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                                </div>
                                                <h5 class="my-3">{{$value['name']}} {{$value['l_name']}}</h5>
                                                <h6 class="mb-0">{{__('messege.subject')}} </h6>
                                                <span class="subject_of_study">{{$subject}}</span>
                                            </div>
                                        </a>
                                    </div>
                                        @endforeach
                                    @endforeach
                            </div>
                                <div class="swiper-pag">
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section id="comment-review">
    <div class="as-mx-width">
        <div class="modal fade video-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-video" role="document">
                <div class="modal-content modal-body-video">
                    <div class="modal-body ">
                        <div class="container">
                            
                            <div class="review_modal">
                                <img src="/img/x.svg" alt="" class="close-btn" data-toggle="modal" data-target="#exampleModal">
                                <div class="big_stars"><h3 class="star_rating_average">{{__('messege.average_rating')}} </h3>
                                    <img class="big_star" src="/img/big-star.svg">
                                    <h3 class="star_rating_review">0.0</h3>
                                </div>

                                <div class="row rate_stars_text">
                                    <div class="col-md-7"><span class="rate_text">{{__('messege.prof_quali')}}</span></div>
                                    <div class="col-md-5">
                                        <div class="rate_little_stars">
                                            <form class="rating" id="product0" method="POST">
                                                
                                                <button type="submit" class="star" data-star="1">
                                                    &#x2605;
                                                    <span class="screen-reader">1 Star</span>
                                                </button>
                                                <button type="submit" class="star" data-star="2">
                                                    &#x2605;
                                                    <span class="screen-reader">2 Stars</span>
                                                </button>
                                                <button type="submit" class="star" data-star="3">
                                                    &#x2605;
                                                    <span class="screen-reader">3 Stars</span>
                                                </button>
                                                <button type="submit" class="star" data-star="4">
                                                    &#x2605;
                                                    <span class="screen-reader">4 Stars</span>
                                                </button>
                                                <button type="submit" class="star" data-star="5">
                                                    &#x2605;
                                                    <span class="screen-reader">5 Stars</span>
                                                </button>
                                                <p id="rate-value0"></p>
                                                <input hidden name="teacher_number" value="{{$teacher->userId}}">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><span class="rate_text">{{__('messege.consci')}}</span></div>
                                    <div class="col-md-6">
                                        <div class="rate_little_stars">
                                            <form class="rating" id="product1" >
                                                <button type="submit" class="star" data-star="1">
                                                    &#x2605;
                                                    <span class="screen-reader">1 Star</span>
                                                </button>

                                                <button type="submit" class="star" data-star="2">
                                                    &#x2605;
                                                    <span class="screen-reader">2 Stars</span>
                                                </button>

                                                <button type="submit" class="star" data-star="3">
                                                    &#x2605;
                                                    <span class="screen-reader">3 Stars</span>
                                                </button>

                                                <button type="submit" class="star" data-star="4">
                                                    &#x2605;
                                                    <span class="screen-reader">4 Stars</span>
                                                </button>
                                                <button type="submit" class="star" data-star="5">
                                                    &#x2605;
                                                    <span class="screen-reader">5 Stars</span>
                                                </button>
                                                <p id="rate-value1"></p>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="rate_text">{{__('messege.final_result')}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="rate_little_stars">
                                            <form class="rating" id="product2" >
                                                <button type="submit" class="star" data-star="1">
                                                    &#x2605;
                                                    <span class="screen-reader">1 Star</span>
                                                </button>

                                                <button type="submit" class="star" data-star="2">
                                                    &#x2605;
                                                    <span class="screen-reader">2 Stars</span>
                                                </button>

                                                <button type="submit" class="star" data-star="3">
                                                    &#x2605;
                                                    <span class="screen-reader">3 Stars</span>
                                                </button>

                                                <button type="submit" class="star" data-star="4">
                                                    &#x2605;
                                                    <span class="screen-reader">4 Stars</span>
                                                </button>
                                                <button type="submit" class="star" data-star="5">
                                                    &#x2605;
                                                    <span class="screen-reader">5 Stars</span>
                                                </button>
                                                <p id="rate-value2"></p>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <form class="rating_form" action="{{route('add_teacher_comment',app()->getLocale(),$teacher->userId)}}" method="POST">
                                @csrf
                                    <div class="user-name-grid">
                                        <div class="form-group">
                                            <label for="name">{{__('messege.teach_name')}}</label>
                                            <input type="text" name="name" id="name" class="styled-inputtext">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">{{__('messege.teach_lastname')}}</label>
                                            <input type="text" name="lastname" id="lastname" class="styled-inputtext">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">{{__('messege.write_comment')}}</label>
                                        <textarea type="text" name="comment" id="comment" class="styled-inputtext"></textarea>
                                    </div>
                                    <div class="leave_review">
                                        <button class="leave_review_btn" type="submit">{{__('messege.send_button')}}</button>
                                    </div>
                                    <input hidden name="teacher_number" value="{{$teacher->userId}}">
                                    <input hidden class="star_average_value" name="rate" value="">
                                </form>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>




<script>
    if($('#information .info-grid .comments .comment-card').length <= 2){
        $('.show-more-btn').css('display','none');
    }else{
        $('.show-more-btn').css('display','block');
    }
    $(document).ready(function(){
        $("#information .info-grid .comments .comment-card").slice(0,2).show();

    })

var mySwiper =new Swiper ('#otherteachersCarousel', {

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
                            slidesPerView: 1,
                            spaceBetween: 0,
                        },
                        '768': {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                    
                        '1200': {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        }
                    },
                   
                    // Optional parameters
                    pagination: {
                        el: '#otherteachersCarousel .swiper-pagination',
                        type:'bullets',
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
                new Swiper ('#diplomCarousel', {

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
                            slidesPerView: 1,
                            spaceBetween: 0,
                        },
                        '768': {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                    
                        '1200': {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        }
                    },
                   
                    // Optional parameters
                    pagination: {
                        el: '#diplomCarousel .swiper-pagination',
                        type:'bullets',
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
  






function selectElementByClass(className) {
  return document.querySelector(`.${className}`);
} 

const sections = [
    selectElementByClass('texekatvutyun'),
  selectElementByClass('ararkaner'),
  selectElementByClass('hascener'),
  selectElementByClass('meknabanutyun'),
  selectElementByClass('diplomner'),
  selectElementByClass('varkanish'),
  selectElementByClass('dasaxosner'),

];
const navItems = {
    texekatvutyun: selectElementByClass('texekatvutyunNavItem'),
    ararkaner: selectElementByClass('ararkanerNavItem'),
    hascener: selectElementByClass('hascenerNavItem'),
    meknabanutyun: selectElementByClass('meknabanutyunNavItem'),
    diplomner: selectElementByClass('diplomnerNavItem'),
    varkanish: selectElementByClass('varkanishNavItem'),
    dasaxosner: selectElementByClass('dasaxosnerNavItem'),

};

// intersection observer setup
const observerOptions = {
  root: null,
  rootMargin: '0px',
  threshold: 0.7,
};

function observerCallback(entries, observer) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {

      const navItem = navItems[entry.target.id];

      navItem.parentElement.classList.add('active_sitebar');

      Object.values(navItems).forEach((item) => {
        if (item != navItem) {
          item.parentElement.classList.remove('active_sitebar');
        }
      });
    }
  });
}

const observer = new IntersectionObserver(observerCallback, observerOptions);

sections.forEach((sec) => observer.observe(sec));


$(document).ready(function(){
    
$(window).scroll(function(){
        if ($(window).scrollTop() >= 730) {
            $('.sitebar-menu').addClass('fixed-header');
            console.log(2);
    
        }
        else {
            $('.sitebar-menu').removeClass('fixed-header');
            console.log(3);
    
        }
    });
})



    $('.review_btn').click(function () {
        $('.rate_little_stars').each(function (index, elem) {
            const productRating = document.getElementById('product' + index);
            const stars = productRating.querySelectorAll('.star');
            var value = document.getElementById('rate-value' + index);
            let rating = 0;
            /* Event Listeners*/
            let stars_val = []
            productRating.addEventListener('click', e => {
                stars_val = [];
                if (!e.target.matches('.star'))
                    return;
                value.innerHTML = e.target.getAttribute('data-star') + '.0';
                e.preventDefault();
                const starID = parseInt(e.target.getAttribute('data-star'));
                const starScreenReaderText = e.target.querySelector('.screen-reader');
                removeClassFromElements('is-active', stars);
                highlightStars(starID);
                resetScreenReaderText(stars);
                starScreenReaderText.textContent = `${starID} Stars Selected`;
                rating = starID; // set rating

                $('.rate_little_stars form').find('p').each(function (i, el) {
                    stars_val.push($(el).text());
                });
                let array = stars_val.map(Number);
                let sum = array.reduce((a, b) => a + b, 0);
                let average_value = parseInt(sum) / 3;

                $('.star_rating_review').html(average_value.toFixed(2));
                $('.star_average_value').val(average_value.toFixed(2))
                    
    
            });
            // Highlight on hover
            productRating.addEventListener('mouseover', e => {
                if (!e.target.matches('.star'))
                    return;
                removeClassFromElements('is-active', stars);
                const starID = parseInt(e.target.getAttribute('data-star'));
                highlightStars(starID);
            });
            //If a rating has been clicked, snap back to that rating on mouseleave
            productRating.addEventListener('mouseleave', e => {
                removeClassFromElements('is-active', stars);
                if (rating === 0)
                    return;
                highlightStars(rating);
            });
            /* Functions*/
            // Highlight active star and all those upto it
            function highlightStars(starID) {
                for (let i = 0; i < starID; i++) {
                    stars[i].classList.add('is-active')
                }
            }

            function removeClassFromElements(className, elements) {
                for (let i = 0; i < elements.length; i++) {
                    elements[i].classList.remove(className)
                }
            }

            function resetScreenReaderText(stars) {
                for (let i = 0; i < stars.length; i++) {
                    const starID = stars[i].getAttribute('data-star');
                    const text = stars[i].querySelector('.screen-reader');
                    text.textContent = `${starID} Stars`;
                }
            }
        });
    })

    
    //information show more
    $('#information .info-grid .info-block  .show-more').click(function () {
        if ($(this).hasClass('read_more')) {
            $(this).prev().css('height', '65px');
            $(this).removeClass('read_more');
        } else {
            $(this).prev().css('height', 'auto');
            $(this).addClass('read_more');
        }
    })
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