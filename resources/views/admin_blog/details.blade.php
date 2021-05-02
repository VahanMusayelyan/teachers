@extends('admin_layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#blog_link').addClass('active');
</script>
<div >
   
    <div class="container-admin mb-5 admin_section">
        <!-- Blog -->
        <h3 class="admin_title">Բլոգ</h3>
        <div class="form-horizontal" id="myform7_2">
            <fieldset>
                <img class="detailImg " src='/images/blogs/<?=$result['img']?>'>
                <div class="blog-grid">
                    
                    <div class="blog-card-content">
                        <h6 class="text-left mb-4"><?=$result['title_hy']?></h6>
                        <p  class="text-left mb-0"><?=$result['description_hy']?></p></div>
                    <div class="blog-card-content">
                        <h6 class="text-left mb-4"><?=$result['title_ru']?></h6>
                    <p  class="text-left mb-0"><?=$result['description_ru']?></p></div>
                   <div class="blog-card-content">
                       <h6 class="text-left mb-4"><?=$result['title_en']?></h6>
                    <p  class="text-left mb-0"><?=$result['description_en']?></p></div>
                </div>
               
            </fieldset>
             <a class='editblog btn btn-info' href='/admin/dashboard/blogs/<?=$result['id']?>/edit'>Փոփոխել</a>
            {{--<a class=" blog-btn as-btn" href="/admin/dashboard/blogs">Հետ</a>--}}
            
        </div>
    </div>
</div>

@endsection