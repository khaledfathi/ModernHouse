@extends('layout.layout')
@section('title', Auth::user()->name.' | الملف الشخصى')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/profile/profile.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection

@section('content')
<div class="container ">
    <div class="messages">
        @if($errors->any())
            <p class="error">{{$errors->first()}}</p>
        @elseif(session('ok'))
            <p class="ok">{{session('ok')}}</p>
        @endif
    </div>
    <form action="{{url('changepassword')}}">
        <div>
            <h3>تغيير كلمة المرور</h3>
        </div>
        <div>
            <label for="">كلمة المرور</label>
            <input type="password" name="oldPassword">
        </div>
        <div>
            <label for="">كلمة المرور الجديدة</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation">
        </div>
        <div>
            <input type="submit" value="تغيير">
        </div>
    </form>

    <form action="changephone">
        <div>
            <h3>تغير رقم التليفون</h3>
        </div>
        <div>
            <label for="">رقم التليفون</label>
            <input type="text" name="phone" value="{{$phone}}">
        </div>
        <div>
            <input type="submit" value="تغيير">
        </div>
    </form>

</div>
@endsection
    