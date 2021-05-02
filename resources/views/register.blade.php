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

    @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section id="reg-professor">
    <div class="as-mx-width">
        <div class="title">
            <h1 >Դասախոսի գրանցում</h1>
        </div>

        <form action="{{ route('register',app()->getLocale())}}" method="POST" class="reg-form" enctype="multipart/form-data">
            @csrf
            <div class="pers_inf"> 
                <div class="inf-grid">
                    <div>
                        <p class="title">Անձնական տվյալներ</p>
                        <div class="up_img">
                            <div class="logoContainer">
                                <img src="{{asset('/img/Avatar2.svg')}}">
                            </div>
                            <div class="fileContainer sprite">
                                <span>Ներբեռնել լուսանկար</span>
                                <input type="file" name="professor_img" id="professor_img">
                            </div>
                        </div>
                        <div class="gender">
                            <label>Սեռ</label>
                            <div class="form-group">
                                <input type="radio" name="gender" value="male" id="men">
                                <label for="men">Արական</label>
                                <input type="radio" name="gender" value="female" id="women">
                                <label for="women">Իգական</label>
                            </div>

                        </div>
                    </div>
                    <div class="inp-grid">
                        <div class="form-group">
                            <label for="professor_name">Անուն</label>
                            <input type="text" name="name" id="professor_name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="professor_fathername">Հայրանուն</label>
                            <input type="text" name="professor_fathername" id="professor_fathername" value="{{ old('professor_fathername') }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Երկիր</label>
                            <select class="selectpicker" data-live-search="true" name="country">
