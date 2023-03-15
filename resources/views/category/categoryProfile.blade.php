@extends('layout.layout')
@section('title', 'تحديث صنف')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/category/category.css') }}">
@endsection
@section('scripts')
    <script src="{{ url('assets/js/category/category.js') }}"></script>
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div class="newCategory">
            <form action="{{ url('categoryupdate') }}">
                @if ($errors->any())
                    <p class="error">{{ $errors->first() }}</p>
                @endif
                <input type="hidden" name="id" value="{{($record)?$record->id:null}}">
                <div>
                    <label for="">اسم الصنف</label>
                    <input type="text" name="name" value="{{($record)?$record->name:null}}">
                </div>                
                <input type="submit" value="تحديث">
            </form>
        </div>
    </div>
@endsection
