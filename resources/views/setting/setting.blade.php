@extends('layout.layout')
@section('title', 'اعدادات')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/setting/setting.css')}}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/setting/setting.js') }}"> </script>
@endsection
@section('activeSetting' , 'active')


@section('content')
    <div class="container">
        <a href="{{url('usersmanagment')}}">ادارة المستخدمين</a>
        <div>
            <p>تغيير الشعار</p>
            <form action="">
                <button id="uploadButton" type="button">رفع صورة</button>
                <input id="uploadInput" type="file" hidden>
                <img id="logoImage" src="{{Logo()}}" alt="new logo image">
                <input type="submit" value="تحديث">
            </form>
        </div>
        {{-- <p>clear/empty database</p> --}}
    </div>
@endsection
    