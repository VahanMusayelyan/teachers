<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/svg+xml" href="{{asset('/img/dasaxos-favicon.svg')}}">
        <!-- Bootstrap CSS -->
       
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style_an.css')}}">
        <link rel="stylesheet" href="{{asset('/css/rating.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/mobile.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
         <link rel="stylesheet" href="{{asset('/css/swiper-bundle.min.css')}}">
       
       <!--swiper js -->

        <script src="{{asset('/js/swiper-bundle.min.js')}}"></script>
        <script src="//code.jivosite.com/widget/7ZJoZqyEyp" async></script>


        <!-- Latest compiled and minified JavaScript -->


        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('/js/jquery.simplePagination.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe9VsXAzqnxpnnTh6F-RljSKm6UXwadSY&libraries=places&sensor=false&v=3.exp"></script>
        <!--  -->
        <script src="{{asset('/js/rating.min.js')}}"></script>
        <script src="{{asset('/js/ajax.js')}}"></script>
        <meta name="description" content="<?php
//                if(isset($description)){
//                    if(app()->getLocale() == 'ru' || app()->getLocale() == 'en'){
//                        $meta_description = explode( '.', $description);
//                        if(strlen($meta_description[0]) > 2){
//                            echo $meta_description[0];
//                        }else{
//                            echo   $meta_description[1];
//                        }
//                    }else{
//                        $meta_description = explode( ':', $description);
//                        echo $meta_description[0];
//                    }
//                }

                    if(isset($teacher->description)){
                    if(app()->getLocale() == 'ru' || app()->getLocale() == 'en'){
                        $meta_description = explode( '.', $teacher->description);
                        if(strlen($meta_description[0]) > 2){
                            echo $meta_description[0];

                        }else{
                            echo   $meta_description[1];
                        }
                    }else{
                        $meta_description = explode( '։', $teacher->description);
                        echo $meta_description[0];
                    }
                }elseif(isset($meta_tags)){
                    if(app()->getLocale() == "hy"){
                        echo $meta_tags->description_hy;
                    }elseif (app()->getLocale() == "ru"){
                        echo $meta_tags->description_ru;
                    }else{
                        echo $meta_tags->description_en;
                    }

                }elseif(isset($meta_tags_comm) ){
                    if(app()->getLocale() == "hy"){
                        echo $meta_tags_comm->description_hy;
                    }elseif (app()->getLocale() == "ru"){
                        echo  $meta_tags_comm->description_ru;
                    }else{
                        echo  $meta_tags_comm->description_en;
                    }

                }
        ?>">
       
       
        <title>
            <?php
//            if(isset($title)){
//                echo $title;
//            }else  if(isset($user)){
//
//                        echo ($user->name.' '.$user->l_name);
//
//            }else  if(isset($teacher)){
//
//                    echo ($teacher->name.' '.$teacher->m_name.' '.$teacher->l_name);
//
//            }else{
//
//            }


          if(isset($meta_tags)){
                if(app()->getLocale() == "hy"){
                    echo $meta_tags->title_hy;
                }elseif (app()->getLocale() == "ru"){
                    echo $meta_tags->title_ru;
                }else{
                    echo $meta_tags->title_en;
                }

            }elseif(isset($meta_tags_info) && isset($teacher)){
              if(app()->getLocale() == "hy"){
                  echo $teacher->name.' '.$teacher->l_name.$meta_tags_info->title_hy;
              }elseif (app()->getLocale() == "ru"){
                  echo  $teacher->name.' '.$teacher->l_name.$meta_tags_info->title_ru;
              }else{
                  echo  $teacher->name.' '.$teacher->l_name.$meta_tags_info->title_en;
              }

          }elseif(isset($meta_tags_comm) && isset($user)){
              if(app()->getLocale() == "hy"){
                  echo $meta_tags_comm->title_hy.$user->name.' '.$user->l_name;
              }elseif (app()->getLocale() == "ru"){
                  echo  $meta_tags_comm->title_ru.$user->name.' '.$user->l_name;
              }else{
                  echo  $meta_tags_comm->title_en.$user->name.' '.$user->l_name;
              }

          }else{
                echo 'Dasaxos.am';
            }
            ?>

            </title>
    </head>
    <body>
    <?php
//        $x=explode("։",$teacher->description);
//    dd($x);


//            dump(get_defined_vars());
    ?>
        <!-- ↓ header -->
        <header class="container-fluid sticky-top" id="nav-bar">
            <input hidden="hidden" id='lang' value='{{app()->getLocale()}}'>
            <div class="container-fluid as-mx-width p-0">
                <nav class="navbar navbar-expand-lg navbar-dark p-0">
                    <button class="navbar-toggler" type="button" data-toggle="" id="burg" data-target="#" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="/{{app()->getLocale()}}">
                        <img src="{{asset('/img/dasaxos-logo.svg')}}" alt="Dasaxos" class="nav-logo">
                    </a>
<div class="for-mobile">
    @if(!Auth::check())
        <li class="nav-item d-flex">
            <a class="nav-link" data-toggle="modal" data-target=".bd-example-modal-lg" href="{{route('login',app()->getLocale())}}" style="color:white">
            <img src="{{asset('/img/nav-account-icon.svg')}}" alt="">
                <!-- {{__('messege.login')}} -->
            </a>
        </li>
    @else
        <form class="log_out" action="{{route('logout',app()->getLocale())}}" method="POST">
            @csrf
            <li class="nav-item dropdown d-flex">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->img == null && Auth::user()->gender == 'female')
                        <a href="/{{app()->getLocale()}}/account" class="profile"><img src="/img/avatar_girl.svg" alt="" class="profile-img"></a>

                    @elseif(Auth::user()->img == null && Auth::user()->gender == 'male')
                        <a href="/{{app()->getLocale()}}/account"  class="profile"><img src="/img/avatar_man.svg" alt="" class="profile-img"></a>

                    @else
                        <a href="/{{app()->getLocale()}}/account" class="profile"><img src="/images/user_images/{{Auth::user()->img}}" alt="" class="profile-img"></a>
                    @endif

                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown09" id="dropdown_account">

                    <a href="/{{app()->getLocale()}}/account" class="profile">{{Auth::user()->name}}</a>
                    <a class="dropdown-item profile" href="/{{app()->getLocale()}}/profile"><img src="{{asset('/img/settings.svg')}}"> {{__('messege.settings')}} </a>
                    <button id="logout" class="dropdown-item profile" href=""><img src="{{asset('/img/exit.svg')}}">{{__('messege.log_out')}}</button>


                </div>
            </li>

        </form>
    @endif
