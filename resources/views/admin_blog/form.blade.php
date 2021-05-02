@extends('admin_layout')

@section('content')

<script>
    $('.nav-link').removeClass('active');
    $('#blog_link').addClass('active');
</script>
<div class="mb-5">
    <div class="container-admin admin_section">
        <!-- Blog -->

        <div class="form-horizontal" id="myform7_2">
            <fieldset>
                <h3 class="admin_title">Ավելացնել բլոգներ</h3>
                <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="blog-grid">
                        <div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold" for="title_hy">Բլոգի  անվանում (հայերեն)</label>
                                    <input type="text" class="styled-inputtext" value="" id="nameEditBlog" placeholder="" name="title_hy" value="{{old('title_hy')}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold " for="description_hy">Նկարագրություն </label>
                                    <textarea type="text" class="desc_blog styled-inputtext" id="descriptionEditBloghy" rows="10" placeholder="" name="description_hy" value="{{old('description_hy')}}"  autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold" for="title_ru">Բլոգի անվանում (Ռուսերեն)</label>
                                    <input type="text" class="styled-inputtext" value="" id="nameEditBlog" placeholder="" name="title_ru" value="{{old('title_ru')}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold" for="description_ru">Նկարագրություն </label>
                                    <textarea type="text" class="desc_blog styled-inputtext" id="descriptionEditBlogru" rows="10" placeholder="" name="description_ru" value="{{old('description_ru')}}" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold" for="title_en">Բլոգի  անվանում (Անգլերեն)</label>
                                    <input type="text" class="styled-inputtext" value="" id="nameEditBlog" placeholder="" name="title_en" value="{{old('title_en')}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                            <label class="control-label font-weight-bold " for="description_en">Նկարագրություն </label>
                                    <textarea type="text" class=" desc_blog styled-inputtext" id="descriptionEditBlogen" rows="10" placeholder="" name="description_en" value="{{old('description_en')}}" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group fileChoose">
                        <div class="up-files">
                             <label for="fileBlog" class="up-label custom-file-label">
                                <input type="file" id="fileBlog"   name="file" class="custom-file-label file">
                                    Ընտրել նկար
                            </label>
                        </div>
                        
                        <div class="form-group">
                        <label class="control-label font-weight-bold " for="description_en">Դասակարգել</label>
                        <input type="number" class="styled-inputtext" min="1"  placeholder="1" name="sort" autocomplete="off">
                        </div>
                        </div>

                    <!-- <div class="form-group fileChoose">
                        <div class="custom-file partner-file">
                            <input type="file" class=" btn btn-default custom-file-input file" id="fileBlog" name="file">
                            <label class="custom-file-label" for="file">Ընտրել նկար</label>
                             <input type="number" class="form-control" min="1"  placeholder="Դասակարգել" name="sort" autocomplete="off">
                        </div>
                    </div> -->
                    <div class="blog_buts">
                        <button type="submit" class="btn btn-success but_partner_submit">Ավելացնել</button>
                        <a class="btn btn-warning partnerAdd" href="/admin/dashboard/subjects">Բլոգների ցանկ</a>
                    </div>
                </form>
            </fieldset>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<script>
        
    
    // no react or anything
    let state = {};

// state management
    function updateState(newState) {
        state = {...state, ...newState};
    }

// event handlers
    $("#fileBlog").change(function (e) {
        let files = document.getElementById("fileBlog").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList();
    });

    
</script>

@endsection