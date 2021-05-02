
@extends('layout')

@section('content')

<!-- ↓ blog page -->
<main id="blog-show">

    <div class="row container-fluid as-mx-width mx-auto px-0 blog-page-container mt-3">
        <h1>{{__('messege.blog_title')}}</h1>
        <button class="btn btn-primary collapse-btn" type="button" data-toggle="collapse" data-target="#BlogCollapsAside">></button>
        <div class="row mx-0 w-100 blog-content-container">
            <!-- ↓ side newsfeed  -->
            <aside id="BlogCollapsAside" class="collaps-blog-aside collapse dispose">
                        <h1 >{{__('messege.blog_title')}}</h1>
                        @foreach($sort_blogs as $key => $sort_blog)
                        <?php 
                                   if (app()->getLocale() == 'ru') {
                                        $description = $sort_blog->description_ru;
                                    } elseif (app()->getLocale() == 'en') {
                                        $description = $sort_blog->description_en;
                                    } elseif (app()->getLocale() == 'hy') {
                                        $description = $sort_blog->description_hy;
                                    } 
                        ?>
                        <div class="blog-newsfeed-card position-relative pb-5">
                            <a href="/{{app()->getLocale()}}/blog/{{$sort_blog->id}}">
                                <p>{{$description}}</p>
                            </a>
                            <?php 
                            if(!empty($sort_blog->created_at)){
                                $date = explode(" ",$sort_blog->created_at);
                                $date_final = explode("-",$date[0]);
                                $date_blog = $date_final[2].'-'.$date_final[1].'-'.$date_final[0];
                            }else{
                                
                                $date_blog = "";
                            }
                            ?>
                            <span class="blog-news-added-date">{{$date_blog}}</span> 
                            
                            
                        </div>
                        @endforeach

                    </aside>
            <!-- ↑ side newsfeed  -->
            <!-- ↓ blog cards  -->
            <section class="blog-content-main">
                <div class="row">
                    <div class="col-sm px-0">
                        <div class="carousel-item-blog p-0 show-blog-img" style="box-shadow:none;">
                            <img src="/images/blogs/{{$blogs->img}}" class="blog-show">


                        <?php
                        if (app()->getLocale() == 'ru') {
                            $month = ['1' => 'Январь', '2' => 'Февраль', '3' => 'Март', '4' => 'Апрель', '5' => 'Май', '6' => 'Июнь', '7' => 'Июль', '8' => 'Август', '9' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь',];
                            $description = $blogs->description_ru;
                            $title = $blogs->title_ru;
                        } elseif (app()->getLocale() == 'en') {
                            $month = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',];
                            $description = $blogs->description_en;
                            $title = $blogs->title_en;
                        } elseif (app()->getLocale() == 'hy') {
                            $month = ['1' => 'Հունվար', '2' => 'Փետրվար', '3' => 'Մարտ', '4' => 'Ապրիլ', '5' => 'Մայիս', '6' => 'Հունիս', '7' => 'Հուլիս', '8' => 'Օգոստոս', '9' => 'Սեպտեմբեր', '10' => 'Հոկտեմբեր', '11' => 'Նոյեմբեր', '12' => 'Դեկտեմբեր',];
                            $description = $blogs->description_hy;
                            $title = $blogs->title_hy;
                        }

                        $date = explode(" ", $blogs->created_at);
                        $date_final = explode("-", $date[0]);
                        $date_blog = $date_final[2] . ' ' . $month[$date_final[1]] . ' ' . $date_final[0];
                        ?>
                        <div class="date_blog mt-3 mb-1">{{$date_blog}}</div>
                        <div class="blog-card-content">
                            <h1 >{{$title}}</h1>
                            <p class="text-left mb-0">{{$description}}</p>
                        </div>
                        </a>
                    </img>
                </div>
                    </div>
            </section>
            <!-- ↑ blog cards  -->
        </div>

    </div>
</main>
<!-- ↑ blog page -->


@endsection