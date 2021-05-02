
@extends('layout')

@section('content')


    <section id="feedback" style="background-image: url(/img/{{$background->value}});">
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
        
        <div class="as-mx-width">
            <h1 >{{__('messege.menu_contact')}}</h1>
           
 
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
            <div class="feed_back">
                @if (session('success'))
                    <div class="alert_success">
                      <div>  <img src="/img/x.svg" alt="" class="close-message" style="cursor: pointer"></div>
                        <h5 class="feedback-message">{{__('messege.letter_send')}}</h5>

                    </div>
                @endif
                <form action="{{route('contact',app()->getLocale())}}" method="post" class="contactus_form_comp">
                     {!! NoCaptcha::renderJs() !!}
                    @csrf
                    <div class="big-grid">
                        <div class="small-grid">
                            <div class="form-group">
                                <label for="name">{{__('messege.teach_name')}}</label>
                                <input type="text" name="name" id="name" class="styled-inputtext">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('messege.email')}}</label>
                                <input type="email" name="email" id="email"  class="styled-inputtext">
                            </div>                             
                        </div>
                        <div class="small-grid">
                            <div class="form-group">
                                <label for="lname">{{__('messege.teach_lastname')}}</label>
                                <input type="text" name="l_name" id="lname" class="styled-inputtext">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{__('messege.phonenumber')}}</label>
                                <input type="text" name="phone" id="phone_u" class="styled-inputtext">
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="message">{{__('messege.your_letter')}}</label>
                                <textarea name="letter" id="message" class="styled-inputtext"></textarea>
                                </div>
                           
                        </div>
                    </div>
                           <div class="col-12 pl-0 captcha">
                                {!! app('captcha')->display() !!}
                                <span class="invalid-feedback feedback_recaptcha" role="alert"></span>
                            </div>
                    <button type="submit" class="btn-feedback">{{__('messege.send_button')}}</button>
                </form>
            </div>
        </div>
    </section>

    <script>

        $('.close-message').click(function () {
            $(this).parent().parent().css('display','none');

        })
    </script>
        @endsection