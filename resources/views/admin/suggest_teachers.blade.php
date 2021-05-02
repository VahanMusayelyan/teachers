@extends('admin_layout')


@section('content')

<div style="height: auto;" class="mb-5 admin_section">
    <h3 class="admin_title">Առաջարկել դասախոս</h3>
    <table class="table table-bordered blogTable">
        <tr>
            <th> Nº</th>
            <th> Անուն</th>
            <th> Էլ. փոստ</th>
            <th> Հեռ. </th>
            <th> Առարկա</th>
            <th> Արական</th>
            <th> Իգական</th>
            <th> Աշխ. փորձ 1-5տ.</th>
            <th> Աշխ. փորձ 5-10տ.</th>
            <th> Աշխ. փորձ 10տ. ավել.</th>
            <th> Դասավան. մոտ</th>
            <th> Ուսանողի մոտ</th>
            <th> Հեռակա</th>
            <th> Դպրոց.</th>
            <th> Ուսանող</th>
            <th> Մեծահ.</th>
            <th> Նվազ. գին</th>
            <th> Առավ. գին</th>
            <th>Հեռացնել</th>

        </tr>
        <?php
        if (request()->page == null) {
            $page = 1;
        } else {
            $page = request()->page;
        }

        $j = ($page - 1) * 10 + 1;
      
        foreach ($result as $key => $value) {
            
            $class = "";
            $class_second = "";
            if ($value->user_active == 1) {
                $class = "accept_comment";
            } elseif ($value->user_active == 0) {
                $class_second = "decline_comment";
            }

            if($value->gender_male  == ''){
                $gendermale ="<img src='/img/minus.svg'>";
            }else{
                $gendermale ="<img src='/img/check.svg'>";
            }
            if($value->gender_female  == ''){
                $genderfemale ="<img src='/img/minus.svg'>";
            }else{
                $genderfemale ="<img src='/img/check.svg'>";
            }

             if($value->exp_min == ''){
                $expmin="<img src='/img/minus.svg'>";
         }else{
                $expmin="<img src='/img/check.svg'>";
         }


            if($value->exp_med  == ''){
                $expmed ="<img src='/img/minus.svg'>";
            }else{
                $expmed ="<img src='/img/check.svg'>";
            }
            if($value->exp_med  == ''){
                $expmed ="<img src='/img/minus.svg'>";
            }else{
                $expmed ="<img src='/img/check.svg'>";
            }
            if($value->exp_max   == ''){
                $expmax ="<img src='/img/minus.svg'>";
            }else{
                $expmax ="<img src='/img/check.svg'>";
            }
            if($value->loc_proffes  == ''){
                $loc_proffes ="<img src='/img/minus.svg'>";
            }else{
                $loc_proffes ="<img src='/img/check.svg'>";
            }
            if($value->loc_student  == ''){
                $loc_student ="<img src='/img/minus.svg'>";
            }else{
                $loc_student ="<img src='/img/check.svg'>";
            }
            if($value->loc_online  == ''){
                $loc_online ="<img src='/img/minus.svg'>";
            }else{
                $loc_online ="<img src='/img/check.svg'>";
            }
            if($value->pupil  == ''){
                $pupil ="<img src='/img/minus.svg'>";
            }else{
                $pupil ="<img src='/img/check.svg'>";
            }
            if($value->student  == ''){
                $student ="<img src='/img/minus.svg'>";
            }else{
                $student ="<img src='/img/check.svg'>";
            }
            if($value->adult  == ''){
                $adult ="<img src='/img/minus.svg'>";
            }else{
                $adult ="<img src='/img/check.svg'>";
            }
            echo "<tr>"
            . "<td>" . $j . "</td>"
            . "<td>" . $value->name . " " . $value->l_name . "</td>"
            . "<td>" . $value->email."</td>"
            . "<td>" . $value->phone."</td>"
            . "<td><a href='/admin/dashboard/subject/".$value->suggestId."'>" . $value->subject_hy."</td>"
            . "<td>" .$gendermale ."</td>"
            . "<td>" . $genderfemale."</td>"
            . "<td>".$expmin."</td>"
            . "<td>" .$expmed . "</td>"
            . "<td>" . $expmax . "</td>"
            . "<td>" . $loc_proffes . "</td>"
            . "<td>" . $loc_student . "</td>"
            . "<td>" . $loc_online . "</td>"
            . "<td>" . $pupil . "</td>"
            . "<td>" . $student . "</td>"
            . "<td>" . $adult . "</td>"
            . "<td>" . $value->price_min . "</td>"
            . "<td>" . $value->price_max . "</td><td>";

          ?>

       
        <form action="/admin/dashboard/suggest-teachers" method='POST' enctype='multipart/form-data'>
            @csrf
            @method('DELETE')
            <?php
echo "<button type='submit' class='btn btn-primary'>Հեռացնել</button> <input type='text' hidden value='$value->suggestTeacherId' name='number'></form></td></tr>";
            $j++;
        }
        ?>
    </table>
    {{ $result->links() }}

</div>

@endsection