<!--                                <option value="" selected></option>-->
                                <?php 
                                foreach($countries as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $country  = $value->country_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $country  = $value->country_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $country  = $value->country_hy;
                                    } 
                                    
                                    echo "<option value='$value->id' selected>$country</option>";
                                }
                                    
                                ?>

                            </select>
                        </div>
                        <div class="form-group city_group">
                            <label for="city">Քաղաք</label>
                            <select class="selectpicker" data-live-search="true" name="city" id="city">  

                            </select>
                        </div>
                    </div>
                    <div class="inp-grid">
                        <div class="form-group">
                            <label for="professor_lname">Ազգանուն</label>
                            <input type="text" name="professor_lname" id="professor_lname" value="{{ old('professor_lname') }}">
                        </div>
                        <div class="form-group">
                            <label for="birth">Ծննդյան ամսաթիվ</label>
                            <input type="text" id="datepicker" name="birth_date"/>
                            {{--<input type="date" name="birth_date"  lang="fr-CA" id="">--}}
                        </div>
                        <div class="form-group">
                            @csrf
                            <label for="region">Մարզ</label>
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
                                    
                                    echo "<option value='$value->id'>$region</option>";
                                }
                                    
                                ?>
                            </select>                      
                        </div>
                        <div class="form-group">
                            <label for="professor_address">Հասցե</label>
                            <input type="text" name="professor_address" id="professor_address" value="{{ old('professor_address') }}">
                        </div>
                    </div>

                </div>
                <div class="pers_map">
                    <div class="row map-row">
                        <div class="teacher-map">
                            <div id="map" style="width:100%; height:236px;border-radius:30px;"></div>
                            @if(!empty(old('professor_address')))
                                <input type="hidden" id="location" name="location" value="{{old('professor_address')}}"/>
                            @else
                                <input type="hidden" id="location" name="location" value="40.177200,44.503490"/>
                            @endif
                        </div>
                    </div>
                </div>

            </div> 
            <div class="who-chackebox">
                <div class="title">  Ո՞ւմ հետ եք պատրաստ պարապել</div>
                <div class="checkboxs">
                    <div class="form-group">
                        <input type="checkbox" name="pupil" id="pupil" class="styled-checkbox">
                        <label for="pupil" class="checkbox_label">Դպրոցական</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="student" id="student" class="styled-checkbox">
                        <label for="student" class="checkbox_label">Ուսանող</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="adult" id="adulthood" class="styled-checkbox">
                        <label for="adulthood" class="checkbox_label">Մեծահասակ</label>

                    </div>
                </div>
            </div>

            <div class="lessons_price">
                <div class="title">Դասավանդվող առարկաներ և դասի արժեքը</div>
                <div class="add_subject">
                    <div class="form-group sub-select">
                        <label for="subject">Դասավանդվող առարկաներ</label>
                        <select class="selectpicker" data-live-search="true" name="subject[]">
                            <option value="" selected>Առարկաներ</option>
                             <?php 
                                foreach($subjects as $key => $value){
                                   if (app()->getLocale() == 'ru') {
                                        $country  = $value->subject_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                         $country  = $value->subject_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                         $country  = $value->subject_hy;
                                    } 
                                    
                                    echo "<option value='$value->id'>$country</option>";
                                }
                                    
                                ?>
                        </select>                      
                    </div>
                    <div class="title-price">1 դասի արժեքը և տևողությունը</div>
                    <div class="grid-price">
                        <div> 
                            <div class="checkboxs">
                                <h3 class="mini-title">Վայրը</h3>
                                <div class="form-group">
                                    <input type="checkbox" name="professor_home[]" id="professor_home" class="styled-checkbox">
                                    <label for="professor_home" class="checkbox_label">Դասավանդողի մոտ</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="student_home[]" id="student_home" class="styled-checkbox">
                                    <label for="student_home" class="checkbox_label">Ուսանողի մոտ</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="online_home[]" id="online" class="styled-checkbox">
                                    <label for="online" class="checkbox_label">Հեռակա</label>

                                </div>
                            </div>
                        </div>
                        <div> 
                            <div class="inputs">
                                <h3 class="mini-title">Դասի արժեքը</h3>
                                <div class="form-group">
                                    <input type="text" name="professor_home_price[]" id="professor_home" class="styled-inputtext" placeholder="Նշեք գումարի չափը">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="student_home_price[]" id="student_home" class="styled-inputtext" placeholder="Նշեք գումարի չափը">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="online_price[]" id="online" class="styled-inputtext" placeholder="Նշեք գումարի չափը">

                                </div>
                            </div>
                        </div>

                        <div > 
                            <div class="selectss">
                                <h3 class="mini-title">Տևողությունը</h3>
                                <div class="form-group">
                                    <select class="selectpicker"  name="professor_home_time[]">
                                                <option value="45" selected>45ր</option>
						<option value="60" >60ր</option>
						<option value="90" >90ր</option>
						<option value="120" >120ր</option>
                                    </select>     
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker"  name="student_home_time[]">
                                                <option value="45" selected>45ր</option>
						<option value="60" >60ր</option>
						<option value="90" >90ր</option>
						<option value="120" >120ր</option>
                                    </select>   
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker"  name="online_time[]">
                                                <option value="45" selected>45ր</option>
						<option value="60" >60ր</option>
						<option value="90" >90ր</option>
						<option value="120" >120ր</option>
                                    </select>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-price subject_add">Ավելացնել առարկա  <img src="{{asset('/img/plus.svg')}}" alt="" id="add_subject_but"></div>

            </div>

            <div class="perofesinal_info">
                <p class="title">Մասնագիտական ​​տեղեկատվություն</p>
                <div class="grid-edu-exp">
                    <div class="form-group">
                        <label for="education">Կրթություն</label>
                        <select class="selectpicker" data-live-search="true" name="education">         
                            <option value="" selected></option>
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
                        <label for="professor_experience">Դասավանդման փորձ (քանի տարի)</label>
                        <input type="text" name="professor_experience" id="professor_experience" placeholder="Աշխատանքային փորձ" class="styled-inputtext" value="{{old('professor_experience')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="professor_about">Պատմեք ձեր մասին, դասավանդման մեթոդաբանությունը, ուսանողների արդյունքները</label>
                    <textarea name="professor_about" id="professor_about">{{old('professor_about')}}</textarea>
                </div>
                <div class="up-files">
                    <label for="upload" class="up-label">
                        <input type="file" id="upload"  multiple name="certificates[]">
                        Ներբեռնել դիպլոմ/սերտիֆիկատ                </label>
                </div>
                <div class="files">
                    <ul></ul>
                </div>
            </div> 
            <div class="reg">
                <div class="grid-reg">
                    <div class="form-group">
                        <label for="professor_phone">Հեռախոսահամար</label>
                        <input type="text" name="professor_phone" id="professor_phone" value="{{old('professor_phone')}}" class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="email">Էլ.հասցե</label>
                        <input type="email" name="email_r" id="email" value="{{old('email')}}"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_password">Գաղտնաբառ</label>
                        <input type="password" name="password" id="professor_password"  class="styled-inputtext">
                    </div>
                    <div class="form-group">
                        <label for="professor_confpassword">Կրկնել գաղտնաբառը</label>
                        <input type="password" name="password_confirmation" id="professor_confpassword"  class="styled-inputtext">
                    </div>
                </div>

            </div>
            <input type="submit" class="reg-but" value="Գրանցվել" />
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
</script>
@endsection
