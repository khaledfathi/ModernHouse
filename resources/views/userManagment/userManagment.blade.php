@extends('layout.layout')
@section('title', 'ادارة المستخدمين')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @elseif(session('ok'))
                <p>{{ session('ok') }}</p>
            @endif
        </div>
        <div>
            <a href="{{url('user')}}">اضافة مستخدم</a>
        </div>
        <div class="tableDiv">
            <table>
                <thead>
                    <th>اسم المستخدم</th>
                    <th>تليفون</th>
                    <th>نوع المستخدم</th>
                    <th>الحالة</th>
                    <th>تعديل</th>
                    <th>حذف</th>
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
                            <td><a href="">Edit</a></td>
                            <td><a href="{{ url('userdelete/' . $record->id) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
