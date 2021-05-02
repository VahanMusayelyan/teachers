@extends('layout')

@section('content')


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{asset('/js/date.js')}}"></script>


<script>
$(function () {
//    $( "#datepicker" ).datepicker( $.datepicker.regional[ "hy" ] );
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

<?php 
if(session()->get("register") == "true"){
if ($errors->first('name') || $errors->first('professor_fathername') || $errors->first('professor_lname') || $errors->first('city') || $errors->first('region')
         || $errors->first('professor_address') || $errors->first('birth_date') || $errors->first('education') || $errors->first('professor_experience') || $errors->first('professor_about')
         || $errors->first('professor_phone') || $errors->first('email') || $errors->first('password') || $errors->first('password_confirmation')){?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    
<?php 
         } 
         }
?>
    
    

<section id="reg-professor">
    <div class="as-mx-width">
        <div class="title">{{__('messege.reg_title')}}</div>
        
        {!! NoCaptcha::renderJs() !!}
 
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
        
        
        <form action="{{ route('register',app()->getLocale())}}" method="POST" class="reg-form" enctype="multipart/form-data" name="registration" >
            @csrf
            <div class="pers_inf"> 
                <div class="inf-grid">
                    <div>
                        <p class="title">{{__('messege.personal_information')}}</p>
                        <div class="up_img">
                            <div class="logoContainer">
                                <img src="{{asset('/img/Avatar2.svg')}}">
                            </div>
                            <div class="fileContainer sprite">
                                <span>{{__('messege.upload_image_button')}}</span>
                                <input type="file" name="professor_img" id="professor_img">
                            </div>
                        </div>
                        <div class="gender">
                            <label>{{__('messege.gender')}}</label>
                            <div class="form-group">
                                <input class="gender_btn" type="radio" name="gender" value="male" id="men">
                                <label for="men">{{__('messege.checkbox_male')}}</label>
                                <input  class="gender_btn" type="radio" name="gender" value="female" id="women">
                                <label for="women">{{__('messege.checkbox_female')}}</label>
                            </div>

                        </div>
                    </div>
                    <div class="inp-grid">
                        <div class="form-group">
                            <label for="professor_name">{{__('messege.teach_name')}}</label>
                            <input type="text" name="name" id="professor_name" value="{{ old('name') }}" class="styled-inputtext">
                        </div>
                        <div class="form-group">
                            <label for="professor_lname">{{__('messege.teach_lastname')}}</label>
                            <input type="text" name="professor_lname" id="professor_lname" value="{{ old('professor_lname') }}" class="styled-inputtext">
                        </div>
                        <div class="form-group">
                            <label for="professor_fathername">{{__('messege.teach_fathername')}}</label>
                            <input type="text" name="professor_fathername" id="professor_fathername" value="{{ old('professor_fathername') }}" class="styled-inputtext">
                        </div>
                        <div class="form-group">

                            <label for="birth">{{__('messege.date_of_birth')}}</label>
                            <input type="text" id="datepicker" class="birth_date" name="birth_date"/>
                            {{--<script>--}}
                            {{--$(function(){--}}
                            {{--$('#datepicker').datepicker('setDate', '<?php echo $b_date[2].".".$b_date[1].".".$b_date[0]; ?>');--}}
                            {{--});--}}
                            {{--</script>--}}

                        </div>
                        <div class="form-group country">
                            <label for="country">{{__('messege.country')}}</label>
                            <select class="selectpicker" data-live-search="true" id="country" name="country">
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
                                    echo "<option value='$value->id'>$country</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            @csrf
                            <label for="region">{{__('messege.region')}}</label>
                            <select class="selectpicker" data-live-search="true" name="region" id="regions">

                                <option value="0" selected>{{__('messege.choose')}}</option>
                                <!--                                --><?php //
                                //                                foreach($regions as $key => $value){
                                //                                   if (app()->getLocale() == 'ru') {
                                //                                        $region  = $value->region_ru;
                                //                                    } elseif (app()->getLocale() == 'en') {
                                //                                         $region  = $value->region_en;
                                //                                    } elseif (app()->getLocale() == 'hy') {
                                //                                         $region  = $value->region_hy;
                                //                                    }
                                //
                                //                                    echo "<option value='$value->id'>$region</option>";
                                //                                }
                                //
                                //                                ?>
                            </select>
                        </div>

                        <div class="form-group city_group">
                            <label for="city">{{__('messege.city_community')}}</label>
                            <select class="selectpicker" data-live-search="true" name="city" id="city">
                                <option value="0" selected>{{__('messege.choose')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="professor_address">{{__('messege.address')}}</label>
                            <input type="text" name="professor_address" id="professor_address" value="{{ old('professor_address') }}">
                        </div>
                    </div>

                </div>
                <div class="pers_map">
                    <div class="row map-row">
                        <div class="teacher-map">
                            <div id="map" style="width:100%; height:236px;border-radius:30px;"></div>
                                <input type="hidden" id="location" name="location" value="40.177200,44.503490"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="who-chackebox">
                <div class="title"> {{__('messege.ready_to_teacher')}}</div>
                <div class="checkboxs">
                    <div class="form-group">
                        <input type="checkbox" name="pupil" id="pupil" class="styled-checkbox pupil_loc">
                        <label for="pupil" class="checkbox_label">{{__('messege.checkbox_pupil')}}</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="student" id="student" class="styled-checkbox student_loc">
                        <label for="student" class="checkbox_label">{{__('messege.checkbox_student')}}</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="adult" id="adulthood" class="styled-checkbox adulthood_loc">
                        <label for="adulthood" class="checkbox_label">{{__('messege.checkbox_adult')}}</label>

                    </div>
                </div>
            </div>

            <div class="lessons_price">
                <div class="title">{{__('messege.subject_and_price')}}</div>
                <div class="add_subject">
                    <div class="form-group sub-select">
                        <label for="subject">{{__('messege.select_subject_title')}}
                        </label>
                        <select class="selectpicker subject_sel" id="subject" data-live-search="true" name="subject[]">
                            <option value="0" selected>{{__('messege.subject')}}</option>
                             <?php 
                                foreach($subjects as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $subject  = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $subject  = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $subject  = $value->subject_hy;
                                    } 
                                    
                                    echo "<option value='$value->id'>$subject</option>";
                                }
                                    
                                ?>
                        </select>                      
                    </div>
                    <div class="title-price">{{__('messege.price_dur')}}</div>
                    <div class="grid-price">
                        <div> 
                            <div class="checkboxs">
                                <h3 class="mini-title">{{__('messege.location')}}</h3>
                                <div class="form-group">
                                    <input type="checkbox" val="off" name="professor_home[]" id="professor_home" class="styled-checkbox pupil">
                                    <label for="professor_home" class="checkbox_label">{{__('messege.checkbox_at_the_teacher')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" val="off" name="student_home[]" id="student_home" class="styled-checkbox student">
                                    <label for="student_home" class="checkbox_label">{{__('messege.checkbox_at_the_student')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" val="off" name="online_home[]" id="online" class="styled-checkbox adulthood">
                                    <label for="online" class="checkbox_label">{{__('messege.checkbox_remotely')}}</label>

                                </div>
                            </div>
                        </div>
                        <div> 
                            <div class="inputs">
                                <h3 class="mini-title">{{__('messege.lesson_price')}}</h3>
                                <div class="form-group">
                                    <input type="text" val="" name="professor_home_price[]" id="professor_home" class="styled-inputtext pupil_price" placeholder="{{__('messege.input_price_placeholder')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" val="" name="student_home_price[]" id="student_home" class="styled-inputtext student_price" placeholder="{{__('messege.input_price_placeholder')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" val="" name="online_price[]" id="online" class="styled-inputtext adulthood_price" placeholder="{{__('messege.input_price_placeholder')}}">

                                </div>
                            </div>
                        </div>

                        <div > 
                            <div class="selectss">
                                <h3 class="mini-title">{{__('messege.duration')}}</h3>
                                <div class="form-group">
                                    <select class="selectpicker" id="professor_home_time" class="professor_home_time"  name="professor_home_time[]">
                                        <option value="45" selected>45{{__('messege.minute')}}</option>
                                        <option value="60" >60{{__('messege.minute')}}</option>
                                        <option value="90" >90{{__('messege.minute')}}</option>
                                        <option value="120" >120{{__('messege.minute')}}</option>

                                    </select>     
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker" id="student_home_time" class="student_home_time"  name="student_home_time[]">
                                        <option value="45" selected>45{{__('messege.minute')}}</option>
                                        <option value="60" >60{{__('messege.minute')}}</option>
                                        <option value="90" >90{{__('messege.minute')}}</option>
                                        <option value="120" >120{{__('messege.minute')}}</option>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker" id="online_time" class="online_time"  name="online_time[]">
                                        <option value="45" selected>45{{__('messege.minute')}}</option>
                                        <option value="60" >60{{__('messege.minute')}}</option>
                                        <option value="90" >90{{__('messege.minute')}}</option>
                                        <option value="120" >120</option>
                                    </select>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-price subject_add">{{__('messege.add_subject_button')}}  <img src="{{asset('/img/plus.svg')}}" alt="" id="add_subject_but"></div>

            </div>

           <div class="perofesinal_info">
                <p class="title">{{__('messege.professional_information')}}</p>
                <div class="grid-edu-exp">
                    <div class="form-group">
                        <label for="education">{{__('messege.select_education_title')}}</label>
                        <select class="selectpicker" id="education" data-live-search="true" name="education">         
                            <option value="0" selected>{{__('messege.choose')}}</option>
                            <?php
                                foreach($education as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $education  = $value->education_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $education  = $value->education_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $education  = $value->education_hy;
                                    } 
                                    
                                    echo "<option value='$value->id'>$education</option>";
                                }
                                    
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="professor_experience">{{__('messege.input_work_exp_title')}}</label>
                        <input type="text" name="professor_experience" id="professor_experience" placeholder="{{__('messege.input_work_exp_placeholder')}}" class="styled-inputtext" value="{{old('professor_experience')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="professor_about">{{__('messege.tell_about_yourself')}}</label>
                    <textarea name="professor_about" id="professor_about">{{old('professor_about')}}</textarea>
                </div>
                <div class="up-files">
                    <label for="upload" class="up-label">
                        <input type="file" id="upload"  multiple name="certificates[]">
                          {{__('messege.upload_certificate')}}  </label>
                </div>
                <div class="files">
                    <ul></ul>
                </div>
            </div>
            <div class="reg">
                <div class="grid-reg">
                    <div class="form-group">
                        <label for="professor_phone">{{__('messege.phonenumber')}}</label>
                        <input type="text" name="professor_phone" id="professor_phone" value="{{old('professor_phone')}}" class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('messege.email')}}</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_password">{{__('messege.password')}}</label>
                        <input type="password" name="password" id="professor_password"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_confpassword">{{__('messege.confirm_password')}}</label>
                        <input type="password" name="password_confirmation" id="professor_confpassword"  class="styled-inputtext">
                    </div>
                </div>
                <div class="col-12 pl-0 captcha">
                    {!! app('captcha')->display() !!}
                    <span class="invalid-feedback feedback_recaptcha" role="alert"></span>
                </div>
                <div class="form-group mt-4">
                        <input type="checkbox" name="agree" id="agree" class="styled-checkbox agree">
                        <label for="agree" class="checkbox_label"><a style="color:blue" href="/doc/hy/user_agreement.pdf" target="_blank">{{__('messege.i_agree')}}</a></label>
                    </div>
            </div>
            <input type="submit" class="reg-but" value="{{__('messege.reg_button')}}" />
        </form>
    </div>

</div>
</section>
<script src="{{asset('/js/main.js')}}"></script>
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
</script>
@endsection
