@extends('layout')

@section('content')


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{asset('/js/date.js')}}"></script>


<script>
$(function () {
  $("#datepicker").datepicker(
         {
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd/mm/yy",
      yearRange: 'c-75:c',
      showButtonPanel: false
  }
  );

  var lang = $("#lang").val();
  if (lang == 'en') {
      lang = 'en-GB';
  }
  $("#datepicker").datepicker("option",
          $.datepicker.regional[ lang ]);


});
</script>

<section id="reg-professor">
    <div class="as-mx-width">
        <div class="title">
            <h1 >{{__('messege.setting_update_title')}}</h1>

        </div>

         @if (session('success'))
                    <div class="alert_success">
                      <div>  <img src="/img/x.svg" alt="" class="close-message" style="cursor: pointer"></div>
                        <h5 class="feedback-message">{{__('messege.setting_update_message')}}</h5>

                    </div>
         @endif
     
        <form action="{{ route('update_profile',app()->getLocale())}}" method="POST" class="reg-form-update" enctype="multipart/form-data">
            @csrf
            <div class="pers_inf"> 
                <div class="inf-grid">
                    <div>
                        <div class="title">
                            <h2 >{{__('messege.personal_information')}}</h2>

                        </div>
                        <div class="up_img">
                            <div class="logoContainer">
                                @if(!empty(Auth::user()->img))
                                <img src="/images/user_images/{{Auth::user()->img}}">
                                @else
                                    @if(Auth::user()->gender == "male")
                                    <img src="/img/avatar_man.svg">
                                    @else
                                    <img src="/img/avatar_girl.svg">
                                    @endif
                             
                                @endif
                            </div>
                            <div class="fileContainer sprite">
                                <span>{{__('messege.upload_image_button')}}</span>
                                <input type="file" name="professor_img" id="professor_img">
                            </div>
                        </div>
                        <div class="gender">
                            <label>{{__('messege.gender')}}</label>
                            <div class="form-group">
                                @if(Auth::user()->gender == "male")
                                <input type="radio" name="gender" value="male" id="men" checked="checked">
                                <label for="men">{{__('messege.checkbox_male')}}</label>
                                <input type="radio" name="gender" value="female" id="women">
                                <label for="women">{{__('messege.checkbox_female')}}</label>
                                @else
                                <input type="radio" name="gender" value="male" id="men">
                                <label for="men">{{__('messege.checkbox_male')}}</label>
                                <input type="radio" name="gender" value="female" id="women" checked="checked">
                                <label for="women">{{__('messege.checkbox_female')}}</label>
                                @endif
                            </div>

                        </div>


                    </div>
                    <div class="inp-grid">
                        <div class="form-group">
                            <label for="professor_name">{{__('messege.teach_name')}}</label>
                            <input type="text" name="name" id="professor_name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="professor_lname">{{__('messege.teach_lastname')}}</label>
                            <input type="text" name="professor_lname" id="professor_lname" value="{{Auth::user()->l_name}}">
                        </div>
                        <div class="form-group">
                            <label for="professor_fathername">{{__('messege.teach_fathername')}}</label>
                            <input type="text" name="professor_fathername" id="professor_fathername" value="{{Auth::user()->m_name}}">
                        </div>
                        <div class="form-group">
                            <?php
                            $b_day = Auth::user()->b_day;
                            $b_date = explode("-",$b_day);
                            ?>
                            <label for="birth">{{__('messege.date_of_birth')}}</label>
                            <script>
                                $(function(){
                                    $('#datepicker').datepicker('setDate', '<?php echo $b_date[2].".".$b_date[1].".".$b_date[0]; ?>');
                                });
                            </script>
                            <input type="text" id="datepicker" name="birth_date"  />
                        </div>
                        <div class="form-group">
                            <label for="country">{{__('messege.country')}}</label>
                            <select class="selectpicker" data-live-search="true" name="country" id="country">
                                <!--                                <option value="" selected></option>-->
                                <?php
                                if (app()->getLocale() == "hy"){
                                    $sel_country = "Ընտրել";
                                }elseif(app()->getLocale() == "ru"){
                                    $sel_country = "Выберите";
                                }elseif(app()->getLocale() == "en"){
                                    $sel_country = "Select";
                                }
                                ?>
                                <option selected>{{$sel_country}}</option>
                                <?php
                                foreach($countries as $key => $value){
                                    if (app()->getLocale() == 'ru') {
                                        $country  = $value->country_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $country  = $value->country_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $country  = $value->country_hy;
                                    }
                                    if(Auth::user()->country_id == $value->id ){
                                        echo "<option value='$value->id' selected>$country</option>";
                                    }else{
                                        echo "<option value='$value->id'>$country</option>";
                                    }
                                }

                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            @csrf
                            <label for="region">{{__('messege.region')}}</label>
                            <select class="selectpicker" data-live-search="true" name="region" id="regions">

                                <option value="" selected></option>
                                <?php
                                foreach($regions as $key => $value){
                                    if (app()->getLocale() == 'ru') {
                                        $region  = $value->region_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $region  = $value->region_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $region  = $value->region_hy;
                                    }
                                    if(Auth::user()->region_id == $value->id ){
                                        echo "<option value='$value->id' selected>$region</option>";
                                    }else{
                                        echo "<option value='$value->id'>$region</option>";
                                    }
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group city_group">
                            <label for="city">{{__('messege.city_community')}}</label>
                            <select class="selectpicker" data-live-search="true" name="city" id="city">
                                <?php

                                foreach($cities as $key => $value){
                                    if (app()->getLocale() == 'ru') {
                                        $city  = $value->city_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $city  = $value->city_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $city  = $value->city_hy;
                                    }
                                    if(Auth::user()->city_id == $value->id ){
                                        echo "<option value='$value->id' selected>$city</option>";
                                    }else{
                                        echo "<option value='$value->id'>$city</option>";
                                    }
                                }

                                ?>
                            </select>

                        </div>



                        <div class="form-group">
                            <label for="professor_address">{{__('messege.address')}}</label>
                            <input type="text" name="professor_address" id="professor_address" value="{{Auth::user()->address}}">
                        </div>
                    </div>

                </div>
                <div class="pers_map">
                    <div class="row map-row">
                        <div class="teacher-map">
                            <div id="map" style="width:100%; height:236px;border-radius:30px;"></div>
                                <input type="hidden" id="location" name="location" value="{{Auth::user()->user_north}},{{Auth::user()->user_east}}"/>
                        </div>
                    </div>

                </div>

            </div> 
            <div class="who-chackebox">
                <div class="title">{{__('messege.ready_to_teacher')}}  </div>
                <div class="checkboxs profile_update_checkbox">
                    <div class="form-group">
                        <?php 
                            foreach ($subject_user as $key => $value) {
                               $reset = $value;
                               break;
                            }
                   
                        ?>
                        @if($reset->pupil == 1)
                        <input type="checkbox" name="pupil" id="pupil" class="styled-checkbox pupil_loc" checked="checked">
                        <label for="pupil" class="checkbox_label">{{__('messege.checkbox_pupil')}}</label>
                        @else
                        <input type="checkbox" name="pupil" id="pupil" class="styled-checkbox pupil_loc">
                        <label for="pupil" class="checkbox_label">{{__('messege.checkbox_pupil')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        @if($reset->student == 1)
                        <input type="checkbox" name="student" id="student" class="styled-checkbox student_loc" checked="checked">
                        <label for="student" class="checkbox_label">{{__('messege.checkbox_student')}}</label>
                        @else
                        <input type="checkbox" name="student" id="student" class="styled-checkbox student_loc">
                        <label for="student" class="checkbox_label">{{__('messege.checkbox_student')}}</label>
                        @endif
                        
                    </div>
                    <div class="form-group">
                        @if($reset->adult == 1)
                        <input type="checkbox" name="adult" id="adulthood" class="styled-checkbox adulthood_loc" checked="checked">
                        <label for="adulthood" class="checkbox_label">{{__('messege.checkbox_adult')}}</label>
                        @else
                        <input type="checkbox" name="adult" id="adulthood" class="styled-checkbox adulthood_loc">
                        <label for="adulthood" class="checkbox_label">{{__('messege.checkbox_adult')}}</label>
                        @endif
                        

                    </div>
                </div>
            </div>

            <div class="lessons_price">
                <div class="title">{{__('messege.subject_and_price')}}</div>
                @foreach($subject_user as $key_user => $value_user)
                <div class="add_subject">
                    <img src="/img/x.svg" class="del-upfile del-subject" data-number="{{$value_user->id}}" onclick="confirmationDelete()">
                    <div class="form-group sub-select">
                        <label for="subject">{{__('messege.select_subject_title')}}</label>
                        <select class="selectpicker subject_sel" data-live-search="true" name="subject[]">
                            <option value="">{{__('messege.subjects')}}</option>
                             <?php 
                                foreach($subjects as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $subject  = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $subject  = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $subject  = $value->subject_hy;
                                    } 
                                    
                                    if($value->id == $key_user){
                                           echo "<option value='$value->id' selected>$subject</option>"; 
                                        }else{
                                            echo "<option value='$value->id'>$subject</option>"; 
                                        }
                                }
                                    
                                ?>
                        </select>                      
                    </div>
                    <div class="title-price">{{__('messege.price_dur')}}</div>
                    <div class="grid-price">
                        <div> 
                            <div class="checkboxs">
                                <div class="mini-title">
                                    <h3 >{{__('messege.location')}}</h3>

                                </div>
                                <div class="form-group">
                                    @if($value_user->location_user == "on")
                                    <input type="checkbox" name="professor_home[]" id="professor_home1{{$key_user}}" class="styled-checkbox pupil" checked="checked">
                                    @else
                                    <input type="checkbox" name="professor_home[]" id="professor_home1{{$key_user}}" class="styled-checkbox pupil professor_home">
                                    @endif
                                    <label for="professor_home1{{$key_user}}" class="checkbox_label">{{__('messege.checkbox_at_the_teacher')}}</label>
                                </div>
                                <div class="form-group">
                                     @if($value_user->location_student == "on")
                                    <input type="checkbox" name="student_home[]" id="student_home1{{$key_user}}" class="styled-checkbox student" checked="checked">
                                    @else
                                    <input type="checkbox" name="student_home[]" id="student_home1{{$key_user}}" class="styled-checkbox student">
                                    @endif
                                    
                                    <label for="student_home1{{$key_user}}" class="checkbox_label">{{__('messege.checkbox_at_the_student')}}</label>
                                </div>
                                <div class="form-group">
                                    @if($value_user->location_online == "on")
                                    <input type="checkbox" name="online_home[]" id="online1{{$key_user}}" class="styled-checkbox online_home adulthood" checked="checked">
                                    @else
                                    <input type="checkbox" name="online_home[]" id="online1{{$key_user}}" class="styled-checkbox online_home adulthood">
                                    @endif
                                    
                                    <label for="online1{{$key_user}}" class="checkbox_label">{{__('messege.checkbox_remotely')}}</label>

                                </div>
                            </div>
                        </div>
                        <div> 
                            <div class="inputs">
                                <div class="mini-title">
                                    <h3 >{{__('messege.lesson_price')}}</h3>

                                </div>
                                <div class="form-group">
                                    @if(!empty($value_user->price_user))
                                     <input type="text" name="professor_home_price[]" id="professor_home_{{$key_user}}" class="styled-inputtext pupil_price"  placeholder="{{__('messege.input_price_placeholder')}}" value="{{$value_user->price_user}}">
                                    @else
                                     <input type="text" name="professor_home_price[]" id="professor_home_{{$key_user}}" class="styled-inputtext pupil_price" placeholder="{{__('messege.input_price_placeholder')}}">
                                    @endif
                                   
                                </div>
                                <div class="form-group">
                                    @if(!empty($value_user->price_student))
                                     <input type="text" name="student_home_price[]" id="student_home_{{$key_user}}" class="styled-inputtext student_price" placeholder="{{__('messege.input_price_placeholder')}}" value="{{$value_user->price_student}}">
                                    @else
                                    <input type="text" name="student_home_price[]" id="student_home_{{$key_user}}" class="styled-inputtext student_price" placeholder="{{__('messege.input_price_placeholder')}}">
                                    @endif
                                    
                                </div>
                                <div class="form-group">
                                    @if(!empty($value_user->price_online))
                                     <input type="text" name="online_price[]" id="online_{{$key_user}}" class="styled-inputtext adulthood_price" placeholder="{{__('messege.input_price_placeholder')}}" value="{{$value_user->price_online}}">
                                    @else
                                     <input type="text" name="online_price[]" id="online_{{$key_user}}" class="styled-inputtext adulthood_price" placeholder="{{__('messege.input_price_placeholder')}}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div > 
                            <div class="selectss">
                                <div class="mini-title">
                                    <h3 >{{__('messege.duration')}}</h3>

                                </div>
                                <div class="form-group">
                                    <select class="selectpicker"  name="professor_home_time[]">
                                        @if($value_user->duration_user == "60")
                                                <option value="45" >45{{__('messege.minute')}}</option>
						<option value="60" selected>60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_user == "90")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" selected>90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_user == "120")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" selected>120{{__('messege.minute')}}</option>
                                        @else
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @endif
                                    </select>     
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker"  name="student_home_time[]">
                                        @if($value_user->duration_student == "60")
                                                <option value="45" >45{{__('messege.minute')}}</option>
						<option value="60" selected>60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_student == "90")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" selected>90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_student == "120")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" selected>120{{__('messege.minute')}}</option>
                                        @else
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @endif
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker"  name="online_time[]">
                                        @if($value_user->duration_online == "60")
                                                <option value="45" >45{{__('messege.minute')}}</option>
						<option value="60" selected>60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_online == "90")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" selected>90{{__('messege.minute')}}</option>
                                                <option value="120" selected>120{{__('messege.minute')}}</option>
                                        @elseif($value_user->duration_online == "120")
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" selected>120{{__('messege.minute')}}</option>
                                        @else
                                                <option value="45" selected>45{{__('messege.minute')}}</option>
						<option value="60" >60{{__('messege.minute')}}</option>
						<option value="90" >90{{__('messege.minute')}}</option>
						<option value="120" >120{{__('messege.minute')}}</option>
                                        @endif
                                    </select>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="title-price subject_add">{{__('messege.add_subject_button')}}  <img src="{{asset('/img/plus.svg')}}" alt="" id="add_subject_but"></div>

            </div>

            <div class="perofesinal_info">
                <p class="title">{{__('messege.professional_information')}} </p>
                <div class="grid-edu-exp">
                    <div class="form-group">
                        
                        <label for="education">{{__('messege.select_education_title')}} </label>
                        <select class="selectpicker" data-live-search="true" name="education">         

                            <?php 
                                foreach($education as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $education  = $value->education_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $education  = $value->education_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $education  = $value->education_hy;
                                    } 
                                    
                                    if($value->id == Auth::user()->education){
                                    echo "<option value='$value->id' selected>$education</option>";
                                    }else{
                                       echo "<option value='$value->id' >$education</option>";
                                    }
                                }
                                ?>
                        </select>
                       
                    </div>
                    <div class="form-group">
                        <?php 
                          $works = explode(".",Auth::user()->work_exp);
                          if($works[1] == '00'){
                             $work = $works[0]; 
                          }else{
                            $work = Auth::user()->work_exp;  
                          }
                         
                        ?>
                        <label for="professor_experience">{{__('messege.input_work_exp_title')}} </label>
                        <input type="text" name="professor_experience" id="professor_experience" placeholder="{{__('messege.input_work_exp_placeholder')}} " class="styled-inputtext" value="{{$work}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="professor_about">{{__('messege.tell_about_yourself')}} </label>
                    <textarea name="professor_about" id="professor_about">{{Auth::user()->description}}</textarea>
                </div>
                <div class="up-files">
                    <label for="upload" class="up-label">
                        <input type="file" id="upload"  multiple name="certificates[]">{{__('messege.upload_certificate')}}
                        </label>
                </div>
                <div class="certificates">
                @foreach($certificates as $key => $value)
                    <div class="cert_certificate">
                         <img src="/img/x.svg" class="del-upfile del-accounnt-cert profile_cert_del" data-cert="{{$value->certificate}}" onclick="confirmationDelete()">
                        <img src="/images/user_certificates/{{$value->certificate}}" class="diplom-img">
                    </div>
                @endforeach
                </div>
                
                <div class="files">
                    <ul></ul>
                </div>
            </div> 
            <div class="reg">
                <div class="grid-reg">
                    <div class="form-group">
                        <label for="professor_phone">{{__('messege.phonenumber')}} </label>
                        <input type="text" name="professor_phone" id="professor_phone" value="{{Auth::user()->phone}}" class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('messege.email')}} </label>
                        <input type="email" name="email" id="email" value="{{Auth::user()->email}}"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_password">{{__('messege.change_password')}} </label>
                        <input type="password" name="pass" id="professor_password"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_confpassword">{{__('messege.confirm_password')}} </label>
                        <input type="password" name="pass_confirmation" id="professor_confpassword"  class="styled-inputtext">
                    </div>
                </div>

            </div>
            <input type="submit" class="reg-but" value="{{__('messege.update_button')}} " />
        </form>
    </div>

