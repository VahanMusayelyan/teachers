@extends('layout')

@section('content')

<section id="teacher_account" style="min-height: 70vh;">
    <div class="as-mx-width">
        <div id="notification">

            <div class="message list-wrapper">

                @if(count($notifications) > 0)

                @foreach($notifications as $value)
                
                <div class="message-back message-item  list-item">
                    <div class="contact">
                        <div class="sub-title">

                            <h2 >{{__('messege.contact_info')}}</h2>

                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.name')}}  {{__('messege.lastname')}} </label>
                            @if(!empty($value['name']))
                            <p class="bold-text">{{$value['name']}}</p>
                            @else
                            <p class="bold-text">{{$value['name_lname']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.email')}}</label>
                            @if(!empty($value['email']))
                                @if($value['response'] == 3)
                                <p class="bold-text">***********</p>
                                @else
                                <p class="bold-text">{{$value['email']}}</p>
                                @endif
                            @else
                            <p class="bold-text"><img src="/img/minus.svg"></p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.phonenumber')}}</label>
                            @if($value['response'] == 3)
                            <p class="bold-text">*********</p>
                            @else
                                @if(!empty($value['phone']))
                                <p class="bold-text">{{$value['phone']}}</p>
                                @else
                                <p class="bold-text">{{$value['phoneNumb']}}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="description">
                        <h5 class="sub-title">{{__('messege.teacher_description')}}</h5>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.subject')}}</label>
                            <?php 
                            if (app()->getLocale() == 'ru') {
                                $subject = $value['subject_ru'];
                                $sub = 'subject_ru';
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $value['subject_en'];
                                $sub = 'subject_en';
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $value['subject_hy'];
                                $sub = 'subject_hy';
                            }
                            ?>
                            @if(!empty($subject))
                            <p class="bold-text">{{$subject}}</p>
                            @else
                            <p class="bold-text">{{$subjects[$value['subjectId']][$sub]}}</p>
                            @endif
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.gender')}}</label>
                            @if($value['gender_female'] == "on" && $value['gender_male'] == null)
                            <p class="bold-text">{{__('messege.checkbox_female')}}</p>
                            @elseif($value['gender_male'] == "on" && $value['gender_female'] == null)
                            <p class="bold-text">{{__('messege.checkbox_male')}}</p>
                            @elseif(!empty($value['gender_male']) && !empty($value['gender_female'])) 
                            <p class="bold-text">{{__('messege.checkbox_female')}},{{__('messege.checkbox_male')}}</p>
                            @else
                            <p class="bold-text"><img src="/img/minus.svg"></p>
                            @endif
                        </div>




                        <div class="form-group">
                            <label for="" class="ligth-text">{{__('messege.work_experience')}}</label>
                            @if(!empty($value['exp_min'])  && empty($value['exp_med']) && empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.checkbox_up_to_5')}}</p>
                            @elseif(empty($value['exp_min'])  && !empty($value['exp_med']) && empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.checkbox_5_to_10')}}</p>
                            @elseif(empty($value['exp_min'])  && empty($value['exp_med']) && !empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.checkbox_more_than_10')}}</p>
                            @elseif(!empty($value['exp_min'])  && !empty($value['exp_med']) && empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.1_to_10')}}</p>
                            @elseif(!empty($value['exp_min'])  && empty($value['exp_med']) && !empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.1_to5_and_more_10')}}</p>
                            @elseif(empty($value['exp_min'])  && !empty($value['exp_med']) && !empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.more_5')}}</p>
                            @elseif(empty($value['exp_min'])  && empty($value['exp_med']) && empty($value['exp_max']))
                                <p class="bold-text"><img src="/img/minus.svg"></p>
                            @elseif(!empty($value['exp_min'])  && !empty($value['exp_med']) && !empty($value['exp_max']))
                                <p class="bold-text">{{__('messege.more_1')}}</p>
                            @endif
                        </div>



                    </div>
                    <div class="price">
                        <h5 class="sub-title">{{__('messege.other_info')}}</h5>
                        <fieldset class="filter-price">
                            <div class="form-group">

                                <label for="" class="ligth-text">{{__('messege.format')}}</label>
                                @if(!empty($value['loc_proffes'])  && empty($value['loc_student']) && empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}</p>
                                @elseif(empty($value['loc_proffes'])  && !empty($value['loc_student']) && empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_student')}}</p>
                                @elseif(empty($value['loc_proffes'])  && empty($value['loc_student']) && !empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_remotely')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && !empty($value['loc_student']) && empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_at_the_student')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && empty($value['loc_student']) && !empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(empty($value['loc_proffes'])  && !empty($value['loc_student']) && !empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_student')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(!empty($value['loc_proffes'])  && !empty($value['loc_student']) && !empty($value['loc_online']))
                                    <p class="bold-text">{{__('messege.checkbox_at_the_teacher')}}, {{__('messege.checkbox_at_the_student')}}, {{__('messege.checkbox_remotely')}}</p>
                                @elseif(empty($value['loc_proffes'])  && empty($value['loc_student']) && empty($value['loc_online']))
                                    <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif
                            </div>


                            <div class="form-group">
                                <p class="ligth-text">   {{__('messege.applicant')}}  </p>
                                @if(!empty($value['pupil'])  && empty($value['student']) && empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_pupil')}}</p>
                                @elseif(empty($value['pupil'])  && !empty($value['student']) && empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_student')}}</p>
                                @elseif(empty($value['pupil'])  && empty($value['student']) && !empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_adult')}}</p>
                                @elseif(!empty($value['pupil'])  && !empty($value['student']) && empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_pupil')}},  {{__('messege.checkbox_student')}}</p>
                                @elseif(!empty($value['pupil'])  && empty($value['student']) && !empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_pupil')}} ,  {{__('messege.checkbox_adult')}}</p>
                                @elseif(empty($value['pupil'])  && !empty($value['student']) && !empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_student')}},  {{__('messege.checkbox_adult')}}</p>
                                @elseif(!empty($value['pupil'])  && !empty($value['student']) && !empty($value['adult']))
                                    <p class="bold-text"> {{__('messege.checkbox_pupil')}}, {{__('messege.checkbox_student')}} , {{__('messege.checkbox_adult')}} </p>
                                @elseif(empty($value['pupil'])  && empty($value['student']) && empty($value['adult']))
                                    <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="" class="ligth-text">{{__('messege.price_range')}}</label>
                                @if(!empty($value['price_min']))
                                    <p class="bold-text"> {{number_format($value['price_min'],0)}} - {{number_format($value['price_max'],0)}}</p>
                                @else
                                    <p class="bold-text"><img src="/img/minus.svg"></p>
                                @endif
                            </div>
                        </fieldset>
                        <div class="notification_mess">
                            @if($value['response'] == 3)
                            <span class="late_not">{{__('messege.request_other')}}</span>
                            <button class="archive_page" data-number="{{$value['id']}}">{{__('messege.archive_button')}}</button>
                            @elseif($value['response'] == 4)
                            <span class="late_not">{{__('messege.request_other')}}</span>
                            @elseif($value['response'] == 2)
                            <span class="late_not">{{__('messege.request_ignor')}}</span>
                            @elseif($value['response'] == 1)
                            <span class="accept_not_span">{{__('messege.request_approved')}}</span>
                            @else
                            <button class="as-btn-y mt-4 accept_decline accept_not" data-number="{{$value['notId']}}" data-suggest="{{$value['suggest_id']}}"  data-contact="{{$value['contact_id']}}">{{__('messege.accept_button')}}</button>
                            <button class="as-btn-r mt-4 accept_decline decline_not"  data-number="{{$value['notId']}}" data-suggest="{{$value['suggest_id']}}"  data-contact="{{$value['contact_id']}}">{{__('messege.ignor_button')}}</button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <h5 class="pb-5">{{__('messege.not_request')}}</h5>
                @endif
            </div>
            @if(count($notifications)>4)
            <div id="pagination-container">
            </div>
            @endif
        </div>
    </div>
</section>

<script>
    // jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
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



@endsection