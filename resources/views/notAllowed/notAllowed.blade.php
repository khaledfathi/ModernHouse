@extends('layout.layout')
@section('title', 'غير مسموح')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection

@section('content')
<div class="container">
    <h1 style="color:red;text-align:center;margin:80px 0px;">غير مسموح بالوصول - لا تمتلك صلاحية لاستخدام هذه الصفحة</h1>
</div>
@endsection
