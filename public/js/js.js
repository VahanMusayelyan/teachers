



$("#professor_img").change(function () {
    var fileName = $(this).val();

});
//file input preview
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.logoContainer img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#professor_img").change(function () {
    readURL(this);
});


$(document).ready(function () {

    $.each($('#teacher_account .more-info p'), function () {
        if ($(this).height() <= 100) {
            $(this).next().css('display', 'none');
        } else {
            $(this).next().css('display', 'block');
            $(this).css('height', '100px');
        }
    });

});


$('#teacher_account .more-info .show-more').click(function () {
    if ($(this).hasClass('read_more')) {
        $(this).prev().css('height', '100px');
        $(this).removeClass('read_more');
        $(this).find("img").attr("src", "/img/Down.svg");
    } else {
        $(this).prev().css('height', 'auto');
        $(this).addClass('read_more');
        $(this).find("img").attr("src", "/img/updown.svg");
    }
});

//upload files
$(document).ready(function () {

    $('#choose_subject').on('change', function () {
        $('.choose_subject').val($(this).val());
    });
    
    $('#choose_subject_cat').on('change', function () {
        $('.choose_subject_cat').val($(this).val());
    });


    // no react or anything
    let state = {};

// state management
    function updateState(newState) {
        console.log(1);
        state = {...state, ...newState};
    }

// event handlers
    $("#upload").change(function (e) {
        console.log(2);
        let files = document.getElementById("upload").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList();
    });

    $(".files").on("click", "li img", function (e) {
        console.log(3);
        let key = $(this)
                .parent()
                .attr("key");
        let curArr = state.filesArr;
        curArr.splice(key, 1);
        updateState({filesArr: curArr});
        renderFileList();
    });


// render functions
    function renderFileList() {
        console.log(4);
        let fileMap = state.filesArr.map((file, index) => {
            let suffix = "bytes";
            let size = file.size;
            if (size >= 1024 && size < 1024000) {
                suffix = "KB";
                size = Math.round(size / 1024 * 100) / 100;
            } else if (size >= 1024000) {
                suffix = "MB";
                size = Math.round(size / 1024000 * 100) / 100;
            }

            return `<li class="file_${index}" key="${index}">${
                    file.name
                    } <span class="file-size"></span><img src="/public/img/x.svg" class="del-upfile" data-number="${index}"></li>`;

        });
          $("ul").html(fileMap);
    }




    $("#one").blur(function () {
        $("#lower").val($(this).val());
    });

    $("#two").blur(function () {
        $("#upper").val($(this).val());
    });


});


//show more
$('.prof-card .show-more').click(function () {
    if ($(this).hasClass('read_more')) {
        $(this).prev().css('height', '65px');
        $(this).removeClass('read_more');
        $(this).find("img").attr("src", "/img/Down.svg");
    } else {
        $(this).prev().css('height', 'auto');
        $(this).addClass('read_more');
        $(this).find("img").attr("src", "/img/updown.svg");
    }
});

$('.comment .show-more').click(function () {
    if ($(this).hasClass('read_more')) {
        $(this).prev().css('height', '65px');
        $(this).removeClass('read_more');
        $(this).find("img").attr("src", "/img/Down.svg");
    } else {
        $(this).prev().css('height', 'auto');
        $(this).addClass('read_more');
        $(this).find("img").attr("src", "/img/updown.svg");
    }
});




