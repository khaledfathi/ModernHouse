@extends('layout.layout')
@section('title', 'مستخدم جديد')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/addUser.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection

@section('content')
    <div class="container">
        <a href="{{ url('usersmanagment') }}">الذهاب لادارة المستخدمين</a>
        <div class="errorBlock">
            @if ($errors->any())
                <p class="error">
                    @foreach ($errors->all() as $error)
                        - {{ $error }}<br>
                    @endforeach
                </p>
            @endif
        </div>
        <form class="d-grid" action="{{ url('newuser') }}" method="post">
            @csrf
            <div class="blockA">
                <div>
                    <label for="">اسم المستخدم</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label for="">تليفون</label>
                    <input type="text" name="phone">
                </div>
            </div>
            <div class="blockB">
                <div>
                    <label for="">كلمة المرور</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <label for="">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation">
                </div>
            </div>
            <div class="blockC">
                <div>
                    <label for="">النوع</label>
                    <select id="" name="type">
                        @foreach ($userTypes as $type)
                            <option value="{{ $type->value }}">{{ $type->value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="blockD">
                <div>
                    <label for="">الحالة</label>
                    <select id="" name="status">
                        @foreach ($userStatus as $status)
                            @if ($status->value == 'enabled')
                                <option selected value="{{ $status->value }}">نشط</option>
                            @else
                                <option value="{{ $status->value }}">غير نشط</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="buttonDiv">
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
@endsection
