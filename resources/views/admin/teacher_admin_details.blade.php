@extends('admin_layout')


@section('content')
<style>
    .inp_update{
        width: 150px;
    }
    
    .reg-but{
        background: transparent linear-gradient(
100deg
,#ffc500 0,#ff4a51 100%) 0 0 no-repeat padding-box;
    border-radius: 10px;
    padding: 5px 10px;
    width: 150px;
    border: 0;
    display: grid;
    justify-content: center;
    margin: 0 auto;
    margin-bottom: 50px;
    font-size: 16px;
    line-height: 27px;
    font-family: Segoe_UI-regular;
    letter-spacing: 0;
    color: #fff;
    cursor: pointer;
    margin-top: 15px;
    }

</style>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<section id="information" class="mb-5 admin_section"  >
    <div class="container">
        <div class="row">
            <div class="col-md-8"><h3 class="title admin_title">Տեղեկատվություն</h3></div>
        </div>
        <div class="info-grid no-grid">
            <div  class="info-block">
                <section id="texekatvutyun" class="prof-card texekatvutyun">
                    <div class="card-img">
                        @if($teacher->img == null && $teacher->gender == 'female')
                        <img src="{{asset("/img/avatar_girl.svg")}}" alt="">
                        @elseif($teacher->img == null && $teacher->gender == 'male')
                        <img src="{{asset("/img/avatar_man.svg")}}" alt="">
                        @else
                        <img src="{{asset("/images/user_images/".$teacher->img)}}" alt="">
                        @endif
                        <div class="stars">
                            <span class="star_ratem">
                                <span class="Stars" style="--rating: {{(!empty($rate))?$rate:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span>
                                @if(!empty($rate_count))
                                <span>({{$rate_count}})</span>
                                @else
                                <span> (0)</span>
                                @endif()
                            </span>
                        </div>
                    </div>
                    <div class="card-info">
                        <h3 class="f_l_name">{{$teacher->name}} {{$teacher->l_name}}</h3>
                        <p class="bold-text"></p>
                        <div class="grid-info">
                            <p class="ligth-text">Քաղաք</p>
                            <p class="bold-text">{{$teacher->city_hy}}</p>
                            <p class="ligth-text">Տարիք</p>
                            <p class="bold-text">{{Carbon\Carbon::parse($teacher->b_day)->age}} տարեկան</p>
                            <p class="ligth-text">Աշխատանքային փորձ</p>
                            <p class="bold-text">{{round($teacher->work_exp)}} տարի</p>
                            <p class="ligth-text">Կրթություն</p>
                            <div class="boldtext">
                                <p class="more-info-text show-more-height ">{{$teacher->univers_hy}}</p>
                            </div>
                        </div>
                        <p class="with-people"> <img src="/img/Friend.svg" alt="">
                            <?php
                            $sphere = [];
                            foreach ($subjects as $key => $sub) {
                                if ($sub['location_user'] != 'on') {
                                    $location_user = 'Չի գործում';
                                }

                                if ($sub['location_student'] != 'on') {
                                    $location_student = 'Չի գործում';
                                }

                                if ($sub['location_online'] != 'on') {
                                    $location_student = 'Չի գործում';
                                }
                                $sphere = [];
                                if ($sub['pupil'] == 1) {
                                    $sphere['pupil'] = 'դպրոցական';
                                }
                                if ($sub['student'] == 1) {
                                    $sphere['student'] = 'ուսանող';
                                }

                                if ($sub['adult'] == 1) {
                                    $sphere['adult'] = 'մեծահասակ';
                                }
                            }
                            echo "<span>" . implode(", ", $sphere) . "</span>";
                            ?>
                        </p>
                    </div>
                </section>
                 <form action="" method="POST">
                        @csrf
                <section id="ararkaner" class="ararkaner">
                   
                    <h3 class="title">Առարկաներ</h3>
                    <table class="lesson-table">
                        <thead>
                        <th>Առարկաներ</th>
                        <th>Դասավանդողի մոտ </th>
                        <th>Ուսանողի մոտ </th>
                        <th>Հեռակա </th>
                        </thead>
                        <tbody>
                            @foreach($subjects as $key => $sub)
                            <?php
                            
                            if (app()->getLocale() == 'ru') {
                                $subject = $sub['subject_ru'];
                            } elseif (app()->getLocale() == 'en') {
                                $subject = $sub['subject_en'];
                            } elseif (app()->getLocale() == 'hy') {
                                $subject = $sub['subject_hy'];
                            }
                            ?>
                            <tr>
                                <td>{{$subject}}</td>
                                 <input type="hidden" value="{{$sub['priceListsId']}}" name="number[]">
                                @if($sub['price_user'] != null)
                                <td>Սկսած <input class="styled-inputtext inp_update" name="price_user[]" value="{{number_format($sub['price_user'])}}" autocomplete="off"> <img src="/img/dram.svg" alt=""> /{{$sub['duration_user']}} </td>
                                @else
                                <td><hr class="line-minus"><input name="price_user[]" value="" type="hidden"></td>
                                @endif

                                @if($sub['price_student'] != null)
                                <td>Սկսած <input class="styled-inputtext inp_update" name="price_student[]" value="{{number_format($sub['price_student'])}}" autocomplete="off"> <img src="/img/dram.svg" alt=""> /{{$sub['duration_student']}} </td>
                                @else
                                <td><hr class="line-minus"><input name="price_student[]" value="" type="hidden"></td>
                                @endif

                                @if($sub['price_online'] != null)
                                <td>Սկսած <input class="styled-inputtext inp_update" name="price_online[]" value="{{number_format($sub['price_online'])}}" autocomplete="off"> <img src="/img/dram.svg" alt=""> /{{$sub['duration_online']}} </td>
                                @else
                                <td><hr class="line-minus"><input name="price_online[]" value="" type="hidden"></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                        
                </section>
                <div class="more-info">
                    <h5 class="more-info-title">Lրացուցիչ տեղեկություն</h5>
                  
                    <input type="hidden" value="{{$teacher->userId}}" name="user">
                    <textarea style="width:100%" rows="8" name="description">
                        {{$teacher->description}}
                    </textarea>
                   
                </div>
                <input type="submit" class="reg-but" value="Թարմացնել">
                     </form>
                <section id="meknabanutyun" class="meknabanutyun">

                    <h3 class="title">Մեկնաբանություններ</h3>

                    <div class="comments">
                        @if(count($comments)>0)
                        @foreach($comments as $key => $comment)
                        <div class="comment-card">
                            <div class="inner-card">
                                <img src="/img/comment_avatar.svg" alt="">
                                <div class="comment">
                                    <div class="comment-flex">
                                        <h3 class="user-name">{{$comment->name}} {{$comment->l_name}}</h3>
                                        <div class="star"><span class="Stars" style="--rating: {{(!empty($comment->avg_value))?$comment->avg_value:'0'}}" aria-label="Rating of this product is 2.3 out of 5."></span></div>
                                    </div>
                                    <p class="text">{{$comment->comment}}</p>
                                    <p class="show-more">Տեսնել ավելին <img src="/img/Down.svg" alt=""></p>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        <button type="submit" class="show-more-btn" style="margin: 0 auto"><a href="/{{app()->getLocale()}}/{{$teacher->userId}}/comment">Տեսնել ավելին</a></button>
                    </div>
                    @else
                    <p class="ligth-text" style="font-size:18px">Մեկնաբանություններ առկա չեն։</p>
            </div>
            @endif
            </section>
            <section id="diplomner" class="diplomner">
                @if(count($certificate)>0)
                <h3 class="title">Դիպլոմներ</h3>
                <div class="diplom position-relative">
                    <div id="diplomCarousel" class="swiper-container "  data-ride="carousel">
                        <div class="swiper-wrapper" role="listbox">
                            <?php $count = 1;
                            $j = 1;
                            ?>
                            @foreach($certificate as $key => $cert)
                            <div class="swiper-slide">
                                <div class="carousel-item-diplom">
                                    <a href="/images/user_certificates/{{$cert->certificate}}" class="image-link with-caption">
                                        <img src="/images/user_certificates/{{$cert->certificate}}" alt="" class="dip-img">
                                    </a>
                                </div>

                            </div>                        
                            <?php $count++;
                            $j++;
                            ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pag" style="top:-35px">
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>
                @endif
            </section>
            <div id="varkanish" class="varkanish">
                <h3 class="title">Վարկանիշ</h3>
                <div class="rating">
                    <div class="graphic">
                        <img src="/img/bar-chart (1).svg" alt="">
                        @if(!empty($row))
                        <h3 class="bold-text">{{$row}} տեղում {{$teacher_count}}-ի մեջ</h3>
                        <h5 class="ligth-text">Ընդհանուր վարկանիշում</h5>
                        @else
                        <h3 class="bold-text">Վարկանիշ առկա չէ</h3>
                        <h5 class="ligth-text">Ընդհանուր վարկանիշում</h5>
                        @endif
                    </div>
                    <div class="view">
                        <img src="/img/view.svg" alt="">
                        <h3 class="bold-text">{{number_format($pages_views)}} դիտում</h3>
                        <h5 class="ligth-text">Ամսական դիտումներ</h5>
                    </div>
                    <div class="calendar">
                        <img src="/img/calendar.svg" alt="">
                        <?php
                        ;
                        $date = explode(" ", $teacher->registerDate);

                        $date_final = explode("-", $date[0]);
                        if (app()->getLocale() == 'ru') {
                            $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
                        } elseif (app()->getLocale() == 'en') {
                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        } elseif (app()->getLocale() == 'hy') {
                            $months = ['Հունվար', 'Փետրվար', 'Մարտ', 'Ապրիլ', 'Մայիս', 'Հունիս', 'Հուլիս', 'Օգոստոս', 'Սեպտեմբեր', 'Հոկտեմբեր', 'Նոյեմբեր', 'Դեկտեմբեր'];
                        }
                        ?>
                        <h3 class="bold-text">

                            {{$date_final[2]}} {{$months[$date_final[1]-1]}} {{$date_final[0]}}
                        </h3>
                        <h5 class="ligth-text">Գրանցման ամսաթիվ</h5>
                    </div>
                    <div class="students">
                        <img src="/img/Group 1925.svg" alt="">
                        <h3 class="bold-text">{{$count_notific}} սովորող</h3>
                        <h5 class="ligth-text">Գրանցման ամսաթվից</h5>
                    </div>
                     

                </div>
                
            </div>

        </div>
    </div>
</div>
</section>




<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>


<script>

function selectElementByClass(className) {
    return document.querySelector(`.${className}`);
}
$('.review_btn').click(function () {
    $('.rate_little_stars').each(function (index, elem) {
        const productRating = document.getElementById('product' + index);
        const stars = productRating.querySelectorAll('.star');
        var value = document.getElementById('rate-value' + index);
        let rating = 0;
        /* Event Listeners*/
        let stars_val = []
        productRating.addEventListener('click', e => {
            stars_val = [];
            if (!e.target.matches('.star'))
                return;
            value.innerHTML = e.target.getAttribute('data-star') + '.0';
            e.preventDefault();
            const starID = parseInt(e.target.getAttribute('data-star'));
            const starScreenReaderText = e.target.querySelector('.screen-reader');
            removeClassFromElements('is-active', stars);
            highlightStars(starID);
            resetScreenReaderText(stars);
            starScreenReaderText.textContent = `${starID} Stars Selected`;
            rating = starID; // set rating

            $('.rate_little_stars form').find('p').each(function (i, el) {
                stars_val.push($(el).text());
            });
            let array = stars_val.map(Number);
            let sum = array.reduce((a, b) => a + b, 0);
            let average_value = parseInt(sum) / 3;

            $('.star_rating_review').html(average_value.toFixed(2));
            $('.star_average_value').val(average_value.toFixed(2))


        });
        // Highlight on hover
        productRating.addEventListener('mouseover', e => {
            if (!e.target.matches('.star'))
                return;
            removeClassFromElements('is-active', stars);
            const starID = parseInt(e.target.getAttribute('data-star'));
            highlightStars(starID);
        });
        //If a rating has been clicked, snap back to that rating on mouseleave
        productRating.addEventListener('mouseleave', e => {
            removeClassFromElements('is-active', stars);
            if (rating === 0)
                return;
            highlightStars(rating);
        });
        /* Functions*/
        // Highlight active star and all those upto it
        function highlightStars(starID) {
            for (let i = 0; i < starID; i++) {
                stars[i].classList.add('is-active')
            }
        }

        function removeClassFromElements(className, elements) {
            for (let i = 0; i < elements.length; i++) {
                elements[i].classList.remove(className)
            }
        }

        function resetScreenReaderText(stars) {
            for (let i = 0; i < stars.length; i++) {
                const starID = stars[i].getAttribute('data-star');
                const text = stars[i].querySelector('.screen-reader');
                text.textContent = `${starID} Stars`;
            }
        }
    });
})


//information show more
$('#information .info-grid .info-block  .show-more').click(function () {
    if ($(this).hasClass('read_more')) {
        $(this).prev().css('height', '65px');
        $(this).removeClass('read_more');
    } else {
        $(this).prev().css('height', 'auto');
        $(this).addClass('read_more');
    }
})
//information sitebar menu_active
$('#information .info-grid .sitebar-menu ul li').click(function () {
    $('#information .info-grid .info-sitebar .sitebar-menu ul li').removeClass('active_sitebar');
    $(this).addClass('active_sitebar');
})


$('.carousel-item-diplom a').magnificPopup({
    type: 'image',
    closeBtnInside: false,
    closeOnContentClick: true,
    tLoading: '', // remove text from preloader

    /* don't add this part, it's just to disable cache on image and test loading indicator */
    callbacks: {
        beforeChange: function () {
            this.items[0].src = this.items[0].src + '?=' + Math.random();
        }
    }

});

$(document).ready(function () {
    $(".comments .comment-card").slice(0, 2).show();
    $(document).ready(function () {
        $("#information .info-grid .comments .comment-card").slice(0, 2).show();

    })

    var mySwiper = new Swiper('#otherteachersCarousel', {
        // cssMode: true,
        // spaceBetween: 30,
        // loop:true,
        // slideToClickedSlide: true,
        loopedSlides: 500,
        breakpoints: {
            '300': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '580': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '650': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '768': {
                slidesPerView: 2,
                spaceBetween: 10,
            },

            '1200': {
                slidesPerView: 3,
                spaceBetween: 10,
            }
        },

        // Optional parameters
        pagination: {
            el: '#otherteachersCarousel .swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
        // Navigation arrows

        cubeEffect: {
            slideShadows: false,
            shadow: false,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    new Swiper('#diplomCarousel', {
        // cssMode: true,
        // spaceBetween: 30,
        // loop:true,
        // slideToClickedSlide: true,
        loopedSlides: 500,
        breakpoints: {
            '300': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '580': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '650': {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            '768': {
                slidesPerView: 2,
                spaceBetween: 10,
            },

            '1200': {
                slidesPerView: 3,
                spaceBetween: 10,
            }
        },

        // Optional parameters
        pagination: {
            el: '#diplomCarousel .swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
        // Navigation arrows

        cubeEffect: {
            slideShadows: false,
            shadow: false,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


})


</script>

@endsection