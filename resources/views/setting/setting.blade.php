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
    <h1>SETTING PAGE</h1>
    <p>import/export[html , csv , sql] DB</p>
    <p>internal backup [each period]</p>
    <p>manage users [protect admin from delete]</p>
    <p>app info [ver .. etc]</p>
    <p>change logo</p>
    <p>changeStyle(o)</p>
@endsection
    