@extends('layout.layout')
@section('title', 'اعدادات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/setting/setting.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/setting/setting.js') }}"></script>
@endsection
@section('activeSetting', 'active')


@section('content')
    <div class="container">
        <a class="userManagmentButton" href="{{ url('usersmanagment') }}">ادارة المستخدمين</a>
        <div>
            @if ($errors->any())
                <p>{{ $errors->first() }}</p>
            @elseif (session('ok'))
                <p>{{ session('ok') }}</p>
            @endif
        </div>
        <form action="logoupdate" method="post" enctype="multipart/form-data">
            @csrf
            <a id="uploadButton" type="button"><img class="uploadButtonIcon"
                    src="{{ url('assets/images/svg/upload_icon.svg') }}" alt=""></a>
            <input name="logoImage" id="uploadInput" type="file" hidden>
            <img id="logoImage" src="{{ Logo() }}" alt="new logo image">
            <input type="submit" value="تحديث">
        </form>
        <div class="appInfo">
            <p>App Version : 1.0 Beta</p>
            <p>Technology : PHP 8.2 | Laravel 10.2</p>
            <p>Support : dev@khaledfathi.com</p>
        </div>
        {{-- <p>clear/empty database</p> --}}
    </div>
@endsection
