@extends('admin_layout')


@section('content')
<style>
    .form-search input{
        width: 20%;
        display: inline-block;
        margin: 10px 10px 10px 0;
    }
    .form-search input:focus{
        outline: none;
        border: 1px solid blue;
    }
    body > div > div > div > form > label{
        width: 100%;
        color: darkorange;
    }
    .find{
        background: transparent linear-gradient(
                100deg
                ,#fec606 0,#fe9b20 100%) 0 0 no-repeat padding-box!important;
        border: 0;
        border-radius: 10px;
        padding: 5px 20px;
        color: #fff;
    }
    </style>
<div style="height: auto;" class="mb-5 admin_section">
    <h3 class="admin_title">Դասախոսներ</h3>
    <form class="form-search for-desktop" action="{{route('search_admin')}}" method="POST">
        @csrf
        <label for="search_teacher">Գտնել դասախոս</label>
        @if(!empty($search))
        <input class="mr-sm-2 form-control" type="search" id="search_teacher" name="search" value="{{$search}}">
        @else
            <input class="mr-sm-2 form-control" type="search" id="search_teacher" name="search">

        @endif
        <button type="submit" class="find">Գտնել</button>
    </form>
    <table class="table table-bordered blogTable">
        <tr>
            <th> Nº </th>
            <th> Անուն Ազգանուն</th>
            <th> Սեռ</th>
            <th> Էլ. փոստ</th>
            <th> Ծննդ. ամսաթիվ</th>
            <th> Հեռախոսահամար </th>
            <th> Մարզ </th>
            <th> Քաղաք </th>             
            <th> Նկար </th>
            <th> Հաստատել / Մերժել </th>
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


            if (!empty($value->img)) {
                $img = "/images/user_images/" . $value->img;
            } else {
                if ($value->gender == 'male') {
                    $img = "/img/avatar_man.svg";
                } else {
                    $img = "/img/avatar_girl.svg";
                }
            }
            echo "<tr>"
            . "<td>" . $j . "</td>"
            . "<td><a href='/admin/dashboard/teachers/$value->userId'>" . $value->name . " " . $value->l_name . "</td>"
            . "<td>" . $value->gender . "</td>"
            . "<td>" . $value->email . "</td>"
            . "<td>" . $value->b_day . "</td>"
            . "<td>" . $value->phone . "</td>"
            . "<td>" . $value->region_hy . "</td>"
            . "<td>" . $value->city_hy . "</td>"
            . "<td><img class='teacher_av' src='$img'></td>"
            . "<td>"
                . "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-secondary preview $class'>
                      <input type='radio' class='user_check' name='options' autocomplete='off'  data-number='$value->userId' data-value='1'> Հաստատել
                    </label>

                    <label class='btn btn-secondary preview $class_second'>
                      <input type='radio'  class='user_check' name='options' autocomplete='off'  data-number='$value->userId' data-value='0'> Մերժել
                    </label>
                  </div></td>"
        ."</tr>";
          $j++;
        }
        ?>
    </table>


        {{ $result->links() }}




</div>

@endsection