$(document).ready(function () {


    $('#country').on('change', function () {

        var _token = $("input[name=_token]").val();
        var country = $(this).val();
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-regions",
            type: "POST",
            data: {_token: _token, country: country},
            success: function (response) {
                if (response) {

                    var result = JSON.parse(response);
                    $('#regions').empty();
                    $("#regions").next().next().find("ul.dropdown-menu").empty();
                    if(lang == 'hy'){
                        $('#regions').append("<option>Ընտրել</option>");
                    }else if(lang == 'en'){
                        $('#regions').append("<option>Select </option>");
                    }else if(lang == 'ru'){
                        $('#regions').append("<option>Выберите </option>");
                    }

                    jQuery.each(result, function (i, val) {

                        $('#regions').append("<option value='" + val['id'] + "'>" + val['region_' + lang] + "</option>");
                    });

                    $("#regions").selectpicker('refresh');
                    $("#regions").selectpicker('render');


                } else {
                    if(lang == 'hy'){
                        alert("Կրկնեք խնդրում եմ");
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                        alert("Please repeat");
                    }

                }
            },
        });
    });

    $('#regions').on('change', function () {
        var _token = $("input[name=_token]").val();
        var region = $(this).val();
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-cities",
            type: "POST",
            data: {_token: _token, region: region},
            success: function (response) {
                if (response) {

                    var result = JSON.parse(response);
                    $('#city').empty();
                    $("#city").next().next().find("ul.dropdown-menu").empty();
                    if(lang == 'hy'){
                        $('#city').append("<option>Ընտրել քաղաքը / համայնքը</option>");
                    }else if(lang == 'en'){
                        $('#city').append("<option>Select city / community</option>");
                    }else if(lang == 'ru'){
                        $('#city').append("<option>Выберите город / сообщество</option>");
                    }

                    jQuery.each(result, function (i, val) {

                        $('#city').append("<option value='" + val['id'] + "'>" + val['city_' + lang] + "</option>");
                    });

                    $("#city").selectpicker('refresh');
                    $("#city").selectpicker('render');


                } else {
                    if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                    
                }
            },
        });
    });


    $('#choose_subject_cat').on('change', function () {
        var _token = $("input[name=_token]").val();
        var val = $(this).val();
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-subject",
            type: "POST",
            data: {_token: _token, val: val},
            success: function (response) {
                if (response) {

                    var result = JSON.parse(response);
                    $('#choose_subject').empty();
                    $("#choose_subject").next().next().find("ul.dropdown-menu").empty();
                    if(lang == 'hy'){
                        $('#choose_subject').append("<option>Ընտրել առարկան</option>");
                    }else if(lang == 'en'){
                        $('#choose_subject').append("<option>Select subject</option>");
                    }else if(lang == 'ru'){
                        $('#choose_subject').append("<option>Выбрать предмет</option>");
                    }
                    // $('#choose_subject').append("<option selected>Ընտրել առարկան</option>");
                    jQuery.each(result, function (i, val) {
                        $('#choose_subject').append("<option value='" + val['id'] + "'>" + val['subject_' + lang] + "</option>");
                    });

                    $("#choose_subject").selectpicker('refresh');
                    $("#choose_subject").selectpicker('render');


                } else {
                    if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });




    let count = 0;

    $('#add_subject_but').on('click', function () {
        var _token = $("input[name=_token]").val();
        var lang = $("#lang").val();
        var lang_minut, select_subject_title,subject,price_dur,location,lesson_price,checkbox_at_the_teacher,
            checkbox_at_the_student,checkbox_remotely,input_price_placeholder,duration,subject_name;
        var btn = $(this).parent();
        var lang = $("#lang").val();
        $.ajax({
            url: "/ajax-subject-add",
            type: "POST",
            data: {_token: _token},
            success: function (response) {
                if (response) {
                    var option = "";
                    var result = JSON.parse(response);
                    count++;
                    if (count == 3) {
                        count++;
                }
                    
                    if(lang == 'hy'){
                        lang_minut = 'ր';
                        select_subject_title ='Դասավանդվող առարկա';
                        subject='Առարկա';
                        price_dur='1 դասի արժեքը և տևողությունը';
                        location='Վայրը';
                        lesson_price='Դասի արժեքը';
                        checkbox_at_the_teacher='Դասավանդողի մոտ';
                        checkbox_at_the_student='Ուսանողի մոտ';
                        checkbox_remotely='Հեռակա';
                        input_price_placeholder='Նշեք գումարի չափը';
                        duration='Տևողությունը';
                        
                    }else if(lang == 'en'){
                        lang_minut = 'm';
                        select_subject_title ='Subjects taught';
                        subject='Subject';
                        price_dur='Cost and duration of 1 lesson';
                        location='A place';
                        lesson_price='Lesson cost';
                        checkbox_at_the_teacher='At the tutor';
                        checkbox_at_the_student='At the student';
                        checkbox_remotely='Online';
                        input_price_placeholder='Indicate the cost';
                        duration='Duration';
                    }else if(lang == 'ru'){
                        lang_minut = 'м';
                        select_subject_title ='Преподаваемый предмет';
                        subject='Предмет';
                        price_dur='Стоимость и длительность 1 занятия';
                        location='Место';
                        lesson_price='Стоимость занятия';
                        checkbox_at_the_teacher='У репетитора';
                        checkbox_at_the_student='У ученика';
                        checkbox_remotely='Онлайн';
                        input_price_placeholder='Укажите стоимость';
                        duration='Длительность';
                    }
                    
                    $.each(result, function (index, value) {

                        if(lang == 'hy'){
                           subject_name = value['subject_hy'];
                        }else if(lang == 'en'){
                          subject_name = value['subject_en'];
                        }else if(lang == 'ru'){
                          subject_name = value['subject_ru'];
                        }
                         option += "<option value='" + value['id'] + "'>" + subject_name + "</option>";
                    });


                    btn.before(`<img src="/public/img/x.svg" class="del-add-subject" onclick='del(this)'>
                    <br>
		<div class="add_subject " style="margin-top:50px">
		<div class="form-group sub-select">
			<label for="subject_`+count+`">`+select_subject_title+`</label>
                            <select class="selectpicker selectpicker_add subject_sel" id="subject_`+count+`" data-live-search="true" name="subject[]">
				<option value="0" selected>`+subject+`</option>`
                            + option +
                            `</select>                      
		</div>
		<div class="title-price">`+ price_dur+`</div>
		<div class="grid-price">
		<div> 
			<div class="checkboxs">
				<h3 class="mini-title">`+location+`</h3>
				<div class="form-group">
					<input val="off" type="checkbox" name="professor_home[]" id="professor_home_` + count + `" class="styled-checkbox pupil">
					<label for="professor_home_` + count + `" class="checkbox_label">`+checkbox_at_the_teacher+`</label>
					</div>
					<div class="form-group">
						<input val="off" type="checkbox" name="student_home[]" id="student_home_` + count + `" class="styled-checkbox student">
						<label for="student_home_` + count + `" class="checkbox_label">`+checkbox_at_the_student+`</label>
					 </div>
                                        <div class="form-group">
                                                <input val="off" type="checkbox" name="online_home[]" id="online_` + count + `" class="styled-checkbox adulthood">
                                                <label for="online_` + count + `" class="checkbox_label">`+checkbox_remotely+`</label>
                              </div>
			</div>
		</div>
		<div> 
			<div class="inputs">
				<h3 class="mini-title">`+lesson_price+`</h3>
				<div class="form-group">
					<input type="text" val="" name="professor_home_price[]" id="professor_home_price_` + count + `" class="styled-inputtext pupil_price" placeholder="`+input_price_placeholder+`">
				</div>
                                <div class="form-group">
                                        <input type="text" val="" name="student_home_price[]" id="student_home_price_` + count + `" class="styled-inputtext student_price" placeholder="`+input_price_placeholder+`">
                                 </div>
                                <div class="form-group">
                                    <input type="text" val="" name="online_price[]" id="online_price_` + count + `" class="styled-inputtext adulthood_price" placeholder="`+input_price_placeholder+`">
                                </div>
			</div>
		</div>

		<div > 
			<div class="selectss">
				<h3 class="mini-title">`+duration+`</h3>
				<div class="form-group">
					<select class="selectpicker selectpicker_add"  name="professor_home_time[]">
						<option value="45" selected>45 `+ lang_minut +`</option>
						<option value="60" >60 `+ lang_minut +`</option>
						<option value="90" >90 `+ lang_minut +`</option>
						<option value="120" >120 `+ lang_minut +`</option>
					</select>     
				</div>
                                <div class="form-group">
                                        <select class="selectpicker selectpicker_add"  name="student_home_time[]">
                                              <option value="45" selected>45 `+ lang_minut +`</option>
						<option value="60" >60 `+ lang_minut +`</option>
						<option value="90" >90 `+ lang_minut +`</option>
						<option value="120" >120 `+ lang_minut +`</option>
                                        </select>   
                                </div>
                                <div class="form-group">
                                        <select class="selectpicker selectpicker_add"  name="online_time[]">
                                              <option value="45" selected>45 `+ lang_minut +`</option>
						<option value="60" >60 `+ lang_minut +`</option>
						<option value="90" >90 `+ lang_minut +`</option>
						<option value="120" >120 `+ lang_minut +`</option>
                                        </select>   
                                </div>
			</div>
		</div>
		</div>
	</div>`);

                    $(".selectpicker_add").selectpicker('refresh');
                    $(".selectpicker_add").selectpicker('render');

                } else {
                   if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });



    $(".del-accounnt-cert").click(function () {
        var _token = $("input[name=_token]").val();
        var cert = $(this).attr("data-cert");
        var lang = $("#lang").val();
        var cert_div = $(this).parent();

        $.ajax({
            url: "/ajax-cert-del",
            type: "POST",
            data: {_token: _token, cert: cert},
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        cert_div.remove();
                    } else {
                        if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                    }

                }
            },
        });
    });

    $(".del-subject").click(function () {
        var _token = $("input[name=_token]").val();
        var number = $(this).attr("data-number");
        var lang = $("#lang").val();
        var div = $(this).parent();

        $.ajax({
            url: "/ajax-sub-del",
            type: "POST",
            data: {_token: _token, number: number},
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        div.remove();
                    } else {
                        if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                    }

                }
            },
        });
    });

    $(".comment_check").click(function () {
        var _token = $("input[name=_token]").val();
        var number = $(this).attr("data-number");
        var val = $(this).attr("data-value");
        var element = $(this).parent();

        $.ajax({
            url: "/ajax-comment",
            type: "POST",
            data: {_token: _token, number: number, val: val},
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        if (val == 1) {

                            element.next().removeClass("decline_comment");
                            element.addClass("accept_comment");
                        } else {
                            element.prev().removeClass("accept_comment");
                            element.addClass("decline_comment");
                        }

                    } else {
                        if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                    }

                }
            },
        });
    });

    $(".user_check").click(function () {
        var _token = $("input[name=_token]").val();
        var number = $(this).attr("data-number");
        var val = $(this).attr("data-value");
        var element = $(this).parent();
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-user-active",
            type: "POST",
            data: {_token: _token, number: number, val: val},
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        if (val == 1) {

                            element.next().removeClass("decline_comment");
                            element.addClass("accept_comment");
                        } else {
                            element.prev().removeClass("accept_comment");
                            element.addClass("decline_comment");
                        }

                    } else {
                        if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                    }

                }
            },
        });
    });



    $('.send_teacher').click(function () {
        var _token = $("input[name=_token]").val();
        var email = $(this).attr("data-email");
        var number = $(this).attr("data-number");
        var teacher = $(this).attr("data-teacher");
        var subject_id =  $(this).attr("data-subject");
        var icon = $(this);
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-teacher-emailsend",
            type: "POST",
            data: {_token: _token, email: email, number: number, teacher: teacher,subject_id:subject_id},
            success: function (response) {
                if (response) {

                    if (response == 1) {

                        icon.css("color", "blue");
                        
                        alert("Նամակը ուղարկված է");

                    } else {
                        alert("Փորձել կրկին");
                    }


                } else {

                }
            },
        });
    });
    
    $('.send_teacher_second').click(function () {
        var _token = $("input[name=_token]").val();
        var email = $(this).attr("data-email");
        var number = $(this).attr("data-number");
        var teacher = $(this).attr("data-teacher");
        var tr = $(this);
        var lang = $("#lang").val();
       
        var subject_id =  $(this).attr("data-subject");

        $.ajax({
            url: "/ajax-teacher-emailsendsecond",
            type: "POST",
            data: {_token: _token, email: email, number: number, teacher: teacher, subject_id: subject_id},
            success: function (response) {
                if (response) {

                    if (response == 1) {

                        
                        tr.parent().prev().find('span').text("Այո");
                       alert("Նամակը ուղարկված է");

                    } else {
                        alert("Փորձել կրկին");
                    }


                } else {

                }
            },
        });
    });

    $('.send_all').click(function () {
        var _token = $("input[name=_token]").val();
        var number = $(this).attr("data-number");
        var icon = $(this);
        var email = [];
        var teacher = [];
        var lang = $("#lang").val();
        $(".send_teacher").each(function (index, value) {
            email.push($(this).attr("data-email"));
            teacher.push($(this).attr("data-teacher"));

        });

        $.ajax({
            url: "/ajax-teacher-all",
            type: "POST",
            data: {_token: _token, email: email, number: number, teacher: teacher},
            success: function (response) {
                if (response) {

                    if (response == 1) {

                        alert("Նամակը ուղարկված է");
                        icon.css("color", "blue");

                    } else {
                        alert("Փորձել կրկին");
                    }

                } else {

                }
            },
        });
    });

    $('.accept_not').click(function () {
        var _token = $("input[name=_token]").val();
        var suggest_id = $(this).attr("data-suggest");
        var contact_id = $(this).attr("data-contact");
        var number = $(this).attr("data-number");
        var btn = $(this);
        var lang = $("#lang").val();
        var count_not = $(".count_not");

        $.ajax({
            url: "/ajax-teacher-accept",
            type: "POST",
            data: {_token: _token, suggest_id: suggest_id,contact_id:contact_id,number:number},
            success: function (response) {
                if (response) {
                    if(lang == 'hy'){
                       alert("Հարցումը հաստատված է"); 
                    }else if(lang == 'ru'){
                        alert("Запрос одобрен");
                    }else if(lang == 'en'){
                       alert("Request approved"); 
                    }

                    btn.closest(".notification_mess").empty();
                    
                    btn.closest(".notification_mess").append('<span class="late_not">Ձեր կողմից հարցումը հաստատված է:</span>')
                    count_not.text('(' + response + ')');

                } else {
                   if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });

    $('.decline_not').click(function () {
        var _token = $("input[name=_token]").val();
        var number = $(this).attr("data-number");
        var suggest_id = $(this).attr("data-suggest");
        var contact_id = $(this).attr("data-contact");
        var btn = $(this);
        var lang = $("#lang").val();
        var count_not = $(".count_not");

        $.ajax({
            url: "/ajax-teacher-decline",
            type: "POST",
            data: {_token: _token, suggest_id: suggest_id,contact_id:contact_id,number:number},
            success: function (response) {
                if (response) {
                    if(lang == 'hy'){
                       alert("Հարցումը մերժված է"); 
                    }else if(lang == 'ru'){
                        alert("Запрос отклонен");
                    }else if(lang == 'en'){
                       alert("Request rejected"); 
                    }
              
                    btn.parent().remove();
                    count_not.text('(' + response + ')');

                } else {
                    if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }

                }
            },
        });
    });
    $('.archive').click(function () {
        var _token = $("input[name=_token]").val();
        var suggest_id = $(this).attr("data-number");
        var btn = $(this);
        var count_not = $(".count_not");
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-teacher-archive",
            type: "POST",
            data: {_token: _token, suggest_id: suggest_id},
            success: function (response) {
                if (response) {

                    if(lang == 'hy'){
                       alert("Հարցումը արխիվացված է"); 
                    }else if(lang == 'ru'){
                        alert("Запрос заархивирован");
                    }else if(lang == 'en'){
                       alert("The query is archived"); 
                    }
                    
                    btn.parent().parent().remove();
                    count_not.text('(' + response + ')');



                } else {
                   if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });

    $('.archive_page').click(function () {
        var _token = $("input[name=_token]").val();
        var suggest_id = $(this).attr("data-number");
        var btn = $(this);
        var count_not = $(".count_not");
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-teacher-archive",
            type: "POST",
            data: {_token: _token, suggest_id: suggest_id},
            success: function (response) {
                if (response) {

                    if(lang == 'hy'){
                       alert("Հարցումը արխիվացված է"); 
                    }else if(lang == 'ru'){
                        alert("Запрос заархивирован");
                    }else if(lang == 'en'){
                       alert("The query is archived"); 
                    }
                    btn.remove();
//                       count_not.text('('+response+')');

                } else {
                    if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });
    

    
    $('.kap-hastatel').click(function () {
        let _token = $("input[name=_token]").val();
        let number = $(this).attr("data-number");
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-teacher-modal",
            type: "POST",
            data: {_token: _token, number: number},
            success: function (response) {
                if (response) {
                   $("#subject_teacher").empty();
                    if(lang == 'hy'){
                        $('#subject_teacher').append("<option>Ընտրել առարկան</option>");
                    }else if(lang == 'en'){
                        $('#subject_teacher').append("<option>Select subject</option>");
                    }else if(lang == 'ru'){
                        $('#subject_teacher').append("<option>Выбрать предмет</option>");
                    }

                    jQuery.each( response, function( i, val ) {
                        $('#subject_teacher').append("<option value='" + val['subject_id'] + "'>" + val['subject_' + lang] + "</option>");


                    });
                    $("#subject_teacher").selectpicker('refresh');
                    $("#subject_teacher").selectpicker('render');
                   $(".teacher_number").val(number);
                   $('#exampleModalCenter').modal('show');
                   

                } else {
                    if(lang == 'hy'){
                       alert("Կրկնեք խնդրում եմ"); 
                    }else if(lang == 'ru'){
                        alert("Пожалуйста повторите");
                    }else if(lang == 'en'){
                       alert("Please repeat"); 
                    }
                }
            },
        });
    });
    
    $('.delete_slider').click(function () {
        let _token = $("input[name=_token]").val();
        let number = $(this).attr("data-number");
        let btn = $(this);
        var lang = $("#lang").val();

        $.ajax({
            url: "/ajax-teacher-deleteslider",
            type: "POST",
            data: {_token: _token, number: number},
            success: function (response) {
                if (response) {
                   if(response == 1){
                       btn.parent().parent().remove();
                      alert("Նկարը հեռացված է"); 
                   }else{
                       alert("Փորձել կրկին"); 
                   }
                   

                }
            },
        });
    });


});



function del(el) { 
    
    $(el).next().next().remove();
    $(el).next().remove();
    $(el).remove();

}
 