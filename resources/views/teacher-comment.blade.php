@extends('layout')

@section('content')
<section id="comments_page" class="mt-3">
    <div class="as-mx-width ">
        <h1> {{__('messege.comments')}} <a class="comment_name" href="/{{app()->getLocale()}}/teacher/{{$user['id']}}">{{$user['name']}} {{$user['l_name']}}</a></h1>
        <div class="blocks ">

            @foreach($comment as $key => $value)
                <div class="comment_block">
                    <img src="/img/comment_avatar.svg" alt="">
                    <div class="comment">
                        <div class="name-star">
                            <div  class="user-name">
                                <h3>{{$value->name}} {{$value->l_name}}</h3>

                            </div>
                            <div class="star"><span class="Stars" style="--rating: {{(!empty($value->avg_value))?$value->avg_value:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span></div>
                        </div>
                        <p class="text">{{$value->comment}}</p>
                        <p class="show-more"> {{__('messege.see_more_button')}} <img src="/img/Down.svg" alt=""></p>
                    </div>
                </div>
            @endforeach
           
            
            <div id="pagination-container">
            {{ $comment->links('vendor.pagination.custom') }}
            </div>
        </div>

    </div>

</section>


@endsection