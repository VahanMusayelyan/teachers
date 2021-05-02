@extends('admin_layout')


@section('content')
<script>
 $('.nav-link').removeClass('active');
 $('#subject_link').addClass('active');
</script>
<div style="height: auto;" class="admin_section">
    <h3 class="admin_title">  Առարկաներ</h3>
    <a class="title-price sub_add" href="/admin/dashboard/subjects/create">Ավելացնել առարկա  <img src="{{asset('/img/plus.svg')}}" alt="" id=""></a>

    <!-- <a class="as-btn btn btn-warning partnerAdd" href="/admin/dashboard/subjects/create">Ավելացնել առարկա</a> -->
    <table class="table table-bordered blogTable mt-3">
        <tr>
            <th> Nº</th>
            <th> Առարկա (հայ) </th>
            <th> Առարկա (ру) </th>
            <th> Առարկա (en) </th>
            <th> Դպրոցական </th>
            <th> Օտար լեզուներ </th>
            <th> Ավարտ. և Միասն. քնն. </th>
            <th> Ուսանողների համար </th>
            <th> Այլ առարկաներ </th>
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
        if($value['school_subjects']  == 0){
            $school_subjects ="<img src='/img/minus.svg'>";
        }else{
            $school_subjects ="<img src='/img/check.svg'>";
        }
        if($value['foreign_langs']  == 0){
            $foreign_langs ="<img src='/img/minus.svg'>";
        }else{
            $foreign_langs ="<img src='/img/check.svg'>";
        }
        if($value['foreign_langs']  == 0){
            $foreign_langs ="<img src='/img/minus.svg'>";
        }else{
            $foreign_langs ="<img src='/img/check.svg'>";
        }
        if($value['final_entrance']  == 0){
            $final_entrance ="<img src='/img/minus.svg'>";
        }else{
            $final_entrance ="<img src='/img/check.svg'>";
        }
        if($value['for_students']  == 0){
            $for_students ="<img src='/img/minus.svg'>";
        }else{
            $for_students ="<img src='/img/check.svg'>";
        }
        if($value['other']  == 0){
            $other ="<img src='/img/minus.svg'>";
        }else{
            $other ="<img src='/img/check.svg'>";
        }
        echo "<tr>"
        . "<td>" . $j . "</td>"
        . "<td>".$value['subject_hy']."</td>"
        . "<td>".$value['subject_ru']."</td>"
        . "<td>".$value['subject_en']."</td>"
        . "<td>".$school_subjects."</td>"
        . "<td>".$foreign_langs."</td>"
        . "<td>".$final_entrance."</td>"
        . "<td>".$for_students."</td>"
        . "<td>".$other."</td>"
        . "<td><a class='editlink btn btn-info' href='".url('/admin/dashboard/subjects/'.$value['id'])."/edit'>Փոփոխել</a>";
         ?>
        <form action="{{route('subjects.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
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