</div>
                   <div class="nav-mob" id="">
                   <div  id="navbarsExample" >
                        <ul class="navbar-nav mr-auto d-flex justify-content-between nav nav-pills nav-mob">
                            <form class="form-search for-mobile" action="{{route('search',app()->getLocale())}}" method="POST">
                                @csrf
                                <input class=" mr-sm-2 search-input d-block-search" type="search"  name="search">
                                <button type="submit" hidden></button>
                                <div id="search-icon" class="for-mobile">
                                    <img src="/img/Search.svg" alt="">
                                </div>
                            </form>

                            <li class="nav-item">
                                @if(request()->path() == app()->getLocale().'/about')
                                <a class="nav-link menu_active" href="/{{app()->getLocale()}}/about">{{__('messege.menu_about')}}</a>
                                @else
                                    <a class="nav-link" href="/{{app()->getLocale()}}/about">{{__('messege.menu_about')}}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(request()->path() == app()->getLocale().'/teacher')
                                <a class="nav-link menu_active" href="/{{app()->getLocale()}}/teacher">{{__('messege.menu_teachers')}}</a>
                                @else
                                    <a class="nav-link" href="/{{app()->getLocale()}}/teacher">{{__('messege.menu_teachers')}}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(request()->path() == app()->getLocale().'/subjects')
                                <a class="nav-link menu_active" href="/{{app()->getLocale()}}/subjects">{{__('messege.menu_matter')}}</a>
                                    @else
                                    <a class="nav-link" href="/{{app()->getLocale()}}/subjects">{{__('messege.menu_matter')}}</a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if(request()->path() == app()->getLocale().'/blog')
                                <a class="nav-link menu_active" href="/{{app()->getLocale()}}/blog">{{__('messege.menu_blog')}}</a>
                                @else
                                    <a class="nav-link" href="/{{app()->getLocale()}}/blog">{{__('messege.menu_blog')}}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(request()->path() == app()->getLocale().'/contact')
                                <a class="nav-link menu_active" href="/{{app()->getLocale()}}/contact">{{__('messege.menu_contact')}}</a>
                                @else
                                    <a class="nav-link" href="/{{app()->getLocale()}}/contact">{{__('messege.menu_contact')}}</a>
                                @endif
                            </li>
                            <div class=" justify-content-between navbar-other-items for-mobile m-0">
                                <li class="nav-item d-flex">
                                    <a class="nav-link phone-number" href="Tel:+374{{$phone->value}}">
                                    <img src="{{asset('/img/nav-phone-icon.svg')}}" alt="phone">    
                                    +374 {{$phone->value}}</a>
                                </li>
                                <form class="form-search for-desktop" action="{{route('search',app()->getLocale())}}" method="POST">
                                    @csrf
                                    <input class=" mr-sm-2 search-input " type="search"  name="search">
                                    <button type="submit" hidden></button>
                                    <div id="search-icon1" class="search-icon1" style="cursor:pointer;" >
                                        <img src="/img/Search.svg" alt="">
                                    </div>
                                </form>

