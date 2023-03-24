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
    </div>
    <h1>SETTING PAGE</h1>
    <p>app info [ver .. etc]</p>
    <p>change logo</p>
    <p>process monitoring</p>
    <p>Manage All Tables</p>
@endsection
    