@extends('admin_layout')


@section('content')
<style>
    .other_section{
        padding: 35px;
    }
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
    .update_other{
        margin:35px auto;
        background: transparent linear-gradient(90deg, #3F73C6 0%, #050A12 100%) 0% 0% no-repeat padding-box!important;
    }
    .lang{
        width: 100%;
    }
   
</style>
<section class="other_section">


    <div class="grid-lang">
        <div class="form-group">
            <a href="{{ url('/admin/dashboard/download/hy_messege.php')  }}" target="_blank"><i class="fa fa-download"></i>Հայերեն</a>
        </div>

        <div class="form-group">
            <a href="{{ url('/admin/dashboard/download/en_messege.php')  }}" target="_blank"><i class="fa fa-download"></i>Անգլերեն </a>
        </div>

        <div class="form-group">
            <a href="{{ url('/admin/dashboard/download/ru_messege.php')  }}" target="_blank"><i class="fa fa-download"></i>Ռուսերեն </a>
        </div>

    </div>
    <form action="/admin/dashboard/language" method="post" class="lang" enctype="multipart/form-data">
        @csrf
        <div class="grid-lang">
            <div class="up-files">
                <label for="hy_upload" class="up-label">
                    <input type="file" id="hy_upload"   name="hy">
                    Ներբեռնել</label>
                <div class="files">
                    <ul class="files1"></ul>
                </div>
            </div>
            <div class="up-files">
                <label for="en_upload" class="up-label">
                    <input type="file" id="en_upload"   name="en">
                    Ներբեռնել </label>
                <div class="files">
                    <ul  class="files2"></ul>
                </div>
            </div>
            <div class="up-files">
                <label for="ru_upload" class="up-label">
                    <input type="file" id="ru_upload"   name="ru">
                    Ներբեռնել </label>
                <div class="files">
                    <ul  class="files3"></ul>
                </div>
            </div>
        </div>
        <button type="submit" class="btn as-btn update_other">Փոփոխել</button>
    </form>






</section>


<script>
   
   function del_mess(e){
        $(e).parent().parent().parent().prev().find("input").val("");
        $(e).parent().remove();
        
   }
  
   
   let state = {};

// state management
    function updateState(newState) {
         
        state = {...state, ...newState};
    }

// event handlers
    $("#hy_upload").change(function (e) {
        let files = document.getElementById("hy_upload").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList();
    });



// render functions
    function renderFileList() {
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

            return `<li key="${index}">${
                    file.name
                    } <span class="file-size"></span><img src="/public/img/x.svg" class="del-upfile" onclick='del_mess(this)'></li>`;

        });

        $("ul.files1").html(fileMap);
    }
      // no react or anything
    

// state management
    function updateState(newState) {
    
        state = {...state, ...newState};
    }

// event handlers
    $("#en_upload").change(function (e) {
        let files = document.getElementById("en_upload").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList1();
    });


// render functions
    function renderFileList1() {
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

            return `<li key="${index}">${
                    file.name
                    } <span class="file-size"></span><img src="/public/img/x.svg" class="del-upfile"></li>`;

        });

        $("ul.files2").html(fileMap);
    }
      // no react or anything
    

// state management
    function updateState(newState) {
 
        state = {...state, ...newState};
    }

// event handlers
    $("#ru_upload").change(function (e) {
        let files = document.getElementById("ru_upload").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList2();
    });
    
        $(".files").on("click", "li > i", function (e) {
        let key = $(this)
                .parent()
                .attr("key");
        let curArr = state.filesArr;
        curArr.splice(key, 1);
        updateState({filesArr: curArr});
        renderFileList();
    });


// render functions
    function renderFileList2() {
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

            return `<li key="${index}">${
                    file.name
                    } <span class="file-size"></span><img src="/public/img/x.svg" class="del-upfile"></li>`;

        });

        $("ul.files3").html(fileMap);
    }
    

    
</script>

@endsection