`                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="flag-icon flag-icon-us">
                                            @if(app()->getLocale() == 'hy')
                                                <p class="lang-text">Հայ</p>
                                            @elseif(app()->getLocale() == 'en')
                                                <p class="lang-text">Eng</p>
                                            @elseif(app()->getLocale() == 'ru')
                                                <p class="lang-text">Ру</p>
                                            @endif
                                        </span>
                                    </a>
                                    <?php
                                    $arr = \Request::segments();
                                    $url_hy = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_hy[$key] = 'hy';
                                        }else{
                                            $url_hy[$key] = $value;
                                        }

                                    }
                                    $url_ru = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_ru[$key] = 'ru';
                                        }else{
                                            $url_ru[$key] = $value;
                                        }
                                    }

                                    $url_en = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_en[$key] = 'en';
                                        }else{
                                            $url_en[$key] = $value;
                                        }
                                    }

                                    ?>
                                    <div class="dropdown-menu" aria-labelledby="dropdown09">

                                        <a class="dropdown-item" href="/{{implode("/",$url_hy)}}"><span class="flag-icon flag-icon-fr"> </span>  Հայերեն</a>
                                        <a class="dropdown-item" href="/{{implode("/",$url_en)}}"><span class="flag-icon flag-icon-it"> </span>  English</a>
                                        <a class="dropdown-item" href="/{{implode("/",$url_ru)}}"><span class="flag-icon flag-icon-ru"> </span>  Русский</a>

                                    </div>
                                </li>
                        </ul>

                        <div id="navbar-for-desk" class=" d-flex justify-content-between navbar-other-items for-desktop-nav ml-3">
                                <li class="nav-item d-flex">
                                <a class="nav-link  p-0 mr-2" href="Tel:+374{{$phone->value}}">
                                    <img src="{{asset('/img/nav-phone-icon.svg')}}" alt="phone">
                                    <span class="phone-number">+374
                                        <?php
                                        $str= $phone->value;
                                        $new_str='('.$str[0].$str[1].')'.' '.$str[2].$str[3].'-'.$str[4].$str[5].'-'.$str[6].$str[7];
                                        ?>
                                        {{$new_str}}

                                    </span></a>
                                </li>
                                <form class="form-search for-desktop" action="{{route('search',app()->getLocale())}}" method="POST">
                                    @csrf
                                    <input class=" mr-sm-2 search-input inp1" type="search"  name="search">
                                    <button type="submit" hidden></button>
                                    <div id="search-icon1" class="search-icon-desk icon-search" style="cursor:pointer;" >
                                        <img src="/img/Search.svg" alt="" style="cursor:pointer">
                                    </div>
                                </form>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="flag-icon flag-icon-us">
                                            @if(app()->getLocale() == 'hy')
                                            <p class="lang-text">Հայ</p>
                                            <!-- <img src="{{asset('/img/lang-arm-flag.svg')}}" alt="Հայերեն"> -->
                                            @elseif(app()->getLocale() == 'en')
                                            <p class="lang-text">Eng</p>
                                            <!-- <img src="{{asset('/img/uk.svg')}}" alt="English"> -->
                                            @elseif(app()->getLocale() == 'ru')
                                            <p class="lang-text">Ру</p>
                                            <!-- <img src="{{asset('/img/ru.svg')}}" alt="Русский"> -->
                                            @endif
                                        </span>
                                    </a>
                                    <?php 
                                    $arr = \Request::segments();
                                    $url_hy = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_hy[$key] = 'hy';
                                        }else{
                                            $url_hy[$key] = $value;  
                                        }
                                      
                                    }
                                    $url_ru = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_ru[$key] = 'ru';
                                        }else{
                                            $url_ru[$key] = $value;  
                                        }
                                    }
                                   
                                    $url_en = [];
                                    foreach ($arr as $key => $value){
                                        if($key == 0){
                                            $url_en[$key] = 'en';
                                        }else{
                                            $url_en[$key] = $value;  
                                        } 
                                    }
                                    
                                    ?>
                                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                                        
                                        <a class="dropdown-item" href="/{{implode("/",$url_hy)}}"><span class="flag-icon flag-icon-fr"> </span>  Հայերեն</a>
                                        <a class="dropdown-item" href="/{{implode("/",$url_en)}}"><span class="flag-icon flag-icon-it"> </span>  English</a>
                                        <a class="dropdown-item" href="/{{implode("/",$url_ru)}}"><span class="flag-icon flag-icon-ru"> </span>  Русский</a>
                                        
                                    </div>
                                </li>
                                @if(!Auth::check())
                                <li class="nav-item d-flex ">
                                    <img src="{{asset('/img/nav-account-icon.svg')}}" alt="">
                                    <a class="nav-link pl-1 pr-0" data-toggle="modal" data-target=".bd-example-modal-lg" href="{{route('login',app()->getLocale())}}">{{__('messege.login')}}</a>
                                </li>
                                @else
                                <form class="log_out" action="{{route('logout',app()->getLocale())}}" method="POST">
                                @csrf
                                    <li class="nav-item dropdown account-login">
                                        <a class="nav-link dropdown-toggle " href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{asset('/img/nav-account-icon.svg')}}" alt="">

                                        </a>
                                        <div class="dropdown-menu " aria-labelledby="dropdown09" id="dropdown_account">


                                            @if(Auth::user()->img == null && Auth::user()->gender == 'female')
                                                <a href="/{{app()->getLocale()}}/account" class="profile"><img src="/img/avatar_girl.svg" alt="" class="profile-img"> {{Auth::user()->name}}</a>

                                            @elseif(Auth::user()->img == null && Auth::user()->gender == 'male')
                                                <a href="/{{app()->getLocale()}}/account"  class="profile"><img src="/img/avatar_man.svg" alt="" class="profile-img">{{Auth::user()->name}}</a>

                                            @else
                                                <a href="/{{app()->getLocale()}}/account" class="profile"><img src="/images/user_images/{{Auth::user()->img}}" alt="" class="profile-img">{{Auth::user()->name}}</a>
                                            @endif

                                                <a class="dropdown-item profile" href="/{{app()->getLocale()}}/profile"><img src="{{asset('/img/settings.svg')}}">  {{__('messege.settings')}}</a>
                                            <button id="logout" class="dropdown-item profile" href=""><img src="{{asset('/img/exit.svg')}}">{{__('messege.log_out')}}</button>


                                        </div>
                                    </li>

                                 </form>
                                @endif
                            </div>
                    </div>
                   </div>
                </nav>
            </div>
        </header>

        <!-- ↑ header -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="/img/x.svg" alt="" class="close-btn" data-toggle="modal" data-target="#myModal">
            </button>
            <section id="login-professor">

               <?php if($errors->count() < 3 && ($errors->first('email') || $errors->first('password'))){?>

                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <ul>
                        <?php
                        if ($errors->has('email') || $errors->has('password')){ if (app()->getLocale() == 'ru') {
                             $email = 'Эл. почта / пароль неправильный';
    
                           } elseif (app()->getLocale() == 'en') {
                            $email = 'Email / Password is wrong';
    
                            } elseif (app()->getLocale() == 'hy') {
                               $email = 'Էլ. հասցեն/գաղտնաբառը սխալ է';

                               }
                               echo " <li> $email </li>"; $email = "";}
                             ?>
                    </ul>
                </div>
               
           <script>$(document).ready(function () { $('.bd-example-modal-lg').modal('show')})</script>
        <?php session()->forget("register"); } ?>



                <?php if( $errors->count() < 3 && ( $errors->first('name') || $errors->first('lastname') || $errors->first('comment') )){  ?>

                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <ul>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </ul>
                </div>


                <?php  } ?>

                <div class="as-mx-width">
                    <div class="login">
                        <form action="{{ route('login',app()->getLocale())}}" method="POST" class="login-form">
                            @csrf
                            <div class="login-grid">
                                <div class="log-img">
                                    <img src="/img/Avatar.svg" alt="">
                                    <p class="log-in">{{__('messege.login_title')}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="professor_login_email">{{__('messege.email')}}</label>
                                    <input type="email" name="email" id="professor_login_email"  class="styled-inputtext">
                                </div>
                                <div class="form-group">
                                    <label for="professor_login_password">{{__('messege.password')}}</label>
                                    <input type="password" name="password" id="professor_login_password"  class="styled-inputtext">
                                </div>
                                <p  class="for-reg forgot-password">{{__('messege.forgote_password')}}</p>

                                <button type="submit" class="login-but">{{__('messege.login_button')}}</button>
                                <a href="/{{app()->getLocale()}}/register" class="for-reg">{{__('messege.link_registration')}}</a>
                            </div>
                        </form>
                        <form action="{{ route('res_password',app()->getLocale())}}" class="forgot-password-form">
                            @csrf
                            <div class="log-img">
                                <img src="/img/Avatar.svg" alt="">
                                <p class="log-in">{{__('messege.reset_password')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="professor_login_email">{{__('messege.email')}}</label>
                                <input type="email" name="email_reset" id="professor_login_email"  class="styled-inputtext">
                            </div>
                            <button type="submit" class="login-but as-btn " style="margin: 20px auto;display: grid">{{__('messege.send_button')}}</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>



<div class="modal fade bs-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='exampleModalCenter'>
  <div class="modal-dialog">
    <!-- Modal Content: begins -->
    <div class="modal-content">
            <section id="kap_hastatel">
                <img src="/img/x.svg" alt="" class="close-btn close_modal" data-toggle="modal" data-target="#myModal2">
                <div class="as-mx-width">
        <div class="kap-hastatel-form">
            <form action="{{route('contact_teacher',app()->getLocale())}}" method="POST" class="contact_form">
                @csrf
                <div class="title">
                    <h3 >{{__('messege.contact_teacher_title')}}</h3>
                </div>

                <p class="ligth-text">{{__('messege.contact_teacher_subtitle')}}</p>
                <div class="form-group">
                    <label for="flname">{{__('messege.name')}}   {{__('messege.lastname')}} </label>
                    <input type="text" name="name_lname" id="flname" class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="phone">{{__('messege.phonenumber')}}</label>
                    <input type="text" name="phone" id="phone" class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="subject_teacher">{{__('messege.subject')}}</label>
                    <select class="selectpicker "  name="subject_teacher" id="subject_teacher" class="mb-5">


                    </select>
                </div>

                <p class="ligth-text mt-3">{{__('messege.contact_you_within')}}</p>
                <button type="submit" class="btn-kap-hastatel">{{__('messege.send_button')}}</button>
                <input value="" hidden name="teacher_number" class="teacher_number">
            </form>
        </div>
     </div>
        </section>
        </div>
    </div>
</div>
        @yield('content')

        <!-- ↓ footer -->
        <footer>
            <div class="container-fluid footer">
                <div class="container-fluid as-mx-width px-0">
                    <div class="row px-0 footer-block">
                        <div class=" d-flex flex-column">
                            <a href="/{{app()->getLocale()}}">
                                <img src="{{asset('/img/dasaxos-logo.svg')}}" alt="" class="footer-logo">
                            </a>                            
                            <p class="pt-2">
                                {{__('messege.title_footer')}}
                            </p>
                            
                        </div>
                        <?php
                        if(app()->getLocale() == 'ru') {?>
                        <div class=" d-flex flex-column">
                        <a href="/doc/ru/user_agreement.pdf" class="pt-2" download>
                        <span>  {{__('messege.doc_1')}}</span>
                        </a>
                        <a href="/doc/ru/personal_data.pdf" class="pt-2" download>
                            <span>  {{__('messege.doc_2')}}</span>
                        </a>
                        <a href="/doc/ru/public_suggest.pdf" class="pt-2" download>
                            <span>  {{__('messege.doc_3')}}</span>
                        </a>

                    </div>
                       <?php }else if(app()->getLocale() == 'hy'){ ?>

                        <div class=" d-flex flex-column">
                            <a href="/doc/hy/user_agreement.pdf" class="pt-2" download>
                                <span>  {{__('messege.doc_1')}}</span>
                            </a>
                            <a href="/doc/hy/personal_data.pdf" class="pt-2" download>
                                <span>  {{__('messege.doc_2')}}</span>
                            </a>
                            <a href="/doc/hy/public_suggest.pdf" class="pt-2" download>
                                <span>  {{__('messege.doc_3')}}</span>
                            </a>

                        </div>
                        <?php } else{?>
                        <div class=" d-flex flex-column">
                            <a href="/{{app()->getLocale()}}/about" class="pt-2">
                                <span>  {{__('messege.menu_about')}}</span>
                            </a>
                            <a href="/{{app()->getLocale()}}/teacher" class="pt-2">
                                <span>  {{__('messege.menu_teachers')}}</span>
                            </a>
                            <a href="/{{app()->getLocale()}}/subjects" class="pt-2">
                                <span>  {{__('messege.menu_matter')}}</span>
                            </a>

                        </div>
                        <?php } ?>

                        <div class=" d-flex flex-column">
                            <a href="/{{app()->getLocale()}}/blog" class="pt-2">
                                <span>{{__('messege.menu_blog')}}</span>
                            </a>
                            <a href="/{{app()->getLocale()}}/contact" class="pt-2">
                                <span>  {{__('messege.menu_contact')}}</span>
                            </a>
                            <div class="footer-soc-icons pt-2 d-flex justify-content-center">
                                <a href="https://www.facebook.com/Dasaxos.am" target="_blank">
                                    <img src="{{asset('/img/ftr-icon-fb.svg')}}" alt="">
                                </a>
                                <a href="#" target="_blank">
                                    <img src="{{asset('/img/ftr-icon-tw.svg')}}" alt="">
                                </a>
                                <a href="https://www.instagram.com/dasaxos.am" target="_blank">
                                    <img src="{{asset('/img/ftr-icon-ins.svg')}}" alt="">
                                </a>
                                <a href="https://vk.com/public201186138" target="_blank">
                                    <img src="{{asset('/img/ftr-icon-vk.svg')}}" alt="">
                                </a>
                                <a href="https://www.youtube.com/channel/UCygw2W4q9Cr8_8ze20AMxPQ?view_as=subscriber" target="_blank">
                                    <img src="{{asset('/img/ftr-icon-yt.svg')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="copyright d-flex justify-content-start pt-3 pb-3 ">
                <div>
                    © Copyright 2020 Dasaxos.am All Rights Reserved.
                </div>
                <div class="ml-5 text-center">
                    Web design and programming
                    <a href="https://webmaker.am/" target="_blank">
                        <img src="{{asset('/img/WebMaker-logo.svg')}}" alt="" class="ml-1">
                    </a>


                </div>
            </div>


                
 </footer>
        <!-- ↑ footer -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

         <script src="{{asset('/js/js.js')}}"></script>

        <script>
 $(document).ready(function(){
     

   $('#burg').click(function(){
       if($(this).hasClass('active-menu')){
        $('.nav-mob').css('display','none');
        $(this).removeClass('active-menu');
       }else{
        $('.nav-mob').css('display','block');
        $(this).addClass('active-menu');

       }
   })


            $('.forgot-password').click(function(){
                $('.forgot-password-form').css('display','block');
                $('.login-form').css('display','none');

            })

            $('.close').click(function(){
                $('.forgot-password-form').css('display','none');
                $('.login-form').css('display','block');
            })

   
        
    $('.icon-search').click( function(e) {
        
        
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too\
        $('.inp1').toggle();
        
    });
        
    $('.inp1').click( function(e) {
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
    });
    
    $('body').click( function() {
        $('.inp1').hide();
    });
    
});

 $(window).scroll(function(){
     $("select.hiro-selecter.city").next().next().find("div.show").css({"height":"485px"});
     $("select.hiro-selecter.city").next().next().css({"height":"550px"});
 });


        </script>


        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(71413720, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/71413720" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </body>
</html>