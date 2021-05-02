@extends('admin_layout')


@section('content')
<style>
.textarea_height{
    min-height:200px;
}

</style>
<section id="meta_tag" class="ml-4">
    <form action="{{route('tag_update',$result->id)}}" method="post">
        {{--<h1 class="admin_title"></h1>--}}
        @csrf
        <div class="form-group mt-4 mb-4 " style="display: grid">
            <h1 class="admin_title">էջը-            <?php
            if($result->page == 'home'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
                            echo 'Գլխավոր էջ';
            }else if($result->page == 'about'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
                            echo '«Dasaxos.am» նախագծի մասին';
            }else if($result->page == 'comment'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Կարծիքներ';
            }else if($result->page == 'filter'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Գտնել դասախոս';
            }else if($result->page == 'select_subject'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Առարկաների ընտրություն';
            }else if($result->page == 'contact'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Հետադարձ կապ';
            }else if($result->page == 'information'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Տեղեկատվություն';
            }else if($result->page == 'select_teacher'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Դասավանդողի ընտրություն';
            }else if($result->page == 'blog'){
                $title_hy=$result->title_hy;
            $title_en=$result->title_en;
            $title_ru=$result->title_ru;
            $description_hy=$result->description_hy;
            $description_en=$result->description_en;
            $description_ru=$result->description_ru;
            
                echo 'Բլոգ';
            }
            ?>
              </h1>  
        </div>
        <div class="big-grid">
            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(հայ)</label>
                    <input type="text" name="title_hy"  class="styled-inputtext" value="<?=$title_hy ?>">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(հայ) </label>
                    <textarea  name="description_hy"  class="styled-inputtext textarea_height" ><?=$description_hy?></textarea>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(en)</label>
                    <input type="text" name="title_en"  class="styled-inputtext" value="<?=$title_en ?>">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(en) </label>
                    <textarea  name="description_en"  class="styled-inputtext textarea_height" ><?=$description_en?></textarea>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(ru)</label>
                    <input type="text" name="title_ru"  class="styled-inputtext " value="<?=$title_ru ?>">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(ru) </label>
                    <textarea  name="description_ru"  class="styled-inputtext textarea_height" ><?=$description_ru?></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-info " >
Թարմացնել
        </button>
    </form>
            


</section>
@endsection