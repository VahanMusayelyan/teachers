@extends('admin_layout')


@section('content')

<div style="height: auto;" class="admin_section">
    <h3 class="admin_title">Կապ դասախոսի հետ</h3>
    <table class="table table-bordered blogTable">
        <tr>
            <th> Nº </th>
            <th> Անուն ազգանուն</th>
            <th> Հեռ.</th>
            <th> Դասախոսի անուն ազգանուն</th>
            <th> Դասախոսի էլ. փոստ </th>
            <th> Ամսաթիվ </th>
            <th> Ուղարվել է / Հատտատվել է </th>
            <th> Ուղարկել նամակ </th>
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
            
            $data = explode(" ",$value->created_at);
            
            if ($value->resend == 1) {
              
                if(!empty($not[$value->id])){
                   
                    if ($not[$value->id]['response'] == 1) {
                        
                        $res = "Հաստատված է";
                        
                    } elseif($not[$value->id]['response'] == 2) {
                        ;
                        $res = "Մերժված է";
                    
                    } elseif($not[$value->id]['response'] == 0) {
                
                        $res = "Ընթացքում է";;
                    } 
                }

                $val = "Այո";
            } else {

                $res = "<img src='/img/minus.svg'>";
                $val = "<img src='/img/minus.svg'>";
            }
            
            

            echo "<tr>"
            . "<td>" . $j . "</td>"
            . "<td>" . $value->name_lname . "</td>"
            . "<td>" . $value->phone . "</td>"
            . "<td>" . $value->userName . " " . $value->userLName . "</td>"
            . "<td>" . $value->userEmail . "</td>"
            . "<td>" . date('d-m-Y', strtotime($data[0])) . "</td>"
            . "<td class='email_response'><span>" . $val . "</span> / ".$res."</td>"
            . "<td><button class='btn btn-primary accept_comment send_teacher_second' data-subject='".$value->subject_id."' data-teacher='" . $value->userId . "' data-email='" . $value->userEmail . "' data-number='" . $value->id . "'>Ուղարկել </button></td><td>";

          ?>

       
        <form action="/admin/dashboard/contact-teachers" method='POST' enctype='multipart/form-data'>
            @csrf
            @method('DELETE')
            <?php
echo "<button type='submit' class='btn btn-primary'>Հեռացնել</button> <input type='text' hidden value='$value->id' name='number'></form></td></tr>";
            $j++;
        }
        ?>
    </table>
    {{ $result->links() }}


<!--     Modal 
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ուղարկել նամակ դասախոսին</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email_teacher">Էլ. փոստ</label>
                        <input class="form-control" type="text" name="email" id="email_teacher" data-number="">
                        <input class="inp_hid" hidden>
                        <label for="message_teacher">Հաղորդագրություն</label>
                        <textarea class="form-control" id="message_teacher" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
                    <button type="button" class="btn btn-primary send_email">Ուղարկել նամակը</button>
                </div>
            </div>
        </div>
    </div>-->

</div>

@endsection