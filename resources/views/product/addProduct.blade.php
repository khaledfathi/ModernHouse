@extends('layout.layout')
@section('title', 'اضافة منتج')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/addProduct.css') }}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeProduct', 'active')


@section('content')
    <div class="container">
        <form action="newproduct" enctype="multipart/form-data">
            <div>
                <label for="">اسم المنتج</label>
                <input type="text" name="" id="">
            </div>
            <div>
                <label for="">وصف المنتج</label>
                <input type="text" name="" id="">
            </div>
            <div>
                <label for="">السعر</label>
                <input type="text" name="" id="">
            </div>
            <div>
                <label for="">صورة</label>
                <input type="file" name="" id="">
            </div>
            <div>
                image uploaded
            </div>
            <input type="submit" value="حفظ">
        </form>

    </div>
@endsection
