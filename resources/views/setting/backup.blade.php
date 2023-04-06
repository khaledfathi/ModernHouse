@extends('layout.layout')
@section('title', 'النسخ الاحتياطى')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection
@section('activeSetting', 'active')


@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
                
            @endif
        </div>
        <div class="export">
            <h3>تصدير قاعدة البيانات</h3>
            {{-- <label for="">اخر عملية نسخ احتياطى داخلى 10/01/2022 - 21:32</label> --}}
            <a href="{{url('exportdb')}}">تصدير</a>
        </div>
        <div class="import">
            <h3>استيراد قاعدة البيانات</h3>
            <form action="{{url('importdb')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="sqlFile">
                <input type="submit" value="استيراد">
                <p><span>تحذير </span>سيتم استبدال قاعدة البيانات الحالية </p>                

            </form>
        </div>
        <div>
            <h3>تدمير قاعدة البيانات</h3>
            <button>تدمير قاعدة البيانات</button>
            <p>سيتم حذف كل البيانات والحسابات والمشاريع والمنتجات والمستخدمين</p>
        </div>
    </div>
@endsection
