@extends('admin_layout')


@section('content')

<div style="height: auto;" class="mb-5 admin_section">
    <h3 class="admin_title">Ծանուցումներ</h3>
    <h4 class="admin_title">Ուղարկել բոլոր դասախոսներին <i class="fa fa-paper-plane send_all"  data-number="{{$id}}" data-subject="{{$subject_name->id}}"></i></h4>
    <br>
    <?php $c = 1 ?>
  <div class="">
      <div id="admin-teachers-profile">
          @foreach($teachers as $key => $value)
              <div class="carousel-item-lecturer">

                    <a href="/admin/dashboard/teachers/{{$value->user_id}}">
                      @if($value->img == null && $value->gender == 'female')
                          <img src="{{asset("/img/avatar_girl.svg")}}" alt="" class="lecturer-card-img">
                      @elseif($value->img == null && $value->gender == 'male')
                          <img src="{{asset("/img/avatar_man.svg")}}" alt="" class="lecturer-card-img">
                      @else
                          <img src="{{asset("/images/user_images/".$value->img)}}" alt="" class="lecturer-card-img">
                      @endif
                      <div class="lecturer-card-star mt-4">

                          <span class="Stars" style="--rating: {{(!empty($rates[$value->user_id]))?$rates[$value->user_id]->teacher_val:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                      </div>
                      <h5 class="my-3 text-center">{{$value->name}} {{$value->l_name}}</h5>
                      <h6 class="mb-0 text-center">Առարկա</h6>
                      <p class="subject_of_study text-center">{{$subject_name->subject_hy}}</p>
                      <br>
                      </a>
                      @if(!empty($notifications[$value->user_id]))
                          @if($notifications[$value->user_id]['response'] == 1)
                              <i class="fa fa-paper-plane send_teacher accepted_not" style="text-align:end" data-subject="{{$value->subject_id}}"  data-email="{{$value->email}}" data-number="{{$id}}" data-teacher="{{$value->user_id}}"></i>
                          @elseif($notifications[$value->user_id]['response'] == 2)
                              <i class="fa fa-paper-plane send_teacher" style="color:red;text-align:end" data-subject="{{$value->subject_id}}"  data-email="{{$value->email}}" data-number="{{$id}}" data-teacher="{{$value->user_id}}"></i>
                          @else
                              <i class="fa fa-paper-plane send_teacher" style="color:blue ;text-align:end" data-subject="{{$value->subject_id}}"  data-email="{{$value->email}}" data-number="{{$id}}" data-teacher="{{$value->user_id}}"></i>
                          @endif
                      @else
                          <i class="fa fa-paper-plane send_teacher" style="color:grey;text-align:end" data-subject="{{$value->subject_id}}"  data-email="{{$value->email}}" data-number="{{$id}}" data-teacher="{{$value->user_id}}"></i>
                  @endif
              </div>

              @endforeach

      </div>

      <div id="pagination-container"></div>
  </div>

</div>

<script>
    $(".fa-paper-plane").each(function(){
       if($(this).hasClass('accepted_not')){
          $(".fa-paper-plane").css({"pointer-events": "none","opacity":"0.5"}); 
       } 
    });
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