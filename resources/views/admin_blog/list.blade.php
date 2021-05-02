@extends('admin_layout')


@section('content')
<style>
    body > div > div > div > table > tbody > tr > td:nth-child(2){
        max-width: 600px;  
    }
    
</style>
<script>
 $('.nav-link').removeClass('active');
 $('#blog_link').addClass('active');
</script>
<div style="height: auto;" class="admin_section admin-div">
    <h3 class="admin_title">Բլոգներ</h3>
    <a class="title-price blog_add" href="/admin/dashboard/blogs/create">Ավելացնել բլոգ  <img src="{{asset('/img/plus.svg')}}" alt="" id=""></a>
    <!-- <div class="title-price subject_add">Ավելացնել առարկա  <img src="{{asset('/img/plus.svg')}}" alt="" id="add_subject_but"></div> -->

    <table class="table table-bordered blogTable mt-3">
        <tr>
            <th> Nº </th>
            <th> Վերնագիր </th>
            <th> Նկարագրություն </th>
            <th> Դասակարգում </th>
            <th> Նկար </th>
             <th>Փոփոխել / Հեռացնել </th>

        </tr>
            <?php
            if(request()->page == null){
                $page = 1;
            }else{
                $page = request()->page;
            }
            $j = ($page - 1)*10 + 1;
    foreach ($result as $key => $value) {

        echo "<tr>"
        . "<td>" . $j . "</td>"
        . "<td><a href='/admin/dashboard/blogs/" . $value['id'] . "'>" . $value['title_hy'] . "</a></td>"
        . "<td>".substr($value['description_hy'],0,50). "</td>"
        . "<td>".$value['sort']. "</td>"
        . "<td><img class='imageBlog' src='/images/blogs/" . $value['img'] . "' ></td>"
        . "<td><a class='editlink btn btn-info' href='".url('/admin/dashboard/blogs/'.$value['id'])."/edit'>Փոփոխել</a>";
         ?>
        <form action="{{route('blogs.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
                    @csrf
                    @method('DELETE')
          <?php echo "<button type='submit' class='btn btn-primary'>Հեռացնել</button></form></td></tr>";
          $j++;
    }
    ?>
        </table>
        {{ $result->links() }}
</div>


@endsection