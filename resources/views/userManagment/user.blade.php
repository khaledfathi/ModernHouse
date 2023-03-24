@extends('layout.layout')
@section('title', 'مستخدم جديد')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection

@section('content')
    <div class="container">
        <a href="{{url('usersmanagment')}}">الذهاب لادارة المستخدمين</a>
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            @endif
        </div>
        <form action="{{url('newuser')}}" method="post">
            @csrf
            <div>
                <label for="">اسم المستخدم</label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="">تليفون</label>
                <input type="text" name="phone">
            </div>
            <div>
                <label for="">كلمة المرور</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation">
            </div>
            <div>
                <label for="">النوع</label>
                <select id="" name="type">                    
                    @foreach ($userTypes as $type)                
                        <option value="{{$type->value}}">{{$type->value}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">الحالة</label>
                <select   id="" name="status">
                    @foreach ($userStatus as $status)
                        @if ($status->value == 'enabled')
                            <option selected value="{{$status->value}}">نشط</option>
                        @else
                            <option value="{{$status->value}}">غير نشط</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
@endsection
