<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <!--        <link rel="stylesheet" href="{{asset("/dist/css/all.min.css")}}">-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Theme style -->
        <link rel="icon" type="image/svg+xml" href="{{asset('/img/dasaxos-favicon.svg')}}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style_an.css')}}">
<!--        <link rel="stylesheet" href="{{asset('/css/rating.min.css')}}">-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <!-- style CSS -->
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">

        <!-- Font Awesome Icon Library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
        <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{asset('/dist/css/admin.css')}}">
        <link rel="stylesheet" href="{{asset('/css/mobile.css')}}">




    </head>
    <body class="hold-transition sidebar-mini">
        <div class="">

            <!-- Navbar -->

            <!-- /.navbar -->
            <button class="collapse-btn ml-2 blog-rotate-btn" type="button" data-toggle="collapse" data-target="#AdminCollapsAside" id="admin-menu">
                <img src="/img/admin-menu.svg" alt="">
            </button>

            <div class="sitebar-body-grid">
                <!-- Main Sidebar Container -->
                <aside class="  elevation-4 collaps-admin-aside collapse dispose" id="AdminCollapsAside">
                    <!-- Brand Logo -->
                    <a href="/admin" class="brand-link">
                        <img src="/img/dasaxos-logo.svg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity:1">
                    </a>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            
                        </div>
                        <?php
                        $url = Request::path();
                        $menu = explode("/", $url);
                        ?>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
                                     with font-awesome or any other icon font library -->
                                <li class="nav-item menu-open">
                                    <!--                                <a href="#" class="nav-link active">
                                           <i class="nav-icon fas fa-tachometer-alt"></i>
                                           <p>
                                               Starter Pages
                                               <i class="right fas fa-angle-left"></i>
                                           </p>
                                       </a>-->
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'blogs') 
                                            <a href="/admin/dashboard/blogs" class="nav-link active" id="blog_link">
                                                <img src="/img/adminblog.svg" alt="" class="mr-2">
                                                <p>Բլոգ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/blogs" class="nav-link" id="blog_link">
                                                <img src="/img/adminblog.svg" alt="" class="mr-2" >
                                                <p>Բլոգ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'comments') 
                                            <a href="/admin/dashboard/comments" class="nav-link active" id="comments">
                                                <img src="/img/admincomments.svg" alt="" class="mr-2">
                                                <p>Կարծիքներ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/comments" class="nav-link" id="comments">
                                                <img src="/img/admincomments.svg" alt="" class="mr-2">
                                                <p>Կարծիքներ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'contact-us') 
                                            <a href="/admin/dashboard/contact-us" class="nav-link active" id="contact-us">
                                                <img src="/img/admincontactus.svg" alt="" class="mr-2" >
                                                <p>Հետադարձ կապ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/contact-us" class="nav-link" id="contact-us">
                                                <img src="/img/admincontactus.svg" alt="" class="mr-2">
                                                <p>Հետադարձ կապ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'contact-teachers') 
                                            <a href="/admin/dashboard/contact-teachers" class="nav-link active" id="contact-teachers">
                                                <img src="/img/admincontactteachers.svg" alt="" class="mr-2">
                                                <p>Կապ դասախոսի հետ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/contact-teachers" class="nav-link" id="contact-teachers">
                                                <img src="/img/admincontactteachers.svg" alt="" class="mr-2">
                                                <p>Կապ դասախոսի հետ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'subjects') 
                                            <a href="/admin/dashboard/subjects" class="nav-link active" id="subject_link">
                                                <img src="/img/adminsubjects.svg" alt="" class="mr-2">
                                                <p>Առարկաներ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/subjects" class="nav-link" id="subject_link">
                                                <img src="/img/adminsubjects.svg" alt="" class="mr-2">
                                                <p>Առարկաներ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'education') 
                                            <a href="/admin/dashboard/education" class="nav-link active" id="education_link">
                                                <img src="/img/mortarboard.svg" alt="" class="mr-2">
                                                <p>Կրթություն</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/education" class="nav-link" id="education_link">
                                                <img src="/img/mortarboard.svg" alt="" class="mr-2">
                                                <p>Կրթություն</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'suggest-teachers') 
                                            <a href="/admin/dashboard/suggest-teachers" class="nav-link active" id="suggest_teachers_link">
                                                <img src="/img/adminsuggestteachers.svg" alt="" class="mr-2">
                                                <p>Առաջարկել դասախոս</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/suggest-teachers" class="nav-link" id="suggest_teachers_link">
                                                <img src="/img/adminsuggestteachers.svg" alt="" class="mr-2">
                                                <p>Առաջարկել դասախոս</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'teachers') 
                                            <a href="/admin/dashboard/teachers" class="nav-link active" id="teachers_link">
                                                <img src="/img/adminteachers.svg" alt="" class="mr-2" >
                                                <p>Դասախոսներ</p>
                                            </a>
                                            @else
                                            <a href="/admin/dashboard/teachers" class="nav-link" id="teachers_link">
                                                <img src="/img/adminteachers.svg" alt="" class="mr-2">
                                                <p>Դասախոսներ</p>
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'other')
                                                <a href="/admin/dashboard/other" class="nav-link active" id="other_link">
                                                    <img src="/img/admin-setting.svg" alt="" class="mr-2" >
                                                    <p>Այլ կարգավորումներ</p>
                                                </a>
                                            @else
                                                <a href="/admin/dashboard/other" class="nav-link" id="other_link">
                                                    <img src="/img/admin-setting.svg" alt="" class="mr-2">
                                                    <p>Այլ կարգավորումներ</p>
                                                </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if(isset($menu[2]) && $menu[2] == 'language')
                                                <a href="/admin/dashboard/language" class="nav-link active" id="language_link">
                                                    <img src="/img/language.svg" alt="" class="mr-2" >
                                                    <p>Լեզու</p>
                                                </a>
                                            @else
                                                <a href="/admin/dashboard/language" class="nav-link" id="language_link">
                                                    <img src="/img/language.svg" alt="" class="mr-2">
                                                    <p>Լեզու</p>
                                                </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                                <a href="/admin/dashboard/metatag" class="nav-link active" id="language_link">
                                                    <img src="/img/metatag.svg" alt="" class="mr-2" >
                                                    <p>Մետաթեգ</p>
                                                </a>

                                        </li>
                                        <li class="nav-item">
                                            <form class="log_out p-2" action="{{route('logout',app()->getLocale())}}" method="POST">
                                                @csrf
                                                <button class="logOut d-flex">
                                                    <img src="/img/adminexit.svg" alt="" class="mr-3" >
                                                    <p>Ելք</p>      
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                @yield("content")
            </div>
            <!-- Main Footer -->
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

                            <div class=" d-flex flex-column">
                                <a href="/{{app()->getLocale()}}/blog" class="pt-2">
                                    <span>{{__('messege.menu_blog')}}</span>
                                </a>
                                <a href="/{{app()->getLocale()}}/contact" class="pt-2">
                                    <span>  {{__('messege.menu_contact')}}</span>
                                </a>
                                <div class="footer-soc-icons pt-2 d-flex justify-content-between">
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


                <div class="copyright d-flex justify-content-between pt-3 pb-3 ">
                    <div>
                        © Copyright 2020 Dasaxos.am All Rights Reserved.
                    </div>
                    <div>
                        Web design and programming
                        <a href="https://webmaker.am/" target="_blank">
                            <img src="{{asset('/img/WebMaker-logo.svg')}}" alt="" class="ml-3">
                        </a>
                    </div>
                </div>



            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{asset("/dist/js/jquery.min.js")}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset("/dist/js/bootstrap.bundle.min.js")}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset("/dist/js/adminlte.min.js")}}"></script>

        <script src="{{asset("/js/js.js")}}"></script>

        <script src="{{asset("/js/ajax.js")}}"></script>
    </body>
</html>
