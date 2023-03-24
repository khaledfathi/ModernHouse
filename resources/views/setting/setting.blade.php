@extends('layout.layout')
@section('title', 'اعدادات')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/setting/setting.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeSetting' , 'active')


@section('content')
    <div class="container">
        <a href="{{url('usersmanagment')}}">ادارة المستخدمين</a>
        <p>change logo</p>
        <p>clear/empty database</p>
    </div>
@endsection
    