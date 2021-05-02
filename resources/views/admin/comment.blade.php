@extends('admin_layout')


@section('content')

<div class="admin_section">
    <h3 class="admin_title">Կարծիքներ</h3>
    <table class="table table-bordered blogTable">
        <tr>
            <th> Nº </th>
            <th> Դասախոս </th>
            <th> Կարծիքներ</th>
            <th> Անուն </th>
            <th> Ազգանուն </th>
            <th> Գնահատ․ </th>
            <th>Հաստատել / Մերժել </th>
            <th>Հեռացնել </th>
        </tr>
            <?php
            if(request()->page == null){
                $page = 1;
            }else{
                $page = request()->page;
            }
            
            $j = ($page - 1)*10 + 1;
           
            
    foreach ($result as $key => $value) {
        $class= "";
        $class_second = "";
     if($value->preview == 1){
                $class= "accept_comment";
            }elseif($value->preview == 2){
                $class_second= "decline_comment";
            }
        
        echo "<tr>"
        . "<td>" . $j . "</td>"
        . "<td>" . $value->user_name ." ".$value->user_lname  . "</td>"
        . "<td class='admin_comm'><p class='admin_comment'>" . $value->comment .
            "</p><p class='show-more'>Տեսնել ավելին <img src='/img/Down.svg' ></p></td>"
        . "<td>" . $value->name . "</td>"
        . "<td>" . $value->l_name . "</td>"
        . "<td>" . $value->avg_value . "</td>"
        . "<td>"
                . "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-secondary preview $class'>
                      <input type='radio' class='comment_check' name='options' autocomplete='off'  data-number='$value->id' data-value='1'> Հաստատել
                    </label>

                    <label class='btn btn-secondary preview $class_second'>
                      <input type='radio'  class='comment_check' name='options' autocomplete='off'  data-number='$value->id' data-value='2'> Մերժել
                    </label>
                  </div></td>"
        ."<td><form action='/admin/dashboard/comments/".$value->id."' type='post'><button class='btn btn-danger' type='submit'>Հեռացնել</button></form></td></tr>";
          $j++;
    }
    ?>
        </table>
        {{ $result->links() }}
 
</div>
<script>

    $(document).ready(function () {
        $('.show-more').click(function () {
            if ($(this).hasClass('read_more')) {
                $(this).prev().css('height', '100px');
                $(this).removeClass('read_more');
                $(this).find("img").attr("src","/img/Down.svg");
            } else {
                $(this).prev().css('height', 'auto');
                $(this).addClass('read_more');
                $(this).find("img").attr("src","/img/updown.svg");
            }
        });

    });
    $.each($('.admin_comment'), function() {
        if($(this).height() <= 100){
            $(this).next().css('display','none');
        }else{
            $(this).next().css('display','block');
            $(this).css('height','100px');
        }
    });
</script>
@endsection