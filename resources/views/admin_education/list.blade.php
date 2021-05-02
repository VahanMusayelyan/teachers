@extends('admin_layout')


@section('content')
<script>
 $('.nav-link').removeClass('active');
 $('#education_link').addClass('active');
</script>
<div style="height: auto;" class="admin_section">
    <h3 class="admin_title">  Կրթություն</h3>
    <a class="title-price sub_add" href="/admin/dashboard/education/create">Ավելացնել կրթություն  <img src="{{asset('/img/plus.svg')}}" alt="" id=""></a>

    <!-- <a class="as-btn btn btn-warning partnerAdd" href="/admin/dashboard/educations/create">Ավելացնել առարկա</a> -->
    <table class="table table-bordered blogTable mt-3">
        <tr>
            <th> Nº</th>
            <th> Կրթություն (հայ) </th>
            <th> Կրթություն (ру) </th>
            <th> Կրթություն (en) </th>
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
        . "<td>".$value['education_hy']."</td>"
        . "<td>".$value['education_ru']."</td>"
        . "<td>".$value['education_en']."</td>"
        . "<td><a class='editlink btn btn-info' href='".url('/admin/dashboard/education/'.$value['id'])."/edit'>Փոփոխել</a>";
         ?>
        <form action="{{route('education.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
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