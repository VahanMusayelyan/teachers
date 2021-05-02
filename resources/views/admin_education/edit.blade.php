@extends('admin_layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#education_link').addClass('active');
</script>

<div style="height: auto;" class="admin_section">
    <div class="container-admin">
        <!-- Blog -->
        <div class="form-horizontal" id="myform7_1">
            <fieldset>
                <h3 class="admin_title">Ավելացնել կրթություն</h3>
                <form action="{{route('education.update',$result['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid">
                        <div>
                            <div class="add-education-grid">
                            <div class="form-group">
                                <label class="control-label " for="education_hy">Կրթություն (հայ)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['education_hy']}}" id="education_hy" placeholder="" name="education_hy" value="{{old('education_hy')}}" autocomplete="off">
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label " for="education_ru">Կրթություն (ру)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['education_ru']}}" id="education_ru" placeholder="" name="education_ru" value="{{old('education_ru')}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="control-label " for="education_en">Կրթություն (en)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['education_en']}}" id="education_en" placeholder="" name="education_en" value="{{old('education_en')}}" autocomplete="off">
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class=" btn-sub">
                        <button type="submit" class="btn btn-success but_partner_submit">Փոփոխել</button>
                        <a class="btn btn-warning menuAdd" href="/admin/dashboard/education">Կրթությունների ցանկ</a>
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

@endsection