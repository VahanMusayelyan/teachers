@extends('layout')

@section('content')
<section id="kap_hastatel" class="reset_pass">

    <div class="as-mx-width">

        <div class="kap-hastatel-form">

            <form action="{{route('resetpassword',app()->getLocale())}}" method="POST">
                @csrf
                <div  class="title">
                    <h3>{{__('messege.reset_password')}}</h3>

                </div>

                <div class="form-group">
                    <label for="flname">{{__('messege.email')}}</label>
                    <input type="text" name="email_reset" id="flname" class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="phone">{{__('messege.new_pass')}}</label>
                    <input type="password" name="password_reset" id="phone" class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="phone">{{__('messege.confirm_password')}}</label>
                    <input type="password" name="repeat_password_reset" id="phone" class="styled-inputtext">
                </div>
                <input name="link" value="{{ Request::segment(3) }}" hidden>
                <button type="submit" class="btn-kap-hastatel">{{__('messege.change_password')}}</button>

            </form>
        </div>
    </div>

</section>
</div>



@endsection