//date Armenia
$(document).ready(function () {
    $.each($('#professor_search .search-grid .prof-grid .prof-card .more-info-text'), function () {
        if ($(this).height() <= 65) {
            $(this).next().css('display', 'none');
        } else {
            $(this).next().css('display', 'block');
            $(this).css('height', '65px');
        }
    });

    $.each($('.comment .text'), function () {
        if ($(this).height() <= 65) {
            $(this).next().css('display', 'none');
        } else {
            $(this).next().css('display', 'block');
            $(this).css('height', '65px');
        }
    });
    $.each($('#information .info-grid .more-info .text'), function () {
        if ($(this).height() <= 65) {
            $(this).next().css('display', 'none');
        } else {
            $(this).next().css('display', 'block');
            $(this).css('height', '65px');
        }
    });


    $('#professor_search .prof-card').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.href = $(this).closest(".prof-card").attr("data-number");
    });

    
    $('.kap-hastatel').click(function (e) {
        let val = $(this).attr("data-number");
        $(".teacher_number").val(val);
        $('#exampleModalCenter').modal('show');
        e.stopPropagation();
    });

    $('.show_more_span').click(function (e) {

        e.stopPropagation();
    });

    $('.close_modal').click(function (e) {

        $('#exampleModalCenter').modal('hide');
    });




    $(".open_teacher_modal").click(function () {

        $("#email_teacher").val($(this).attr("data-email"));
        var data_number = $(this).attr("data-number");
        $("#email_teacher").attr("data-number", data_number);
        $(this).parent().parent().addClass("active_response");
        $("#email_teacher").attr("data-tr", $("tr.active_response").index());



    });





    $('.reg-form').submit(function (event) {
        
        
  
        let lang = $("#lang").val();
        let mess = "";
        let mess_pass = "";
        $(".under_text").remove();
        $('.reg-form').find(".red_text").removeClass("red_text");
        $('.reg-form').find(".red_border").removeClass("red_border");
        if(lang == 'ru'){
           mess = "Заполните поле"; 
           mess_pass = "Пароли не совпадают"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
           mess_pass = "Passwords do not match";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
            mess_pass = "Գաղտնաբառերը չեն համընկնում"; 
        }

        let pupil_loc;
        let student_loc;
        let adulthood_loc;
        let pupil;
        let student;
        let adulthood;
        let student_price;
        let pupil_price;
        let adulthood_price;
        let gender;

        /* andznakan tvyalner*/
        let name = $("#professor_name").val();
        if (!name) {
            $("#professor_name").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_name");
        }

        let fname = $("#professor_fathername").val();
        if (!fname) {
            $("#professor_fathername").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_fathername");
        }

        let lname = $("#professor_lname").val();
        if (!lname) {
            $("#professor_lname").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_lname");
        }

        let city = $("#city").val();
        if (city < 1 || !city) {
            $("#city").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#city").parent());
        }

        let birth_date = $(".birth_date").val();
        if (!birth_date) {
            $(".birth_date").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter(".birth_date");
        }

        let regions = $("#regions").val();
        if (regions < 1 || !regions) {
            $("#regions").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#regions").parent());
        }

        // let address = $("#professor_address").val();
        // if (!address) {
        //     $("#professor_address").addClass("red_border");
        //     $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_address");
        // }

        if ($("input[name='gender']:checked")) {
            gender = $("input[name='gender']:checked").val();
        }
        if (!gender) {
            $(".gender_btn").next().addClass("red_text");
        }

        /* end andznakan tvyalner*/


        /*usanox, dprocakan, mecahasak*/
        if ($('.pupil_loc').is(":checked")) {
            pupil_loc = $(".pupil_loc").val()
        }
        if ($('.student_loc').is(":checked")) {
            student_loc = $(".student_loc").val();
        }
        if ($('.adulthood_loc').is(":checked")) {
            adulthood_loc = $(".adulthood_loc").val();
        }

        if (!pupil_loc && !student_loc && !adulthood_loc) {
            if (!pupil_loc) {
                $(".pupil_loc").next().addClass("red_text");
            }
            if (!student_loc) {
                $(".student_loc").next().addClass("red_text");
            }
            if (!adulthood_loc) {
                $(".adulthood_loc").next().addClass("red_text");
            }
        }
        /*end  usanox, dprocakan, mecahasak*/


        $("select.subject_sel").each(function () {
            let subject = $(this).val();

            if (!subject || subject < 1) {
                $(this).parent().addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent());
            }

        });

        $('.pupil').each(function () {

            if ($(this).is(":checked")) {
                pupil = $(this).val();
            } else {
                pupil = "";
            }
            pupil_price = $(this).parent().parent().parent().next().find(".inputs").find(".pupil_price").val();

            if (!pupil && pupil_price) {
                $(this).next().addClass("red_text");
            }

            if (pupil && !pupil_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".pupil_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".pupil_price"));
            }

        });

        $('.student').each(function () {

            if ($(this).is(":checked")) {
                student = $(this).val();
            } else {
                student = "";
            }
            student_price = $(this).parent().parent().parent().next().find(".inputs").find(".student_price").val();

            if (!student && student_price) {
                $(this).next().addClass("red_text");
            }

            if (student && !student_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".student_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".student_price"));
            }

        });

        $('.adulthood').each(function () {

            if ($(this).is(":checked")) {
                adulthood = $(this).val();
            } else {
                adulthood = "";
            }
            adulthood_price = $(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price").val();

            if (!adulthood && adulthood_price) {
                $(this).next().addClass("red_text");
            }

            if (adulthood && !adulthood_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price"));
            }
        });



        $('.add_subject').each(function () {

            if ($(this).find(".pupil").is(":checked")) {
                pupil = $(this).find(".pupil");
            } else {
                pupil = "";
            }
            pupil_price = $(this).find(".inputs").find(".pupil_price").val();


            if ($(this).find(".student").is(":checked")) {
                student = $(this).find(".student").val();
            } else {
                student = "";
            }
            student_price = $(this).find(".inputs").find(".student_price").val();


            if ($(this).find(".adulthood").is(":checked")) {
                adulthood = $(this).find(".adulthood").val();
            } else {
                adulthood = "";
            }
            adulthood_price = $(this).find(".inputs").find(".adulthood_price").val();

            if (!adulthood_price && !adulthood && !student && !student_price && !pupil_price && !pupil) {
                $(this).find(".pupil").next().addClass("red_text");
                $(this).find(".inputs").find(".pupil_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".pupil_price"));
                $(this).find(".student").next().addClass("red_text");
                $(this).find(".inputs").find(".student_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".student_price"));
                $(this).find(".adulthood").next().addClass("red_text");
                $(this).find(".inputs").find(".adulthood_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".adulthood_price"));
            }
        });



        /* masnagitakan,grancman tvyalner  */
        let education = $("#education").val();
        if (education < 1 || !education) {
            $("#education").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#education").parent());
        }
        let work_exp = $("#professor_experience").val();
        if (!work_exp) {
            $("#professor_experience").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_experience");
        }
        let professor_about = $("#professor_about").val();
        if (!professor_about) {
            $("#professor_about").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_about");
        }
        let professor_phone = $("#professor_phone").val();
        if (!professor_phone) {
            $("#professor_phone").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_phone");
        }
        let email = $("#email").val();
        if (!email) {
            $("#email").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#email");
        }
        let password = $("#professor_password").val();
        if (!password) {
            $("#professor_password").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_password");
        }
        let pass_conf = $("#professor_confpassword").val();
        if (!pass_conf) {
            $("#professor_confpassword").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_confpassword");
        }
//
        if (password != pass_conf) {
            $("#professor_password").addClass("red_border");
            $("#professor_confpassword").addClass("red_border");
            if ($("#professor_password").next().hasClass('under_text') || $("#professor_confpassword").next().hasClass('under_text')) {

            } else {
                $('<p class="under_text">'+mess_pass+'։</p>').insertAfter("#professor_password");
                $('<p class="under_text">'+mess_pass+'։</p>').insertAfter("#professor_confpassword");
            }
        }
        if ($(".agree").is(":checked")){
            
        }else{
            $(".agree").next().addClass("red_text");
        }

      
               
        
        /* end masnagitakan, grancman tvyalner  */

        let redborder = $(".red_border");
        let redtext = $(".red_text");

        if (redborder.length > 0 || redtext.length > 0) {
            return false;
        }




        $('.pupil').each(function () {

            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="professor_home[]" class="pupil" hidden>').insertAfter(this);
            }

        });

        $('.student').each(function () {
            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="student_home[]" class="student" hidden>').insertAfter(this);
            }

        });

        $('.adulthood').each(function () {

            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="online_home[]" class="adulthood" hidden>').insertAfter(this);
            }

        });
        
        
        
        var response = grecaptcha.getResponse();
        if(response.length == '0'){
            $(".pl-0.captcha iframe").addClass("red_border");
            return false;
        }
        

//  event.preventDefault();


    })
    $('.reg-form-update').submit(function (event) {
        
        
  
        let lang = $("#lang").val();
        let mess = "";
        let mess_pass = "";
        $(".under_text").remove();
        $('.reg-form-update').find(".red_text").removeClass("red_text");
        $('.reg-form-update').find(".red_border").removeClass("red_border");
        if(lang == 'ru'){
           mess = "Заполните поле"; 
           mess_pass = "Пароли не совпадают"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
           mess_pass = "Passwords do not match";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
            mess_pass = "Գաղտնաբառերը չեն համընկնում"; 
        }

        let pupil_loc;
        let student_loc;
        let adulthood_loc;
        let pupil;
        let student;
        let adulthood;
        let student_price;
        let pupil_price;
        let adulthood_price;
        let gender;

        /* andznakan tvyalner*/
        let name = $("#professor_name").val();
        console.log(name);
        if (!name) {
            $("#professor_name").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_name");
        }

        let fname = $("#professor_fathername").val();
        if (!fname) {
            $("#professor_fathername").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_fathername");
        }

        let lname = $("#professor_lname").val();
        if (!lname) {
            $("#professor_lname").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_lname");
        }

        let city = $("#city").val();
        if (city < 1 || !city) {
            $("#city").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#city").parent());
        }

        let birth_date = $(".birth_date").val();
        if (!birth_date) {
            $(".birth_date").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter(".birth_date");
        }

        let regions = $("#regions").val();
        if (regions < 1 || !regions) {
            $("#regions").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#regions").parent());
        }

        // let address = $("#professor_address").val();
        // if (!address) {
        //     $("#professor_address").addClass("red_border");
        //     $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_address");
        // }

        if ($("input[name='gender']:checked")) {
            gender = $("input[name='gender']:checked").val();
        }
        if (!gender) {
            $(".gender_btn").next().addClass("red_text");
        }

        /* end andznakan tvyalner*/


        /*usanox, dprocakan, mecahasak*/
        if ($('.pupil_loc').is(":checked")) {
            pupil_loc = $(".pupil_loc").val()
        }
        if ($('.student_loc').is(":checked")) {
            student_loc = $(".student_loc").val();
        }
        if ($('.adulthood_loc').is(":checked")) {
            adulthood_loc = $(".adulthood_loc").val();
        }

        if (!pupil_loc && !student_loc && !adulthood_loc) {
            if (!pupil_loc) {
                $(".pupil_loc").next().addClass("red_text");
            }
            if (!student_loc) {
                $(".student_loc").next().addClass("red_text");
            }
            if (!adulthood_loc) {
                $(".adulthood_loc").next().addClass("red_text");
            }
        }
        /*end  usanox, dprocakan, mecahasak*/


        $("select.subject_sel").each(function () {
            let subject = $(this).val();

            if (!subject || subject < 1) {
                $(this).parent().addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent());
            }

        });

        $('.pupil').each(function () {

            if ($(this).is(":checked")) {
                pupil = $(this).val();
            } else {
                pupil = "";
            }
            pupil_price = $(this).parent().parent().parent().next().find(".inputs").find(".pupil_price").val();

            if (!pupil && pupil_price) {
                $(this).next().addClass("red_text");
            }

            if (pupil && !pupil_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".pupil_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".pupil_price"));
            }

        });

        $('.student').each(function () {

            if ($(this).is(":checked")) {
                student = $(this).val();
            } else {
                student = "";
            }
            student_price = $(this).parent().parent().parent().next().find(".inputs").find(".student_price").val();

            if (!student && student_price) {
                $(this).next().addClass("red_text");
            }

            if (student && !student_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".student_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".student_price"));
            }

        });

        $('.adulthood').each(function () {

            if ($(this).is(":checked")) {
                adulthood = $(this).val();
            } else {
                adulthood = "";
            }
            adulthood_price = $(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price").val();

            if (!adulthood && adulthood_price) {
                $(this).next().addClass("red_text");
            }

            if (adulthood && !adulthood_price) {
                $(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).parent().parent().parent().next().find(".inputs").find(".adulthood_price"));
            }
        });



        $('.add_subject').each(function () {

            if ($(this).find(".pupil").is(":checked")) {
                pupil = $(this).find(".pupil");
            } else {
                pupil = "";
            }
            pupil_price = $(this).find(".inputs").find(".pupil_price").val();


            if ($(this).find(".student").is(":checked")) {
                student = $(this).find(".student").val();
            } else {
                student = "";
            }
            student_price = $(this).find(".inputs").find(".student_price").val();


            if ($(this).find(".adulthood").is(":checked")) {
                adulthood = $(this).find(".adulthood").val();
            } else {
                adulthood = "";
            }
            adulthood_price = $(this).find(".inputs").find(".adulthood_price").val();

            if (!adulthood_price && !adulthood && !student && !student_price && !pupil_price && !pupil) {
                $(this).find(".pupil").next().addClass("red_text");
                $(this).find(".inputs").find(".pupil_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".pupil_price"));
                $(this).find(".student").next().addClass("red_text");
                $(this).find(".inputs").find(".student_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".student_price"));
                $(this).find(".adulthood").next().addClass("red_text");
                $(this).find(".inputs").find(".adulthood_price").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter($(this).find(".inputs").find(".adulthood_price"));
            }
        });



        /* masnagitakan,grancman tvyalner  */
        let education = $("#education").val();
        if (education < 1 || !education) {
            $("#education").parent().addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter($("#education").parent());
        }
        let work_exp = $("#professor_experience").val();
        if (!work_exp) {
            $("#professor_experience").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_experience");
        }
        let professor_about = $("#professor_about").val();
        if (!professor_about) {
            $("#professor_about").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_about");
        }
        let professor_phone = $("#professor_phone").val();
        if (!professor_phone) {
            $("#professor_phone").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#professor_phone");
        }
        let email = $("#email").val();
        if (!email) {
            $("#email").addClass("red_border");
            $('<p class="under_text">'+mess+'։</p>').insertAfter("#email");
        }
        
        let password = $("#professor_password").val();

        let pass_conf = $("#professor_confpassword").val();
        
//
        if (password != pass_conf) {
            $("#professor_password").addClass("red_border");
            $("#professor_confpassword").addClass("red_border");
            if ($("#professor_password").next().hasClass('under_text') || $("#professor_confpassword").next().hasClass('under_text')) {

            } else {
                $('<p class="under_text">'+mess_pass+'։</p>').insertAfter("#professor_password");
                $('<p class="under_text">'+mess_pass+'։</p>').insertAfter("#professor_confpassword");
            }
        }

      
               
        
        /* end masnagitakan, grancman tvyalner  */

        let redborder = $(".red_border");
        let redtext = $(".red_text");

        if (redborder.length > 0 || redtext.length > 0) {
            return false;
        }




        $('.pupil').each(function () {

            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="professor_home[]" class="pupil" hidden>').insertAfter(this);
            }

        });

        $('.student').each(function () {
            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="student_home[]" class="student" hidden>').insertAfter(this);
            }

        });

        $('.adulthood').each(function () {

            if ($(this).is(":checked")) {

            } else {
                $('<input val="" type="input" name="online_home[]" class="adulthood" hidden>').insertAfter(this);
            }

        });
        
    

//  event.preventDefault();


    })
    
    

    $('.contact_form').submit(function (event) {
        let lang = $("#lang").val();
        let mess = "";
        if(lang == 'ru'){
           mess = "Заполните поле"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
        }
        
        
        $(".under_text").remove();
        $('.contact_form').find(".red_border").removeClass("red_border");
        let flname = $("#flname").val();
        let phone = $("#phone").val();
        if (!phone || !flname) {
            if (!flname) {
                $("#flname").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#flname");
            }
            if (!phone) {
                $("#phone").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#phone");
            }

            return false;
        }
       
    });
    
    
    $('.forgot-password-form').submit(function (event) {
     
        let lang = $("#lang").val();
        let mess = "";
        if(lang == 'ru'){
           mess = "Заполните поле"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
        }
        
        $('.forgot-password-form').find(".under_text").remove();
        $('.forgot-password-form').find(".red_border").removeClass("red_border");
        let email = $('.forgot-password-form').find("#professor_login_email").val();
        if (!email) {
          
                $('.forgot-password-form').find("#professor_login_email").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter(".forgot-password-form #professor_login_email");

            return false;
        }
    });


    $('.rating_form').submit(function (event) {
        let lang = $("#lang").val();
        let mess = "";
        if(lang == 'ru'){
           mess = "Заполните поле"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
        }
        $(".under_text").remove();
        $('.rating_form').find(".red_border").removeClass("red_border");

        let name = $("#name").val();
        let lastname = $("#lastname").val();
        let comment = $("#comment").val();
        if (!name || !lastname || !comment) {

            if (!name) {
                $("#name").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#name");
            }
            if (!lastname) {
                $("#lastname").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#lastname");
            }
            if (!comment) {
                $("#comment").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#comment");
            }

            return false;
        }

    });


    $('.contactus_form_comp').submit(function (event) {
        let lang = $("#lang").val();
        let mess = "";
        if(lang == 'ru'){
           mess = "Заполните поле"; 
        }else if(lang == 'en'){
           mess = "Fill the field";  
        }else if(lang == 'hy'){
            mess = "Լրացրեք տվյալ դաշտը"; 
        }
        $(".under_text").remove();
        $('.contactus_form_comp').find(".red_border").removeClass("red_border");

        let name = $("#name").val();
        let lname = $("#lname").val();
        let message = $("#message").val();
        let email = $("#email").val();
        let phone_u = $("#phone_u").val();
        var response = grecaptcha.getResponse();
        
        if(response.length == '0'){
            $(".pl-0.captcha iframe").addClass("red_border");
            return false;
        }
        if (!name || !lname || !message || !email || !phone) {

            if (!name) {
                $("#name").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#name");
            }
            if (!lname) {
                $("#lname").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#lname");
            }
            if (!message) {
                $("#message").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#message");
            }
            if (!email) {
                $("#email").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#email");
            }
            if (!phone_u) {
                
                $("#phone_u").addClass("red_border");
                $('<p class="under_text">'+mess+'։</p>').insertAfter("#phone_u");
            }

            return false;
        }
        
        

    });






});



