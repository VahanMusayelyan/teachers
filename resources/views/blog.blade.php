
@extends('layout')

@section('content')

        <!-- ↓ blog page -->
        <main>
            <div class="row container-fluid as-mx-width mx-auto px-0 blog-page-container">
                <h1 >{{__('messege.menu_blog')}}
                    <button class="btn btn-primary collapse-btn ml-2 blog-rotate-btn" type="button" data-toggle="collapse" data-target="#BlogCollapsAside">
                        <img src="/img/Down.svg" alt="">
                    </button></h1>

                <div class="row mx-0 w-100 blog-content-container">
                    <!-- ↓ side newsfeed  -->
                    <aside id="BlogCollapsAside" class="collaps-blog-aside collapse dispose">
                        <!-- <h5 class="w-100 text-center">Բլոգ</h5> -->
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
                      <div class="blog-grid">
                          <?php $count = 1 ?>
                          @foreach($blogs as $key => $blog)
                              <?php
                              if (app()->getLocale() == 'ru') {
                                  $title = $blog->title_ru;
                                  $description = $blog->description_ru;
                              } elseif (app()->getLocale() == 'en') {
                                  $title = $blog->title_en;
                                  $description = $blog->description_en;
                              } elseif (app()->getLocale() == 'hy') {
                                  $title = $blog->title_hy;
                                  $description = $blog->description_hy;
                              }
                              ?>

                                  <div class="col-sm px-0">
                                      <a href="/{{app()->getLocale()}}/blog/{{$blog->id}}">
                                          <div class="carousel-item-blog p-0">
                                              <div class="img-overflow-hdn">
                                                  <div class="blog-card-img ">
                                                      <img src="/images/blogs/{{$blog->img}}" alt="" class="blog-img">
                                                      <div class="img-filter">
                                                          <span class="blog-read-more">{{__('messege.read_more')}}</span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="blog-card-content blog-card-content-padding">
                                                  <div class="text-left mb-4">
                                                      <h3 >{{$title}}</h3>

                                                  </div>
                                                  <p class="text-left mb-0 blog-text">{{substr($description,0,500)}}</p>
                                              </div>
                                          </div>
                                      </a>
                                  </div>
                              <?php $count = 0 ?>

                              <?php $count ++ ?>
                          @endforeach
                      </div>
                        
                        
                    <!-- ↓ pagination -->
                   @if(count($blogs)>8)
                    <div id="pagination-container">
                      
                      {{ $blogs->links('vendor.pagination.custom') }}
          
                     
                      </div>
                   @endif
              <!-- ↑ pagination -->
                    </section>
                    <!-- ↑ blog cards  -->
                </div>
               
            </div>
        </main>
        <!-- ↑ blog page -->
<script>
    $('.blog-rotate-btn').click(function(){
        if($(this).hasClass('active_blog')){
            $(this).css('transform','rotateX(0deg)');
            $(this).removeClass('active_blog');
            $('.blog-content-main .blog-grid').css('grid-template-columns',"45% 45%")
        }else{
            $(this).css('transform','rotateX(160deg)');
            $(this).addClass('active_blog');
            $('.blog-content-main .blog-grid').css('grid-template-columns',"90%")

        }
    })
</script>

            @endsection