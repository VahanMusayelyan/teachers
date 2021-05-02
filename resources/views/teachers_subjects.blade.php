@extends('layout')

@section('content')

    <section id="professor_search">
           <div class="as-mx-width">
           <div class="d-flex marg-top">
                   <button class="btn btn-primary collapse-btn collapse-filter-btn" type="button" data-toggle="collapse" data-target="#sitebar_filter">
                       <img src="/img/icon-filter.svg" alt="">
                   </button>
               <div class="title for-mobile-fil mb-0">
                   <h3 >{{__('messege.count_teach_title1')}} <span class="search-count ml-1">  {{count($teachers)}} {{__('messege.count_teach_title3')}} </span></h3>

               </div>

               </div>

           <div class="search-grid">
                <div class="sitebar_filter collapse  dispose" id="sitebar_filter">
                    <form class="filter" action="{{route("filter",app()->getLocale())}}" method="POST">
                            @csrf
                        <input hidden="hidden" class='lang' value='{{app()->getLocale()}}' name="lang">
                   <div class="title">
                       <h3 >
                           <p>{{__('messege.filter')}}</p>
                           <span class="no-filter">
                            <img src="{{asset('/img/trash.svg')}}" class="remove-filter" alt="">
                               {{__('messege.cancel_filters')}}
                        </span>
                       </h3>
                   </div>
                    <div class="filter-grid">
                        <select class="selectpicker select_subject_ajax select_ajax" data-live-search="true" name="subject">
                            <option selected>{{__('messege.choose')}}</option>
                            <?php foreach($subjects_all as $key => $value){
                          
                               if (app()->getLocale() == 'ru') {
                                        $subject = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $value->subject_hy;
                                    }
                                   echo "<option value='$value->id'>$subject</option>";
                            }
                           
                            ?>
                            
                        </select>
                        <select class="selectpicker select_region_ajax select_ajax" data-live-search="true" name="region" id="regions">
                            <option selected>{{__('messege.select_city')}}</option>
                             <?php
                             foreach($regions as $key => $value){
                        
                               if (app()->getLocale() == 'ru') {
                                        $region = $value->region_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $region = $value->region_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $region = $value->region_hy;
                                    }  
                                    echo "<option value='$value->id'>$region</option>";
                             }
                            ?>
                        </select>
                        <select class="selectpicker select_city_ajax select_ajax" data-live-search="true" name="country" id="city">
                            <option selected>{{__('messege.choose_city_com')}}</option>
                            <?php
                             foreach($cities as $key => $value){
                        
                               if (app()->getLocale() == 'ru') {
                                        $city = $value->city_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $city = $value->city_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $city = $value->city_hy;
                                    }  
                                    echo "<option value='$value->id'>$city</option>";
                             }
                            ?>
                        </select>
                        <div class="format">
                            <div class="mini-title">
                                <h3 >{{__('messege.format')}}</h3>

                            </div>
                            <div class="checkboxs">
                                <div class="form-group">
                                    <input type="checkbox" name="professor_home" id="professor_home"
                                        class="styled-checkbox select_location_ajax select_ajax">
                                    <label for="professor_home" class="checkbox_label">{{__('messege.checkbox_at_the_teacher')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="student_home" id="student_home"
                                        class="styled-checkbox select_location_ajax select_ajax">
                                    <label for="student_home" class="checkbox_label">{{__('messege.checkbox_at_the_student')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="online" id="online" class="styled-checkbox select_location_ajax select_ajax">
                                    <label for="online" class="checkbox_label">{{__('messege.checkbox_remotely')}}</label>
                                </div>
                            </div>

                        </div>
                        <div class="price">
                            <div  class="mini-title">
                                <h3>{{__('messege.hour_price')}}</h3>

                            </div>
                            <div class="price-rang">
                                <fieldset class="filter-price">
                                    <div class="price-wrap">
                                        <div class="price-wrap-1">
                                          <input id="one" class="select_price_ajax select_ajax">
                                          <label for="one"></label>
                                        </div>
                                        <div class="price-wrap-2">
                                            <input id="two" class="select_price_ajax select_ajax">
                                          <label for="two"><img src="{{asset('/img/dram.svg')}}" alt=""></label>
                                        </div>
                                      </div>
  
                                    <div class="price-field">
                                        <input type="range" name="min_price"  min="1000" max="50000" value="1000" id="lower" class="select_price_ajax select_ajax">
                                        <input type="range" name="max_price" min="1000" max="50000" value="50000" id="upper" class="select_price_ajax select_ajax">
                                    </div>
                                     
                                </fieldset> 
                            </div>

                        </div>
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.ready_to_teacher')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="pupil" id="pupil"
                                            class="styled-checkbox select_person_ajax select_ajax">
                                        <label for="pupil" class="checkbox_label">{{__('messege.checkbox_pupil')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="student" id="student"
                                            class="styled-checkbox select_person_ajax select_ajax">
                                        <label for="student" class="checkbox_label">{{__('messege.checkbox_student')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="adult" id="adult" class="styled-checkbox select_person_ajax select_ajax">
                                        <label for="adult" class="checkbox_label">{{__('messege.checkbox_adult')}}</label>
    
                                    </div>
                                
                            </div>


                        </div>
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.checkbox_pupil')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="minimum" id="minimum"
                                            class="styled-checkbox select_experience_ajax select_ajax">
                                        <label for="minimum" class="checkbox_label">{{__('messege.checkbox_up_to_5')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="medium" id="medium"
                                            class="styled-checkbox select_experience_ajax select_ajax">
                                        <label for="medium" class="checkbox_label">{{__('messege.checkbox_5_to_10')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="maximum" id="maximum" class="styled-checkbox">
                                        <label for="maximum" class="checkbox_label select_experience_ajax select_ajax">{{__('messege.checkbox_more_than_10')}}</label>
    
                                    </div>
                                
                            </div>


                        </div>

                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.gender')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="men" id="men"
                                            class="styled-checkbox select_gender_ajax select_ajax">
                                        <label for="men" class="checkbox_label">{{__('messege.checkbox_male')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="women" id="women"
                                            class="styled-checkbox select_gender_ajax select_ajax">
                                        <label for="women" class="checkbox_label">{{__('messege.checkbox_female')}}</label>
                                    </div>
                            </div>


                        </div>

                        <div class="all-checkboxs">

                            <div class="mini-title">
                                <h3 >{{__('messege.age')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="minimum_age" id="minimum_age"
                                            class="styled-checkbox">
                                        <label for="minimum_age" class="checkbox_label select_age_ajax select_ajax">{{__('messege.checkbox_up_to_30_years')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="medium_age" id="medium_age"
                                            class="styled-checkbox select_age_ajax select_ajax">
                                        <label for="medium_age" class="checkbox_label">{{__('messege.checkbox_30_to_50_years')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="maximum_age" id="maximum_age" class="styled-checkbox select_age_ajax select_ajax">
                                        <label for="maximum_age" class="checkbox_label">{{__('messege.checkbox_more_than_50_years')}}</label>
                                    </div>
                            </div>
                        </div>
                        <button class="as-btn filter_btn" type="submit">{{__('messege.find_button')}}</button>
                    </div>
                    </form>

                </div>
                <div class="all-professor">
                    <div class="title for-desktop-fil">
                        <h3 >{{__('messege.count_teach_title1')}} <span class="search-count">  {{count($teachers)}} {{__('messege.count_teach_title3')}} </span></h3>
                    </div>
                    <div class="prof-grid list-wrapper">
                        @foreach($teachers as $key => $value)
                        <?php
                               if (app()->getLocale() == 'ru') {
                                        $city = $value->city_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $city = $value->city_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $city = $value->city_hy;
                                    }  
                           
                            ?>
                   
                        <div class="prof-card list-item" data-number="{{Request::root()}}/{{app()->getLocale()}}/teacher/{{$value->userId}}">
                            <div class="prof-img">
                                
                                @if($value->img == null && $value->gender == 'female')
                                <img src="{{asset("/img/avatar_girl.svg")}}" alt="" class="teacher-img">
                                @elseif($value->img == null && $value->gender == 'male')
                                <img src="{{asset("/img/avatar_man.svg")}}" alt="" class="teacher-img">
                                @else
                                <img src="{{asset("/images/user_images/".$value->img)}}" alt="" class="teacher-img">
                                @endif
                                <div class="prof-star">
                                    <span class="star_ratem">
                                    <span class="Stars" style="--rating: {{(!empty($rates[$value->userId]))? round($rates[$value->userId]->teacher_val,2):'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                @if(!empty($rates[$value->userId]))
                                    <span>({{$rates[$value->userId]->count_comment}})</span>
                                @else
                                    <span> (0)</span>
                                @endif()
                                </span>

                                </div>
                              
                                
                                <div class="contact_button"><button type="button" data-number="{{$value->userId}}" data-toggle="modal" data-target="#exampleModalCenter" class="kap-hastatel">{{__('messege.contact_teacher_button')}}</button></div>
                            </div>
                            <div class="prof-info">
                                <div class="life-info">
                                    <p class="name-lastname">{{$value->name}} {{$value->l_name}}</p>
                                    <p class="age">{{Carbon\Carbon::parse($value->b_day)->age}} {{__('messege.years_old')}}</p>
                                    <p class="city">{{$city}}</p>
                                    <p class="experiance">{{__('messege.input_work_exp_placeholder')}} {{round($value->work_exp)}} {{__('messege.year')}}</p>
                                </div>
                                <p class="lessons">{{__('messege.subjects')}} 
                                <?php 
                                $i = 1;
                                $location_user = "";
                                $min_price_user = 0;
                                $min_price_student = 0;
                                $min_price_online = 0;
                                $min_time_student ="";
                                $min_time_user ="";
                                $min_time_online ="";
                               
                                foreach($subjects[$value->userId] as $key => $sub){
                                    $sphere = [];
                                    if (app()->getLocale() == 'ru') {
                                        $subject = $sub['subject_ru'];
                                    } elseif (app()->getLocale() == 'en') {
                                        $subject = $sub['subject_en'];
                                    } elseif (app()->getLocale() == 'hy') {
                                        $subject = $sub['subject_hy'];
                                    } 
                                    

                                    
                                    if($sub['location_user'] == 'on'){
                                        $location_user = 'not empty';
                                    }else{
                                        $location_user="";
                                    }
                                    
                                    if($sub['location_student'] == 'on'){
                                        $location_student = 'not empty';
                                    }else{
                                        $location_student="";
                                    }
                                    
                                    if($sub['location_online'] == 'on'){
                                        $location_online = 'not empty';
                                    }else{
                                        $location_online="";
                                    }
                                    
                                    
                                    
                                   if($i != count($subjects[$value->userId])){
                                       echo "$subject, ";
                                       $i++;
                                   }else{
                                       echo "$subject";
                                   
                                    }
                                    
                                    if(!empty($sub['price_user'])){
                                        if($key == 0){
                                            $min_price_user = $sub['price_user'];
                                            $min_time_user = $sub['duration_user'];
                                        }{
                                            if($sub['price_user'] <= $min_price_user){
                                              $min_price_user = $sub['price_user'];
                                              $min_time_user = $sub['duration_user'];
                                            }
                                        }
                                        
                                    }
                                    
                                    if(!empty($sub['price_student'])){
                                       
                                        if($key == 0){
                                            $min_price_student = $sub['price_student'];
                                            $min_time_student = $sub['duration_student'];
                                        }{
                                            if($sub['price_user'] <= $min_price_student){
                                              $min_price_student = $sub['price_student'];
                                              $min_time_student = $sub['duration_student'];
                                            }
                                        }
                                        
                                    }
                                    if(!empty($sub['price_online'])){
                                        if($key == 0){
                                            $min_price_online = $sub['price_online'];
                                            $min_time_online = $sub['duration_online'];
                                        }{
                                            if($sub['price_online'] <= $min_price_online){
                                              $min_price_online = $sub['price_online'];
                                              $min_time_online = $sub['duration_online'];
                                            }
                                        }
                                    }
                                    
                                    if($sub['pupil'] == 1){
                                        $sphere['pupil'] = __('messege.checkbox_pupil');
                                    }
                                    if($sub['student'] == 1){
                                        $sphere['student'] = __('messege.checkbox_student');
                                    }
                                    
                                    if($sub['adult'] == 1){
                                        $sphere['adult'] = __('messege.checkbox_adult');
                                    }
                                    
                                }
                                ?>
                                </p>
                                <div class="life-info">
                                    <p class="with">{{__("messege.checkbox_at_the_teacher")}}</p>
                                    <p class="price">
                                        <?php 
                                        if(empty($location_user)){
                                            echo __('messege.not_work');
                                        }else{
                                           echo __("messege.starting").' '.$min_price_user.'<img src="/img/dram.svg" alt="">/'.$min_time_user.' '.__("messege.minute");
                                        }
                                        ?>
                                    </p>
                                    <p class="with">{{__("messege.checkbox_at_the_student")}}</p>
                                    <p class="price">
                                        <?php 
                                        if(empty($location_student)){
                                            echo __('messege.not_work');
                                        }else{
                                           echo __("messege.starting").' '.$min_price_student.'<img src="/img/dram.svg" alt="">/'.$min_time_student.' '.__("messege.minute");
                                        }
                                        ?>
                                    </p>
                                    <p class="with">{{__("messege.checkbox_remotely")}}</p>
                                    <p class="price">
                                         <?php 
                                        if(empty($location_online)){
                                            echo __('messege.not_work');
                                        }else{
                                           echo __("messege.starting").' '.$min_price_online.'<img src="/img/dram.svg" alt="">/'.$min_time_online.' '.__("messege.minute");
                                        }
                                        ?>
                                    </p>
                                </div>
                                <p class="more-info">{{__("messege.more_information")}}</p>
                                
                                <p class="more-info-text show-more-height">{{$value->description}}</p>
                                <p class="show-more show_more_span">{{__("messege.see_more_button")}} <img src="{{asset('/img/Down.svg')}}" alt=""></p>  
                                <p class="with-people"> <img src="{{asset('/img/Friend.svg')}}" alt="">
                                 <?php
                                    echo "<span>".implode(", ",$sphere)."</span>";
                                    
                                 ?>                                
                                </p>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    
                       
                    </div>
                      @if(count($teachers)>4)   
                        <div id="pagination-container">
                            @if(session()->get("teacher")== "no_filter")
                                {{ $teachers->links('vendor.pagination.custom') }}
                            @else
                            <script>
                                            var items = $(".list-wrapper .list-item");
                                                var numItems = items.length;
                                                var perPage = 4;
                                                items.slice(perPage).hide();
                                                $('#pagination-container').pagination({
                                                    items: numItems,
                                                    itemsOnPage: perPage,
                                                    prevText: "&laquo;",
                                                    nextText: "&raquo;",
                                                    onPageClick: function (pageNumber) {
                                                        var showFrom = perPage * (pageNumber - 1);
                                                        var showTo = showFrom + perPage;
                                                        items.hide().slice(showFrom, showTo).show();
                                                    }
                                                });
                               </script>
                            @endif
                        </div>
                      @endif
                </div>
            </div>
           </div>
    </section>
       
<script>



    
    //price rang
var lowerSlider = document.querySelector('#lower');
var  upperSlider = document.querySelector('#upper');

document.querySelector('#two').value=upperSlider.value;
document.querySelector('#one').value=lowerSlider.value;

var  lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);

upperSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);

    if (upperVal < lowerVal + 8) {
        lowerSlider.value = upperVal - 8;
        if (lowerVal == lowerSlider.min) {
        upperSlider.value = 8;
        }
    }
    document.querySelector('#two').value=this.value
};

lowerSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    if (lowerVal > upperVal - 8) {
        upperSlider.value = lowerVal + 8;
        if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 8;
        }
    }
    document.querySelector('#one').value=this.value
};
</script>

        @endsection