</div>
</section>

<script>








    let teacher_location = $('.teacher-map').find('#location').val().split(',');
    
    let north = teacher_location[0];
    let east = teacher_location[1];
    var mapOptions = {
        zoom:15,
        center: new google.maps.LatLng(north,east),
        scaleControl: true,
        streetViewControl: true,
        panControl: true,
        mapTypeControl: true,
        overviewMapControlOptions:{opened:true},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var marker_settings = {
        position: new google.maps.LatLng(north,east),
        map: map,
    };

    var marker = new google.maps.Marker(marker_settings);
    var markers = [];

    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
            (function(place) {
                var marker = new google.maps.Marker({
                    position: place.geometry.location
                });
                marker.bindTo('map', searchBox, 'map');
                google.maps.event.addListener(marker, 'map_changed', function() {
                    if (!this.getMap()) {
                        this.unbindAll();
                    }
                });
                bounds.extend(place.geometry.location);
            }(place));

        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(),12));

    });

    function clearOverlays() {
        while(markers.length) { markers.pop().setMap(null); }
        markers.length = 0;
    }

    markers.push(marker);
    google.maps.event.addListener(map, "click", function(event) {
        if (event.latLng) {
            clearOverlays();
            var markerD2_settings = {
                position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                map: map,
                draggable:true
            };
            var markerD2 = new google.maps.Marker(markerD2_settings);
            markers.push(markerD2);
            google.maps.event.addListener(markerD2, "drag", function() {
                document.getElementById("location").value=event.latLng.lat()+','+event.latLng.lng();
            });
            document.getElementById("location").value=event.latLng.lat()+','+event.latLng.lng();
        }
    });
    
    function confirmationDelete(anchor)
{
   var conf = confirm('Вы уверены, что хотите удалить эту запись?');
   if(conf)
      window.location=anchor.attr("href");
      anchor.remove();

}









</script>
@endsection
