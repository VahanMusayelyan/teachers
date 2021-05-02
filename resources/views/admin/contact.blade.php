@extends('admin_layout')


@section('content')

<div style="height: auto;" class="admin_section">
    <h3 class="admin_title">Հետադարձ կապ</h3>
    <table class="table table-bordered blogTable">
        <tr>
            <th> Nº </th>
            <th> Անուն ազգանուն </th>
            <th> Էլ. փոստ </th>
            <th> Հեռ.</th>
            <th> Հաղորդագրություն </th>
            <th> Ամսաթիվ </th>
            <th>Հեռացնել</th>
        </tr>
            <?php
            if(request()->page == null){
                $page = 1;
            }else{
                $page = request()->page;
            }
            
            $j = ($page - 1)*10 + 1;
           
            
    foreach ($result as $key => $value) {
      $data = explode(" ",$value->created_at);
        
        echo "<tr>"
        . "<td>" . $j . "</td>"
        . "<td>" . $value->name ." ".$value->user_lname  . "</td>"
        . "<td>" . $value->email . "</td>"
        . "<td>" . $value->phone . "</td>"
        . "<td>" . $value->letter . "</td>"
        . "<td>" . date('d-m-Y', strtotime($data[0])) . "</td>"


          ?>

        <?php
        echo "<td>";?>
        <form action="/admin/dashboard/contact-us" method='POST' enctype='multipart/form-data'>
            @csrf
            @method('DELETE')
            <?php
echo "<button type='submit' class='btn btn-primary'>Հեռացնել</button> <input type='text' hidden value='$value->id' name='number'></form></td></tr>";
          $j++;

    }
    ?>
        </table>
        {{ $result->links() }}

</div>

@endsection