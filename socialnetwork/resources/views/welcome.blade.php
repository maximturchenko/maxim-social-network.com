@extends('layouts.master')

@section('title')
    Hope hey la la la
@endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <h3>Зарегистрироваться</h3>
    <form action="{{route('signup')}}" method="post">
           @csrf
            <div class="form-group">
                <label for="email">Ваш E-Mail</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="first_name">Ваше имя</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
    <div class="col-md-6">
        <h3>Войти</h3>
        <form action="{{route('signin')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Ваш E-Mail</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
@endsection