$ ('.carousel-item-lecturer').mouseenter (function(){
    $ ('.lecturers_subjects .carousel-inner').css ('overflow', 'visible')
})

$ ('.carousel-item-lecturer').mouseleave (function(){
    $ ('.lecturers_subjects .carousel-inner').css ('overflow', 'hidden')
})

// *******************************************

$ ('.carousel-item-reviews').mouseenter (function(){
    $ ('.hp-reviews .carousel-inner').css ('overflow', 'visible')
})

$ ('.carousel-item-reviews').mouseleave (function(){
    $ ('.hp-reviews .carousel-inner').css ('overflow', 'hidden')
})

$(document).ready(function() {
    // Optimalisation: Store the references outside the event handler:
    var $window = $(window);
    function checkWidth() {
        var windowsize = $window.width();
        if (windowsize >= 993) {
            //if the window is greater than 440px wide then turn on jScrollPane..
            $('#BlogCollapsAside').collapse({
                toggle: true
            });
        }
    }
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);



$(".profile_update_checkbox .checkbox_label").click(function(){
    console.log($(this).prev());

});




});
//
// function del_img(e){
//     let key = $(e).attr("data-number");
//     let li = $(".files").find(".file_"+key);
//     let file = $("#upload")[0].files;
//     let li_text = li.text();
//     li_text = li_text.replace(/\s/g, '');
//     $.each(file, function (i,val) {
//         let name = file[i].name;
//         if(li_text == name){
//             file[i] = {};
//             console.log(i)
//             console.log(file[i]);
//             delete file.i;
//             delete file[i];
//             console.log(file);
//
//         }
//
//
//
//     });
//
//
// }