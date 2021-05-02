@extends('admin_layout')


@section('content')

<div style="height: auto;" class="mb-5 admin_section">
    <div class="container-admin">
        <!-- Blog -->
        <div class="form-horizontal" id="myform7_1">
            <fieldset>
                <h3 class="admin_title">Բլոգներ</h3>
                <form action="{{route('blogs.update',$result['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="blog-grid">
                        <div class="blogs">
                            <div class="form-group">
                                <label class="control-label font-weight-bold" for="title_hy">Բլոգի անվանում (հայերեն)</label>
                                    <input type="text" class="styled-inputtext" value="<?= $result['title_hy'] ?>" id="title_hy" placeholder="" name="title_hy" autocomplete="off">
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label font-weight-bold " for="description_hy">Նկարագրություն </label>
                                    <textarea type="text" class="styled-inputtext desc_blog" id="description_hy" rows="10" placeholder="" name="description_hy" autocomplete="off"><?= $result['description_hy'] ?></textarea>
                            </div>
                        </div>
                        <div class="blogs">
                            <div class="form-group">
                                <label class="control-label font-weight-bold" for="title_ru">Բլոգի անվանում (Ռուսերեն) </label>
                                    <input type="text" class="styled-inputtext" value="<?= $result['title_ru'] ?>" id="title_ru" placeholder="" name="title_ru" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="control-label font-weight-bold" for="description_ru">Նկարագրություն </label>
                                    <textarea type="text" class="styled-inputtext desc_blog" id="description_ru" rows="10" placeholder="" name="description_ru" autocomplete="off"><?= $result['description_ru'] ?></textarea>
                            </div>
                        </div>
                        <div class="blogs">
                            <div class="form-group">
                                <label class="control-label font-weight-bold" for="title_en">Բլոգի անվանում (Անգլերեն)</label>
                                    <input type="text" class=" styled-inputtext" value="<?= $result['title_en'] ?>" id="title_en" placeholder="" name="title_en" autocomplete="off">
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label font-weight-bold " for="description_en">Նկարագրություն (en)</label>
                                    <textarea type="text" class=" desc_blog styled-inputtext" id="description_en" rows="10" placeholder="" name="description_en" autocomplete="off"><?= $result['description_en'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <img src='/images/blogs/<?= $result['img'] ?>' class="blog-img">
                    
                    <div class="form-group fileChoose">
                        <div class="custom-file partner-file">
                        <div class="up-files">
                             <label for="fileEditBlog" class="up-label custom-file-label">
                                <input type="file" id="fileEditBlog"   name="file" class="custom-file-label file">
                                    Ընտրել նկար
                            </label>

                        </div>
                            <!-- <input type="file" class=" btn btn-default custom-file-input file" id="fileEditBlog" name="file">
                            <label class="custom-file-label" for="file">Choose picture</label> -->

                        </div>
                        @if(!empty($result["sort"]))
                            <div class="form-group">
                                <label class="control-label font-weight-bold " for="description_en">Դասակարգել</label>
                                <input type="number" class="styled-inputtext mb-3 mt-3" min="1" value="{{$result["sort"]}}"  placeholder="Դասակարգում" name="sort" autocomplete="off">
                            </div>
                        @else
                            <div class="form-group">
                                <label class="control-label font-weight-bold " for="description_en">Դասակարգել</label>
                                <input type="number" class="styled-inputtext mb-3 mt-3" min="1"  placeholder="Դասակարգում" name="sort" autocomplete="off">
                            </div>
                        @endif
                    </div>

                    
                    <div class="blog_buts">
                        <button type="submit" class="btn btn-warning but_partner_submit">Փոփոխել</button>
                        <a class="btn btn-warning menuAdd" href="/admin/dashboard/blogs">Բոլոր բլոգները</a>

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
    $("#fileEditBlog").change(function (e) {
        let files = document.getElementById("fileEditBlog").files;
        let filesArr = Array.from(files);
        updateState({files: files, filesArr: filesArr});

        renderFileList();
    });

    
</script>

@endsection

