@extends('layout')

@section('content')


<!--    <section id="login-professor">
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<div class="container">
<div class="login">
    <form action="{{ route('login',app()->getLocale())}}" method="POST">
        @csrf
        <div class="login-grid">
            <div class="log-img">
                <img src="/img/Avatar.svg" alt="">
                <p class="log-in">Մուտք գործել</p>
            </div>
            <div class="form-group">
                <label for="professor_login_email">Էլ.հասցե</label>
                <input type="email" name="email" id="professor_login_email"  class="styled-inputtext">
                </div>
                <div class="form-group">
                    <label for="professor_login_password">Գաղտնաբառ</label>
                    <input type="password" name="password" id="professor_login_password"  class="styled-inputtext">
                    </div>
                <button type="submit" class="login-but">Մուտք</button>
                <a href="/{{app()->getLocale()}}/register" class="for-reg">Գրանցում դասախոսների համար</a>
        </div>
    </form>
</div>
</div>
    </section>-->


        @endsection