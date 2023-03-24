@extends('layout.layout')
@section('title', 'ادارة المستخدمين')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/user.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/user/user.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            @elseif(session('ok'))
                <p class="ok">{{ session('ok') }}</p>
            @endif
        </div>
        <div class="addNewUserDiv">
            <a href="{{url('user')}}">اضافة مستخدم</a>
        </div>
        <div class="tableDiv">
            <table>
                <thead>
                    <th>اسم المستخدم</th>
                    <th>تليفون</th>
                    <th>نوع المستخدم</th>
                    <th>الحالة</th>
                    <th width="10%">تعديل</th>
                    <th width="10%">حذف</th>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->phone }}</td>
                            <td>{{ $record->type }}</td>
                            @if ($record->status == 'enabled')
                                <td>نشط</td>
                            @else 
                                <td>غير نشط</td>
                            @endif
                            <td><a href="{{url('user/'.$record->id)}}"><img src="{{asset('assets/images/svg/edit_icon.svg')}}" alt="edit"></a></td>
                            <td><img name='deleteButton' class="deleteButton" src="{{asset('assets/images/svg/delete_icon.svg')}}" alt="delete"></td>
                            <input name='deleteLink' type="hidden" value="{{ url('userdelete/' . $record->id) }}">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
