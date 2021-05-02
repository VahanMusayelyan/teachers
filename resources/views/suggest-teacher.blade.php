@extends('layout')

@section('content')
    <section id="select_professor">
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
        
        <div class="as-mx-width text-center">
             @if (session('success'))
                    <div class="alert_success">
                      <div>  <img src="/img/x.svg" alt="" class="close-message" style="cursor: pointer"></div>
                        <h5 class="feedback-message">{{__('messege.your_request_send')}}</h5>
                    </div>
            @endif
            <h1>{{__('messege.teacher_selet_title')}}</h1>
            <p class="sub-title">{{__('messege.teacher_selet_text')}}</p>
                <form action="{{route('suggest_teacher',app()->getLocale())}}" method="post" class="select-form">
                    @csrf
                    <div class="select-prof-form">
                        <div class="form-title">
                            <h3 >{{__('messege.contact_info')}}</h3>

                        </div>

                    <div class="your-contacts">
                        <div class="form-group">
                            <label for="your_name">{{__('messege.your_name')}}</label>
                            <input type="text" name="your_name" id="your_name" class="styled-inputtext">
                            </div>
                            <div class="form-group">
                                <label for="your_email">{{__('messege.email')}}</label>
                                <input type="email" name="your_email" id="your_email"  class="styled-inputtext">
                                </div>
                                <div class="form-group">
                                    <label for="your_phone">{{__('messege.phonenumber')}}</label>
                                    <input type="text" name="your_phone" id="your_phone" class="styled-inputtext">
                                    </div> 
                                    <div class="sub-select">
                                        <!-- <label for="subject"></label> -->
                                        <select class="selectpicker" data-live-search="true" name="subject">
                                            <option value="" selected>{{__('messege.subject')}}</option>
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
                                    </div>                            
                    </div>
                        <div class="form-title">
                            <h3 >{{__('messege.teacher_description')}}</h3>

                        </div>
                    <div class="prof-checkboxs">
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.gender')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="men" id="men"
                                            class="styled-checkbox">
                                        <label for="men" class="checkbox_label">{{__('messege.checkbox_male')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="women" id="women"
                                            class="styled-checkbox">
                                        <label for="women" class="checkbox_label">{{__('messege.checkbox_female')}}</label>
                                    </div>
                            </div>


                        </div>
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.input_work_exp_placeholder')}}</h3>

                            </div>
                                <div class="checkboxs">
                                    <div class="form-group">
                                        <input type="checkbox" name="minimum" id="minimum"
                                            class="styled-checkbox">
                                        <label for="minimum" class="checkbox_label">{{__('messege.checkbox_up_to_5')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="medium" id="medium"
                                            class="styled-checkbox">
                                        <label for="medium" class="checkbox_label">{{__('messege.checkbox_5_to_10')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="maximum" id="maximum" class="styled-checkbox">
                                        <label for="maximum" class="checkbox_label">{{__('messege.checkbox_more_than_10')}}</label>
    
                                    </div>
                                
                            </div>


                        </div>
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.format')}}</h3>

                            </div>
                            <div class="checkboxs">
                                <div class="form-group">
                                    <input type="checkbox" name="professor_home" id="professor_home"
                                        class="styled-checkbox">
                                    <label for="professor_home" class="checkbox_label">{{__('messege.checkbox_at_the_teacher')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="student_home" id="student_home"
                                        class="styled-checkbox">
                                    <label for="student_home" class="checkbox_label">{{__('messege.checkbox_at_the_student')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="online" id="online" class="styled-checkbox">
                                    <label for="online" class="checkbox_label">{{__('messege.checkbox_remotely')}}</label>
    
                                </div>
                            </div>
                        </div>
                        <div class="all-checkboxs">
                            <div class="mini-title">
                                <h3 >{{__('messege.you')}}</h3>

                            </div>
                            <div class="checkboxs">
                                <div class="form-group">
                                    <input type="checkbox" name="pupil" id="pupil"
                                        class="styled-checkbox">
                                    <label for="pupil" class="checkbox_label">{{__('messege.checkbox_pupil')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="student" id="student"
                                        class="styled-checkbox">
                                    <label for="student" class="checkbox_label">{{__('messege.checkbox_student')}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="adult" id="adulthood" class="styled-checkbox">
                                    <label for="adulthood" class="checkbox_label">{{__('messege.checkbox_adult')}}</label>
    
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-title">
                            <h3 >{{__('messege.hour_price')}}</h3>

                        </div>
                    <div class="price">
                    <fieldset class="filter-price">
                        <div class="price-wrap">
                            <div class="price-wrap-1">
                              <input id="one">
                              <label for="one"></label>
                            </div>
                            <div class="price-wrap-2">
                              <input id="two">
                              <label for="two"><img src="img/dram.svg" alt=""></label>
                            </div>
                          </div>

                        <div class="price-field">
                          <input type="range" name="min_price"  min="1000" max="50000" value="1000" id="lower">
                          <input type="range" name="max_price" min="1000" max="50000" value="50000" id="upper">
                        </div>
                         
                    </fieldset> 
                </div>
            </div>

                    <button type="submit" class="btn-select-prof">{{__('messege.send_button')}}</button>
                </form>

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


$('.close-message').click(function(){
    $(this).parent().parent().hide();
})
</script>

        @endsection