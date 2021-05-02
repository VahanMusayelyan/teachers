@extends('admin_layout')


@section('content')
<section id="meta_tag" class="ml-4">
    <!-- <form action="{{route('tag_add')}}" method="post">
        {{--<h1 class="admin_title"></h1>--}}
        @csrf
        <div class="form-group mt-4 mb-4 " style="display: grid">
            <label for="">Ընտրել էջը</label>
            <select name="page" id="" class="styled-inputtext">
                <option value="home">Գլխավոր էջ</option>
                <option value="about">«Dasaxos.am» նախագծի մասին</option>
                <option value="comment">Կարծիքներ</option>
                <option value="filter">Գտնել դասախոս</option>
                <option value="select_subject">Առարկաների ընտրություն</option>
                <option value="contact">Հետադարձ կապ </option>
                <option value="information">Տեղեկատվություն</option>
                <option value="select_teacher">Դասավանդողի ընտրություն</option>
                <option value="blog">Բլոգ </option>
            </select>    
        </div>
        <div class="big-grid">
            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(հայ)</label>
                    <input type="text" name="title_hy"  class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(հայ) </label>
                    <textarea  name="description_hy"  class="styled-inputtext"></textarea>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(en)</label>
                    <input type="text" name="title_en"  class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(en) </label>
                    <textarea  name="description_en"  class="styled-inputtext"></textarea>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="">Վերնագիր(ru)</label>
                    <input type="text" name="title_ru"  class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="">Նկարագրություն(ru) </label>
                    <textarea  name="description_ru"  class="styled-inputtext"></textarea>
                </div>
            </div>
        </div> -->
<h1 class="admin_title">Մետաթեգ</h1>
        <table class="table table-bordered blogTable">
            <thead>
            <th>Էջ</th>
            <th>Վերնագիր(հայ)</th>
            <th>Նկարագրություն(հայ)</th>
            <th>Վերնագիր(en)</th>
            <th>Նկարագրություն(en)</th>
            <th>Վերնագիր(ru)</th>
            <th>Նկարագրություն(ru)</th>
            <th></th>
            </thead>
            <tbody>
            @foreach ($meta_tags as $key => $value)
                <tr>
                    <td>
                        @if($value->page == 'home')
                            Գլխավոր էջ
                        @elseif($value->page == 'about')
                            «Dasaxos.am» նախագծի մասին
                        @elseif($value->page == 'comment')
                            Կարծիքներ
                        @elseif($value->page == 'filter')
                            Գտնել դասախոս
                        @elseif($value->page == 'select_subject')
                            Առարկաների ընտրություն
                        @elseif($value->page == 'contact')
                            Հետադարձ կապ
                        @elseif($value->page == 'information')
                            Տեղեկատվություն
                        @elseif($value->page == 'select_teacher')
                            Դասավանդողի ընտրություն
                        @elseif($value->page == 'blog')
                            Բլոգ

                        @endif
                    </td>
                    <td>
                        {{$value->title_hy}}
                    </td>
                    <td>
                        {{$value->description_hy}}
                    </td>
                    <td>
                        {{$value->title_en}}
                    </td>
                    <td>
                        {{$value->description_en}}
                    </td>
                    <td>
                        {{$value->title_ru}}
                    </td>
                    <td>
                        {{$value->description_ru}}
                    </td>
                    <td>
                    <a  class='editlink btn btn-info' href="/admin/dashboard/metatag_edit/{{$value->id}}">Փոփոխել</a>
                     
                    
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- <button type="submit" class="btn-info " >
Թարմացնել
        </button>
    </form>
             -->


</section>
@endsection