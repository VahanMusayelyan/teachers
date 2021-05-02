@extends('admin_layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#subject_link').addClass('active');
</script>

<div style="height: auto;" class="admin_section">
    <div class="container-admin">
        <!-- Blog -->
        <div class="form-horizontal" id="myform7_1">
            <fieldset>
                <h3 class="admin_title">Ավելացնել առարկաներ</h3>
                <form action="{{route('subjects.update',$result['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid">
                        <div>
                            <div class="add-subject-grid">
                            <div class="form-group">
                                <label class="control-label " for="subject_hy">Առարկա (հայ)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['subject_hy']}}" id="subject_hy" placeholder="" name="subject_hy" value="{{old('subject_hy')}}" autocomplete="off">
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label " for="subject_ru">Առարկա (ру)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['subject_ru']}}" id="subject_ru" placeholder="" name="subject_ru" value="{{old('subject_ru')}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="control-label " for="subject_en">Առարկա (en)</label>
                                    <input type="text" class="styled-inputtext" value="{{$result['subject_en']}}" id="subject_en" placeholder="" name="subject_en" value="{{old('subject_en')}}" autocomplete="off">
                                
                            </div>
                            </div>
                            <div class="checkbox-grid">
                            @if($result['school_subjects'] == 1)
                            <div class="form-group">
                            <input type="checkbox" id="school_subjects" value="school_subjects" name="school_subjects" checked class="styled-checkbox">
                            <label class="control-label checkbox_label" for="school_subjects">դպրոցական</label>
                            </div>
                            @else
                            <div class="form-group">
                            <input type="checkbox" id="school_subjects" value="school_subjects" name="school_subjects" class="styled-checkbox">
                            <label class="control-label checkbox_label" for="school_subjects">դպրոցական</label>
                            </div>
                            @endif
                            
                            @if($result['foreign_langs'] == 1)
                            <div class="form-group">
                            <input type="checkbox" id="foreign_langs" value="foreign_langs"  name="foreign_langs" checked class="styled-checkbox">
                            <label class="control-label checkbox_label" for="foreign_langs">օտար լեզուներ</label>
                            </div>
                            @else
                             <div class="form-group">
                             <input type="checkbox" id="foreign_langs" value="foreign_langs"  name="foreign_langs" class="styled-checkbox">
                            <label class="control-label checkbox_label" for="foreign_langs">օտար լեզուներ</label>
                             </div>
                            @endif
                            
                            @if($result['final_entrance'] == 1)
                            <div class="form-group">
                            <input type="checkbox" id="final_entrance" value="final_entrance"  name="final_entrance" checked class="styled-checkbox">
                            <label class="control-label checkbox_label" for="final_entrance">ավարտ. և միաս. քնն.</label>
                            </div>
                            @else
                            <div class="form-group">
                            <input type="checkbox" id="final_entrance" value="final_entrance"  name="final_entrance" class="styled-checkbox">
                            <label class="control-label checkbox_label" for="final_entrance">ավարտ. և միաս. քնն.</label>
                            </div>
                            @endif
                            
                            @if($result['for_students'] == 1)
                            <div class="form-group">
                            <input type="checkbox" id="for_students" value="for_students" name="for_students" checked class="styled-checkbox">
                            <label class="control-label checkbox_label" for="for_students">ուսանողների համար</label>
                            </div>
                            @else
                            <div class="form-group">
                            <input type="checkbox" id="for_students" value="for_students" name="for_students" class="styled-checkbox">
                            <label class="control-label checkbox_label" for="for_students">ուսանողների համար</label>
                            </div>
                            @endif
                            
                            @if($result['other'] == 1)
                            <div class="form-group">
                            <input type="checkbox" id="other" value="other"  name="other" checked class="styled-checkbox">
                            <label class="control-label checkbox_label" for="other">այլ առարկաներ</label>
                            </div>
                            @else
                             <div class="form-group">
                             <input type="checkbox" id="other" value="other"  name="other"  class="styled-checkbox">
                            <label class="control-label checkbox_label" for="other">այլ առարկաներ</label>
                             </div>
                            @endif
                            </div>
                            
                            
                           
                          
                        </div>
                    </div>
                    <div class=" btn-sub">
                        <button type="submit" class="btn btn-success but_partner_submit">Փոփոխել</button>
                        <a class="btn btn-warning menuAdd" href="/admin/dashboard/subjects"> Առարկաների ցանկ</a>
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