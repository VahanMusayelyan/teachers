@extends('admin_layout')

<style>

    .logoContainer,.logoContainer3,.logoContainer1,.logoContainer2{
        /*width: 450px;*/
        height: 350px;
        margin-top: 5px;
        background: #D9D9D9 0% 0% no-repeat padding-box;
        box-shadow: 0px 0px 0px #00000029;
        /*border-radius: 0px 40px;*/
        margin: 0 auto;
        margin-top: 5px;
        margin-bottom: 20px;
    }
    output{
        display: block!important;
    }
    .back-img{
        width:100%;
        height: 100%;
        object-fit: cover;
        border-radius:10px;
    }
    .fileContainer:hover,.fileContainer1:hover,.fileContainer2:hover,.fileContainer3:hover {
        filter: brightness(1.1);
        box-shadow: 0px 3px 15px #c7790357;
    }
    .fileContainer,.fileContainer1,.fileContainer2,.fileContainer3{
        background: transparent linear-gradient(270deg, #FEC606 0%, #FF4A51 100%) 0% 0% no-repeat padding-box;
        border-radius: 10px;
        overflow:hidden;
        position:relative;
        cursor: pointer !important;
        margin-bottom: 20px;
        text-align: center;
        /*width: 300px;*/
        height: 42px;
        margin-top: 15px;
        cursor: pointer!important;
        margin: 0 auto;
    }
    .fileContainer span, .fileContainer1 span, .fileContainer2 span, .fileContainer3 span{
        overflow:hidden;
        display:block;
        font-family: Segoe_UI-regular;
        font: normal normal 600 18px/24px Segoe UI;
        font-size: 18px;
        line-height: 24px;
        letter-spacing: 0px;
        color: #FFFFFF;
        cursor: pointer;
        margin: 10px auto;
    }
    .fileContainer input[type="file"],.fileContainer1 input[type="file"],.fileContainer2 input[type="file"],.fileContainer3 input[type="file"]{
        opacity:0;
        margin: 0;
        padding: 0;
        width:100%;
        height:100%;
        left: 0;
        top: 0;
        position: absolute;
        cursor: pointer;
    }



    .images-grid{
        margin-top: 25px;
        display: grid;
        grid-template-columns: 30% 30% 30%;
        justify-content: space-between;
    }

    /*Copied from bootstrap to handle input file multiple*/
    .btn {
        color: #fff!important;
        font-family: Segoe_UI-regular;
        font-weight: bold!important;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: normal;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border-radius: 10px!important;
        margin: 0 auto;
        display: grid!important;
    }

    /* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
    .fileinput-button {
        position: relative;
        overflow: hidden;
    }

    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        -ms-filter: "alpha(opacity=0)";
        font-size: 200px;
        direction: ltr;
        cursor: pointer;
    }

    .thumb {
        height: 270px;
        width: 270px;
        border-radius: 10px;
        margin-bottom: 20px;

    }

    ul{
        display: grid;
        grid-template-columns: 20% 20% 20% 20% 20%;
        padding: 20px;
        justify-content: space-between;
    }

    .img-wrap {
        position: relative;
        display: inline-block;
        font-size: 0;
    }

    .img-wrap .close {
        position: absolute;
        top: 2px;
        left: 2px;
        z-index: 100;
        background-color: transparent;
        padding: 5px 2px 2px;
        color: #000;
        font-weight: bolder;
        cursor: pointer;
        opacity: 1;
        font-size: 23px;
        line-height: 10px;

    }



    .fileinput-button{
        color: #fff;
        font-family: Segoe_UI-regular;

    }

    .slider_img{
        display: grid;
        grid-template-columns: 20% 20%  20% 20%;
        justify-content: space-between;

    }
    
    .slider_img .logoContainer3{
        /*width: 270px;*/
    height: 270px;
    margin-top: 5px;
    background: transparent 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 0px #00000029;
    /* border-radius: 0px 40px; */
    margin: 15px auto 45px auto;

    }
    
    hr{
        border-top: 3px solid rgba(0,0,0,.1)!important;
    }
    
    .delete_slider{
        position: absolute;
        cursor: pointer;
    }
    
    .other_section{
        padding: 20px 35px;
    }
    .num{
        font-size: 18px;
    }
    .update_other{
        margin:35px auto;
        background: transparent linear-gradient(90deg, #3F73C6 0%, #050A12 100%) 0% 0% no-repeat padding-box!important;
    }
   @media(max-width: 992px){
       .logoContainer, .logoContainer3, .logoContainer1, .logoContainer2{
           height: 410px;
       }
       .images-grid{
           grid-template-columns: 80%;
           margin: 0 auto;
           justify-content: center;
           row-gap: 35px;
       }

       ul, .slider_img{
           grid-template-columns:45% 45%;
       }
   }

    @media(max-width: 570px){
        ul, .slider_img{
            justify-content: center;
            grid-template-columns:90%;

        }
    }



</style>
@section('content')

<section class="other_section">
    <form action="/admin/dashboard/other" method="post" enctype="multipart/form-data">
        @csrf
   
    <div class="form-group">
        <label for="phone">Հեռախոսահամար</label>
        <span class="num">+374 </span><input type="text" name="phone" id="phone_u" class="styled-inputtext num" value="{{$phone->value}}">
    </div>

    <div class="images-grid mb-3">
        <div class="up_img">
            <div class="logoContainer">
                <img src="{{asset('/img/'.$background->value)}}" class="back-img">
            </div>
            <div class="fileContainer sprite">
                <span>Ընտրել ետնանկարը</span>
                <input type="file" name="background" id="background_img">
            </div>
        </div>
        <div class="up_img">
            <div class="logoContainer2">
                <img src="{{asset('/img/'.$bottom_img->value)}}" class="back-img">
            </div>
            <div class="fileContainer1 sprite">
                <span>Ընտրել երկրորդային նկարը</span>
                <input type="file" name="bottom_img" id="bottom_img">
            </div>
        </div>
        <div class="up_img">
            <div class="logoContainer1">
                <img src="{{asset('/img/'.$about_img->value)}}" class="back-img">
            </div>
            <div class="fileContainer2 sprite">
                <span>Ընտրել նկարը(մեր մասին)</span>
                <input type="file" name="about_img" id="about_img">
            </div>
        </div>

    </div>

    <hr>
    <div class="slider_img">
        @foreach($slider as $key => $value)
        <div class="up_img">
             
            <div class="logoContainer3">
                <img class="delete_slider" data-number="{{$value->id}}" src="/img/x.svg">
                <img src="{{asset('/img/'.$value->value)}}" class="back-img">
            </div>
           
        </div>
        @endforeach
    </div>
    <div class="contai">
    <span class="btn as-btn fileinput-button">
            <span>Ընտրել նկար(ներ)</span>
            <input type="file" name="slider[]" id="files" multiple accept="image/png,image/jpg,image/svg, image/jpeg"><br />
        </span>
        <output id="Filelist"></output>
    </div>
    <button type="submit" class="btn as-btn update_other">Փոփոխել</button>
     </form>
</section>
<script>
    $("#background_img").change(function () {
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
    $("#background_img").change(function () {
        readURL(this);
    });

    $("#about_img").change(function () {
        var fileName = $(this).val();

    });
    //file input preview
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.logoContainer1 img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#about_img").change(function () {
        readURL1(this);
    });
    $("#bottom_img").change(function () {
        var fileName = $(this).val();

    });
    //file input preview
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.logoContainer2 img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#bottom_img").change(function () {
        readURL2(this);
    });


    //I added event handler for the file upload control to access the files properties.
    document.addEventListener("DOMContentLoaded", init, false);

    //To save an array of attachments
    var AttachmentArray = [];

    //counter for attachment array
    var arrCounter = 0;

    //to make sure the error message for number of files will be shown only one time.
    var filesCounterAlertStatus = false;

    //un ordered list to keep attachments thumbnails
    var ul = document.createElement("ul");
    ul.className = "thumb-Images";
    ul.id = "imgList";

    function init() {
        //add javascript handlers for the file upload event
        document
                .querySelector("#files")
                .addEventListener("change", handleFileSelect, false);
    }

    //the handler for file upload event
    function handleFileSelect(e) {
        //to make sure the user select file/files
        if (!e.target.files)
            return;

        //To obtaine a File reference
        var files = e.target.files;

        // Loop through the FileList and then to render image files as thumbnails.
        for (var i = 0, f; (f = files[i]); i++) {
            //instantiate a FileReader object to read its contents into memory
            var fileReader = new FileReader();

            // Closure to capture the file information and apply validation.
            fileReader.onload = (function (readerEvt) {
                return function (e) {
                    //Apply the validation rules for attachments upload
                    // ApplyFileValidationRules(readerEvt);

                    //Render attachments thumbnails.
                    RenderThumbnail(e, readerEvt);

                    //Fill the array of attachment
                    FillAttachmentArray(e, readerEvt);
                };
            })(f);

            // Read in the image file as a data URL.
            // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
            // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
            fileReader.readAsDataURL(f);
        }
        document
                .getElementById("files")
                .addEventListener("change", handleFileSelect, false);
    }

    //To remove attachment once user click on x button
    jQuery(function ($) {
        $("div").on("click", ".img-wrap .close", function () {
            var id = $(this)
                    .closest(".img-wrap")
                    .find("img")
                    .data("id");

            //to remove the deleted item from array
            var elementPos = AttachmentArray.map(function (x) {
                return x.FileName;
            }).indexOf(id);
            if (elementPos !== -1) {
                AttachmentArray.splice(elementPos, 1);
            }

            //to remove image tag
            $(this)
                    .parent()
                    .find("img")
                    .not()
                    .remove();

            //to remove div tag that contain the image
            $(this)
                    .parent()
                    .find("div")
                    .not()
                    .remove();

            //to remove div tag that contain caption name
            $(this)
                    .parent()
                    .parent()
                    .find("div")
                    .not()
                    .remove();

            //to remove li tag
            var lis = document.querySelectorAll("#imgList li");
            for (var i = 0; (li = lis[i]); i++) {
                if (li.innerHTML == "") {
                    li.parentNode.removeChild(li);
                }
            }
        });
    });

    //Apply the validation rules for attachments upload
    // function ApplyFileValidationRules(readerEvt) {
    //     //To check file type according to upload conditions
    //     if (CheckFileType(readerEvt.type) == false) {
    //         alert(
    //             "The file (" +
    //             readerEvt.name +
    //             ") does not match the upload conditions, You can only upload jpg/png/gif files"
    //         );
    //         e.preventDefault();
    //         return;
    //     }

    //To check file Size according to upload conditions


    //     //To check files count according to upload conditions
    //     if (CheckFilesCount(AttachmentArray) == false) {
    //         if (!filesCounterAlertStatus) {
    //             filesCounterAlertStatus = true;
    //             alert(
    //                 "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
    //             );
    //         }
    //         e.preventDefault();
    //         return;
    //     }
    // }

    // //To check file type according to upload conditions
    // function CheckFileType(fileType) {
    //     if (fileType == "image/jpeg") {
    //         return true;
    //     } else if (fileType == "image/png") {
    //         return true;
    //     } else if (fileType == "image/gif") {
    //         return true;
    //     }   else if (fileType == "image/svg") {
    //     return true;
    // }else if (fileType == "image/jpg") {
    //     return true;
    // }else{
    //         return false;
    //     }
    //     return true;
    // }



    //To check files count according to upload conditions


    //Render attachments thumbnails.
    function RenderThumbnail(e, readerEvt) {
        var li = document.createElement("li");
        ul.appendChild(li);
        li.innerHTML = [
            '<div class="img-wrap"> <img src="/img/x.svg" class="close" alt="">' +
                    '<img class="thumb" src="',
            e.target.result,
            '" title="',
            escape(readerEvt.name),
            '" data-id="',
            readerEvt.name,
            '"/>' + "</div>"
        ].join("");

        var div = document.createElement("div");

        div.innerHTML = [readerEvt.name].join("");
        document.getElementById("Filelist").insertBefore(ul, null);
    }

    //Fill the array of attachment
    function FillAttachmentArray(e, readerEvt) {
        AttachmentArray[arrCounter] = {
            AttachmentType: 1,
            ObjectType: 1,
            FileName: readerEvt.name,
            FileDescription: "Attachment",
            NoteText: "",
            MimeType: readerEvt.type,
            Content: e.target.result.split("base64,")[1],
            FileSizeInBytes: readerEvt.size
        };
        arrCounter = arrCounter + 1;
    }


</script>

@endsection