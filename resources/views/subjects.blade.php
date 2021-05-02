
@extends('layout')

@section('content')

 <section id="subject_page">
        <div class="as-mx-width">
            <div class="title">
                <h1 >{{__('messege.sug_subjects')}}</h1>

            </div>
            <div>
                
                <div class="subjects-btn d-flex  mx-auto mt-5">
                    <select class="selectpicker subject-select for-sub-select" data-live-search="true" name="subject" id="choose_subject_cat" style="overflow: none">
                        <option selected>{{__('messege.choose_cat')}}</option>
                        <option value="school_subjects" data-tokens="ketchup mustard">{{__('messege.school_matters')}}</option>
                        <option value="foreign_langs" data-tokens="mustard">{{__('messege.foreign_lang')}}</option>
                        <option value="final_entrance" data-tokens="frosting">{{__('messege.final_joint_exams')}}</option>
                        <option value="for_students" data-tokens="frosting">{{__('messege.subject_for_student')}}</option>
                        <option value="other" data-tokens="frosting">{{__('messege.other_subject')}}</option>
                    </select>
                    <select class="selectpicker subject-select" data-live-search="true" name="choose_subject" id="choose_subject">
                        <option selected>{{__('messege.select_subject')}}</option>
                    </select>
                    <form action="{{route("choosen_subject",app()->getLocale())}}" method="POST">
                        @csrf
                        <button class="as-btn" type="submit">{{__('messege.find_button')}}</button>
                        <input value="" class="choose_subject" hidden name="choosen_subject">
                        <input value="" class="choose_subject_cat" hidden name="choose_subject_cat">
                    </form>
                </div>

                <div class=" justify-content-between subject-main-div">
                    <div class="subject-div">
                        <div class="subject-icon-div mb-4 m-auto d-flex justify-content-center align-items-center">
                            <img src="/img/subject-library.svg" alt="">
                        </div>
                        <h2 >{{__('messege.school_matters')}}</h2>
                        
                        @foreach($school_subjects as $key => $value)
                        <?php
                                   if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    } 
                                ?>
                        <button class="subject-btn text-left mt-4"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}</a>
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
                    <div class="subject-div ">
                        <div class="subject-icon-div mb-4 m-auto d-flex justify-content-center align-items-center">
                            <img src="/img/subject-language.svg" alt="">
                        </div>
                        <h2>{{__('messege.foreign_lang')}}</h2>
                        @foreach($foreign_langs as $key => $value)
                        <?php
                                   if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    } 
                                ?>
                        <button class="subject-btn text-left mt-4"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}} </a>
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
                    <div class="subject-div">
                        <div class="subject-icon-div mb-4  m-auto d-flex justify-content-center align-items-center">
                            <img src="/img/graduation.svg" alt="">
                        </div>
                        <h2>{{__('messege.final_joint_exams')}}</h2>
                        
                        @foreach($final_entrance as $key => $value)
                        <?php
                                   if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    } 
                                ?>
                        <button class="subject-btn text-left mt-4"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}} </a>
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
                    <div class="subject-div">
                        <div class="subject-icon-div  m-auto d-flex justify-content-center align-items-center mb-4">
                            <img src="/img/presentation.svg" alt="">
                        </div>
                        <h2>{{__('messege.subject_for_student')}}</h2>
                        @foreach($for_students as $key => $value)
                        <?php
                                   if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    } 
                                ?>
                        <button class="subject-btn text-left mt-4"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}}</a>
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
                    <div class="subject-div ">
                        <div class="subject-icon-div  m-auto d-flex justify-content-center align-items-center">
                            <img src="/img/subject-other.svg" alt="">
                        </div>
                        <h4 class="as-seconary-title text-center mb-4 mt-4">{{__('messege.other_subject')}}</h4>
                        @foreach($other as $key => $value)
                        <?php
                                   if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    } 
                                ?>
                            <button class="subject-btn text-left mt-2"><a href="/{{app()->getLocale()}}/subjects/{{$value->id}}">{{$subject}} </a>
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
            </div>

        </div>

    </section>
@endsection