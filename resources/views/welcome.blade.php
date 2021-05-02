@extends('layout')

@section('content')

    <!-- ↓ hiro -->
    <a id="up_button">
        <img src="/img/up_icon.svg" alt="">
    </a>
    <section class="hiro container-fluid" style="background-image: url(/img/{{$background->value}});">
        <div class="hiro-content container-fluid as-mx-width p-0 d-flex">
            <div class="hiro-search container m-0 p-0 d-flex justify-content-center">
                <h2 >
                    {{__('messege.title')}}
                </h2>
                <form class="city_subject_seacrh" action="{{route('subject_city',app()->getLocale())}}" method="post">
                    @csrf
                    <select class="selectpicker hiro-selecter" name="subject">
                        <option>{{__('messege.select_subject')}}</option>
                        @foreach($subjects as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }
                            ?>
                            <option value="{{$value->id}}">{{$subject}}</option>
                        @endforeach
                    </select>
                    <select class="selectpicker hiro-selecter city" data-live-search="true" name="city">
                        <option data-tokens="ketchup mustard">{{__('messege.select_city')}}</option>
                        @foreach($regions as $key => $reg)
                        <?php
                                if (app()->getLocale() == 'ru') {
                                    $region = $reg->region_ru;
                                } elseif (app()->getLocale() == 'en') {
                                    $region = $reg->region_en;
                                } elseif (app()->getLocale() == 'hy') {
                                    $region = $reg->region_hy;
                                }
                                ?>
                        <option class="bold_text_reg" value="1.{{$reg->id}}">{{$region}}</option>
                        
                            <?php
                            foreach($cities as $key => $value){
                                
                                if($value->region_id == $reg->id){
                                    if (app()->getLocale() == 'ru') {
                                        $city = $value->city_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $city = $value->city_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $city = $value->city_hy;
                                    }
                               
                                echo '<option value="'.$value->id.'" class="ml-3">'.$city.'</option>';
                                }
                        
                            }
                            ?>
                        @endforeach
                    
                    </select>
                    <button class="as-btn">{{__('messege.find_button')}}</button>
                </form>
            </div>
            <div class="container m-0 d-flex align-items-center hiro-slider-div position-relative">
                <div class="hiro-slider">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($slider as $key => $value)
                                @if($key == 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="active"></li>
                                @else
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"></li>
                                @endif
                            @endforeach
                        </ol>
                        
                        <div class="carousel-inner hiro-mask">
                            @foreach($slider as $key => $value)
                                @if($key == 0)
                                <div class="carousel-item hiro-slider-div1 active">
                                    <img src="/img/{{$value->value}}" alt="" class="hiro-slider-img">
                                </div>
                                @else
                                <div class="carousel-item hiro-slider-div1">
                                    <img src="/img/{{$value->value}}" alt="" class="hiro-slider-img">
                                </div>
                                @endif
                            @endforeach
                            
                        </div>

                    </div>
                </div>
                <img src="./img/hiro-slider-element-left.svg" alt="" class="hiro-slider-element-left">
                <img src="./img/hiro-slider-element-right-top.svg" alt="" class="hiro-slider-element-right-top">
                <img src="./img/hiro-slider-element-right-bottom.svg" alt="" class="hiro-slider-element-right-bottom">
            </div>
        </div>
    </section>
    <!-- ↑ hiro -->
    <!-- ↓ main -->
    <main>
        <!-- ↓ two ways to find section -->
        <section class="container">
            <div class="text-center as-main-title mb-3">
                <h3 >{{__('messege.title_2')}}</h3>

            </div>
            <div class="d-flex justify-content-center">
                <div class="left-arrow-dashed">
                    <img src="./img/left-arrow-dashed.svg" alt="">
                </div>
                <div class="arrows-middle-image-bg">
                    <div class="arrows-middle-image m-0" style="background-image: url(/img/{{$bottom_img->value}});"></div>
                </div>
                <div class="right-arrow-dashed">
                    <img src="./img/right-arrow-dashed.svg" alt="">
                </div>
            </div>
            <div class="two-way-cards-main-div mt-4">
                <div class="fast-way-card">
                    <div class="d-flex justify-content-center flex-column">
                        <img src="./img/flash-fast.svg" alt="fast" class="mb-4">
                        <h4 >{{__('messege.fast_find_title')}}</h4>
                        <p class="text-center card-paragraph mb-4"><pre>{{__('messege.fast_find_desc')}}</pre></p>
                    </div>
                    <div class="mx-auto">
                        <button class="as-btn-y mt-4"><a href="/{{app()->getLocale()}}/teacher">{{__('messege.fast_find_button')}}</a></button>
                    </div>
                </div>
                <div class="faster-way-card">
                    <div class="d-flex justify-content-center flex-column">
                        <img src="./img/flash-faster.svg" alt="fast" class="mb-4">
                        <h4 >{{__('messege.fastest_find_title')}}</h4>
                        <p class="text-center card-paragraph mb-4"><pre>{{__('messege.fastest_find_desc')}}</pre></p>
                    </div>
                    <div class="mx-auto">
                        <button class="as-btn-r mt-4"><a href="/{{app()->getLocale()}}/suggest-teacher">{{__('messege.fastest_find_button')}}</a></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- ↑ two ways to find section -->
        <!-- ↓ lecturers and subjects section -->
        <section class="container-fluid lecturers_subjects">
            <div class="comtainer-fluid as-mx-width p-0 m-auto">
                <!-- ↓ lecturers -->

                <div class="text-center m-0 ">
                    <div id="teacherCarousel" class="swiper-container m-0 pt-5 pb-5" >
                        <div class="text-center as-main-title mb-5">
                            <h3 >{{__('messege.required_teacher')}} </h3>

                        </div>
                        <div class="swiper-wrapper">
                            <?php $k = 1;$c = 1; ?>

                            @foreach($teachers as $key => $value)
                                <?php
                                if (app()->getLocale() == 'ru') {
                                    $subject = $value->subject_ru;
                                } elseif (app()->getLocale() == 'en') {
                                    $subject = $value->subject_en;
                                } elseif (app()->getLocale() == 'hy') {
                                    $subject = $value->subject_hy;
                                }


                                ?>
                                    <div class="swiper-slide">
                                        <a href="/{{app()->getLocale()}}/teacher/{{$value->user_id}}">
                                            <div class="carousel-item-lecturer">
                                                @if($value->img == null && $value->gender == 'female')
                                                    <img src="{{asset("/img/avatar_girl.svg")}}" alt="" class="lecturer-card-img">
                                                @elseif($value->img == null && $value->gender == 'male')
                                                    <img src="{{asset("/img/avatar_man.svg")}}" alt="" class="lecturer-card-img">
                                                @else
                                                    <img src="{{asset("/images/user_images/".$value->img)}}" alt="" class="lecturer-card-img">
                                                @endif


                                                <div class="lecturer-card-star mt-2">
                                                    <span class="Stars" style="--rating: {{(!empty($rates[$value->user_id]))? round($rates[$value->user_id],2):'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                                </div>
                                                <h5 class="my-2">{{$value->name}} {{$value->l_name}}</h5>
                                                <h6 class="mb-0">{{__('messege.subject')}}</h6>
                                                <span class="subject_of_study">{{$subject}}</span>
                                            </div>
                                        </a>
                                    </div>   
                                <?php   $k++; $c++; ?>

                            @endforeach
                        </div>
                        <div class="swiper-pag">
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
                <!-- ↑ lecturers -->
                <!-- ↓ subjects -->
                <div class="container-fluid subjects-title-div">
                    <div class="text-center as-main-title mb-3">
                        <h3 >{{__('messege.required_matter')}}</h3>
                    </div>

                </div>
                <div class="d-flex justify-content-between subject-main-div">
                    <div class="subject-div d-flex flex-column justify-content-center">
                        <div class="subject-icon-div   d-flex justify-content-center align-items-center  d-flex justify-content-center align-items-center">
                            <img src="./img/subject-library.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.school_matters')}}</h4>
                        @foreach($subjects_school as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }

                            ?>
                            <button class="subject-btn text-left mt-2">{{$subject}}
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.864" height="14.659" viewBox="0 0 24.864 14.659">
                                        <g id="Arrow_3" data-name="Arrow 3" transform="translate(1 1.414)">
                                        <path class="arrow-path" id="Path_172" data-name="Path 172" d="M300,1140.754h22.2" transform="translate(-300 -1134.834)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        <path class="arrow-path" id="Path_173" data-name="Path 173" d="M394.039,1091.969l5.915-5.915-5.915-5.915" transform="translate(-377.504 -1080.139)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        @endforeach

                    </div>
                    <div class="subject-div d-flex flex-column justify-content-center">
                        <div class="subject-icon-div  d-flex justify-content-center align-items-center">
                            <img src="./img/subject-language.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.foreign_lang')}}</h4>
                        @foreach($subjects_foreign as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }

                            ?>
                            <button class="subject-btn text-left mt-2"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}
                                    </a>
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.864" height="14.659" viewBox="0 0 24.864 14.659">
                                        <g id="Arrow_3" data-name="Arrow 3" transform="translate(1 1.414)">
                                        <path class="arrow-path" id="Path_172" data-name="Path 172" d="M300,1140.754h22.2" transform="translate(-300 -1134.834)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        <path class="arrow-path" id="Path_173" data-name="Path 173" d="M394.039,1091.969l5.915-5.915-5.915-5.915" transform="translate(-377.504 -1080.139)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <div class="subject-div d-flex flex-column justify-content-center">
                        <div class="subject-icon-div  d-flex justify-content-center align-items-center">
                            <img src="/img/graduation.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.final_joint_exams')}}</h4>
                        @foreach($subjects_final as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }

                            ?>
                            <button class="subject-btn text-left mt-2"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}
                                   </a>
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.864" height="14.659" viewBox="0 0 24.864 14.659">
                                        <g id="Arrow_3" data-name="Arrow 3" transform="translate(1 1.414)">
                                        <path class="arrow-path" id="Path_172" data-name="Path 172" d="M300,1140.754h22.2" transform="translate(-300 -1134.834)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        <path class="arrow-path" id="Path_173" data-name="Path 173" d="M394.039,1091.969l5.915-5.915-5.915-5.915" transform="translate(-377.504 -1080.139)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <div class="subject-div d-flex flex-column justify-content-center">
                        <div class="subject-icon-div  m-auto d-flex justify-content-center align-items-center">
                            <img src="/img/presentation.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.subject_for_student')}}</h4>
                        @foreach($subjects_student as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }

                            ?>
                            <button class="subject-btn text-left mt-2"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}
                                   </a>
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.864" height="14.659" viewBox="0 0 24.864 14.659">
                                        <g id="Arrow_3" data-name="Arrow 3" transform="translate(1 1.414)">
                                        <path class="arrow-path" id="Path_172" data-name="Path 172" d="M300,1140.754h22.2" transform="translate(-300 -1134.834)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        <path class="arrow-path" id="Path_173" data-name="Path 173" d="M394.039,1091.969l5.915-5.915-5.915-5.915" transform="translate(-377.504 -1080.139)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <div class="subject-div d-flex flex-column justify-content-center">
                        <div class="subject-icon-div  m-auto d-flex justify-content-center align-items-center">
                            <img src="./img/subject-other.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.other_subject')}}</h4>
                        @foreach($subjects_other as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }

                            ?>
                            <button class="subject-btn text-left mt-2"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}
                                   </a>
                                <span class="float-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.864" height="14.659" viewBox="0 0 24.864 14.659">
                                        <g id="Arrow_3" data-name="Arrow 3" transform="translate(1 1.414)">
                                        <path class="arrow-path" id="Path_172" data-name="Path 172" d="M300,1140.754h22.2" transform="translate(-300 -1134.834)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        <path class="arrow-path" id="Path_173" data-name="Path 173" d="M394.039,1091.969l5.915-5.915-5.915-5.915" transform="translate(-377.504 -1080.139)" fill="none" stroke="#bcbcbc" stroke-linecap="round" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="subjects-btn-div d-flex justify-content-between mx-auto mt-5">
                     <form action="{{route("choosen_subject",app()->getLocale())}}" method="POST" class="find-btn">
                        @csrf
                    <select class="selectpicker" data-live-search="true" name="choosen_subject">
                        <option>{{__('messege.select_subject')}}</option>
                        @foreach($subjects as $key => $value)
                            <?php
                            if (app()->getLocale() == 'ru') {
                                $subject = $value->subject_ru;
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value->subject_en;
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value->subject_hy;
                            }
                            ?>
                        <option value="{{$value->id}}">{{$subject}}</option>
                        @endforeach
                    </select>
                        <button class="as-btn" type="submit">{{__('messege.find_button')}}</button>
                    </form>
                </div>
                <!-- ↑ subjects -->
            </div>
        </section>
        <!-- ↑ lecturers and subjects section -->

        <section id="home_about" >
            <div class="as-mx-width mt-5">
                <div class="grid_div">
                    <div>
                        <img src="./img/home-about.png" alt="">

                    </div>

                    <div class="text">
                        <h1>{{__('messege.home_about_title')}}</h1>
                        <p>
                           <?php echo __('messege.home_about_text') ?>
                        </p>

                        <a class="as-btn pt-2 pl-4 pr-4 pb-2" href="/{{app()->getLocale()}}/about" class="about_button">{{__('messege.about_button')}} </a>

                    </div>
                </div>
            </div>


        </section>
        <!-- ↓ blog -->
        <section  class="container-fluid hp-blog">
            <div class="comtainer-fluid as-mx-width p-0 m-auto">
                <div class="text-center m-0 p-0">
                    <div id="teacherblogCarousel" class="swiper-container mb-5 pb-5 pt-5" >
                        <div class="text-center as-main-title mb-5">
                            <h3 >{{__('messege.menu_blog')}}</h3>

                        </div>

                        <div class="swiper-wrapper p-3">
                            <?php $count = 1; $j = 1; ?>
                            @foreach($blogs as $key => $blog)
                                <?php
                                  $date=explode('-',substr($blog->created_at,0,10));

                                if (app()->getLocale() == 'ru') {
                                    $title = $blog->title_ru;
                                    $description = $blog->description_ru;
                                } elseif (app()->getLocale() == 'en') {
                                    $title = $blog->title_en;
                                    $description = $blog->description_en;
                                } elseif (app()->getLocale() == 'hy') {
                                    $title = $blog->title_hy;
                                    $description = $blog->description_hy;
                                }
                                if($j == 1){
                                    $class = 'active';
                                }else{
                                    $class = '';
                                }
                                ?>


                                    <div class="swiper-slide">
                                        <a href="/{{app()->getLocale()}}/blog/{{$blog->id}}">
                                            <div class="carousel-item-blog p-0">
                                                <div class="img-overflow-hdn">
                                                    <div>
                                                    <img src="/images/blogs/{{$blog->img}}" alt="" class="blog-card-img blog-img">
                                                        <div class="img-filter">
                                                            <span class="blog-read-more">{{__('messege.read_more')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="blog-card-content blog-card-content-padding">
                                                    <h6 class="text-left mb-4">{{$title}}</h6>
                                                    <p class="text-left mb-0 blog-text">{{$description}}</p>
                                                    <p class="blog-date">{{$date[2]}}.{{$date[1]}}.{{$date[0]}}</p>

                                                </div>
                                            </div>
                                        </a>
                                      
                                    </div>
                                    <?php $count = 0 ?>
                                
                                <?php $count++; $j++; ?>
                            @endforeach
                           
                        </div>
                        <div class="swiper-pag">
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="as-btn"><a class="see_more" href="/{{app()->getLocale()}}/blog">{{__('messege.see_more_button')}}</a></button>
                </div>
            </div>
        </section>
        <!-- ↑ blog -->
        <!-- ↓ reviews -->
        <section class="container-fluid hp-reviews">
            <div class="comtainer-fluid as-mx-width p-0 m-auto">
                <div class="text-center m-0 p-0">
                    <div  id="teachercommentCarousel" class="swiper-container pt-5 pb-5">
                        <div class="text-center as-main-title mb-5 t-left">
                            <h3 >{{__('messege.comments_header')}}</h3>

                        </div>

                        <div class="swiper-wrapper">
                            <?php $count = 1; $j = 1; ?>
                            @foreach($comment as $key => $value)
                                <?php
                                if($j == 1){
                                    $class = 'active';
                                }else{
                                    $class = '';
                                }
                                ?>


                                    <div class="swiper-slide p-3">
                                        <a href="/{{app()->getLocale()}}/{{$value->user_id}}/comment">
                                            <div class="carousel-item-reviews">
                                                <div class="d-flex position-relative">
                                                    <img src="/img/comment_avatar.svg" alt="">
                                                    <div class="d-flex pl-3 flex-column">
                                                        <div class="d-flex justify-content-between mb-4">
                                                            <h6>{{$value->name}} {{$value->l_name}}</h6>
                                                            <div class="reviews-card-star">
                                                                <span class="Stars" style="--rating: {{(!empty($value->avg_value))? round($value->avg_value,2):'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                                            </div>
                                                        </div>
                                                        <p class="text-left">{{$value->comment}}</p>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="51.402" height="19.128" viewBox="0 0 51.402 19.128">
                                                        <g id="Group_176" data-name="Group 176" transform="translate(-1411.916 -2659.076)">
                                                            <path id="Path_92" class="arrow-path" data-name="Path 92" d="M-640.526,8613.188h48.41" transform="translate(2053.443 -5944.554)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
                                                            <path id="Path_93" class="arrow-path" data-name="Path 93" d="M-509.05,8586.184l8.15,8.149-8.15,8.15" transform="translate(1962.804 -5925.694)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                        
                                    <?php $count = 0 ?>
                                <?php $count++; $j++; ?>
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
        </section>
        <!-- ↑ reviews -->
    </main>
    <!-- ↑ main -->

     <!-- Swiper JS -->

<!-- Initialize Swiper -->
<script>
  var mySwiper =new Swiper ('#teachercommentCarousel', {

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
                        '990': {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        }
                    },
                   
                    // Optional parameters
                    pagination: {
                        el: '#teachercommentCarousel .swiper-pagination',
                        type:'bullets',
                        clickable: true,
                          },
                          // Navigation arrows
    
    loop: true,
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
                new Swiper ('#teacherblogCarousel', {
                    
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
                        '990': {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        }
                    },
                    // Optional parameters
                    pagination: {
                        el: '#teacherblogCarousel .swiper-pagination',
                        clickable: true,
                    },
                    // Navigation arrows
                    loop: true,
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


                
                new Swiper ('#teacherCarousel', {
                    
                    loopedSlides: 500,
                    breakpoints: {
                        '300': {
                            slidesPerView: 1,
                            spaceBetween: 0,
                        },
                        '570': {
                            slidesPerView: 1,
                            spaceBetween: 0,
                        },
                        '769': {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                        '992': {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                        '1024': {
                            slidesPerView:3,
                            spaceBetween: 10,
                        },
                        
                        '1250': {
                            slidesPerView: 4,
                            spaceBetween: 10,
                        },
                        '1920': {
                            slidesPerView: 4,
                            spaceBetween: 10,
                        }
                        
                    },
                    // Optional parameters
                    pagination: {
                        el: '#teacherCarousel .swiper-pagination',
                        clickable: true,
                    },
                    // Navigation arrows
                    loop: true,
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


  var btn = $('#up_button');

  $(window).scroll(function() {
      if ($(window).scrollTop() > 1000) {
          btn.addClass('show');
      } else {
          btn.removeClass('show');
      }
  });

  btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '1000');
  });
  
   $(window).scroll(function(){
     $(".hiro-selecter.city").next().next().find("div.show").css({"height":"485px"});
     $(".hiro-selecter.city").next().next().css({"height":"550px"});
 });



</script>

@endsection