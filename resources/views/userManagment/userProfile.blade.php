@extends('layout.layout')
@section('title', 'تحديث مستخدم')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/addUser.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/userProfile.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/user/userProfile.js') }}"></script>
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
            @elseif (session('ok'))
                <p class="ok">{{session('ok')}}</p>
            @endif
        </div>
        <form class="d-grid" action="{{ url('userupdate') }}" method="post">
            @csrf
            <div class="blockA">
                <div>
                    <input type="hidden" value="{{($record)?$record->id:null}}" name="id" >
                    <label for="">اسم المستخدم</label>
                    <input type="text" name="name" value = "{{($record)?$record->name:null}}">
                </div>
                <div>
                    <label for="">تليفون</label>
                    <input type="text" name="phone" value = "{{($record)?$record->phone:null}}">
                </div>
            </div>
            <div class="blockB">
                <div>
                    <label for="">كلمة المرور</label>
                    <input type="password" name="password" placeholder="حقل فارغ يعنى بدون تحديث">
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
                            @if ($record->type == $type->value)
                                <option selected value="{{ $type->value }}">{{ $type->value }}</option>
                            @else
                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                            @endif
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
                                @if ($record->status == $status->value)
                                    <option selected value="{{ $status->value }}">نشط</option>
                                @else
                                    <option value="{{ $status->value }}">نشط</option>
                                @endif
                            @else
                                @if ($record->status == $status->value)
                                    <option selected value="{{ $status->value }}">غير نشط</option>
                                @else 
                                    <option value="{{ $status->value }}">غير نشط</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="buttonDiv">
                <input type="submit" value="تحديث">
                <button id="deleteButton" class="deleteButton" type="button">حذف</button>
                <input id="deleteLink" type="hidden" value="{{url('userdelete/'.$record->id)}}">
            </div>
        </form>
    </div>
@endsection
