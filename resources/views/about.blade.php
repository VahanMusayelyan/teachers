@extends('layout')

@section('content')

<section id="about-us">
    <div class="as-mx-width">
        <h1 >{{__('messege.about_title')}}</h1>
        <div class="about">
            <img src="/img/{{$about_img->value}}" alt="" class="about-img">
        </div>
        <p class="about-text"><?php  echo __('messege.about_text'); ?></p>
    </div>


</section>


        @endsection