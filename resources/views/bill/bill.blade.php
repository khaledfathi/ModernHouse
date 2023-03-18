@extends('layout.layout')
@section('title', 'فاتورة')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/bill/bill.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeBill' , 'active')


@section('content')
<div class="container">
    <form action="">
        <div>
            <label for="">التاريخ</label>
            <input type="date">
        </div>
        <div>
            <label for="">الوقت</label>
            <input type="time">
        </div>
        <div>
            <label for="">العميل</label>
            <input type="text">
        </div>
        <div>
            <label for="">تليفون</label>
            <input type="text">
            <input type="checkbox" name="" id="">
            <label for="">عميل مسجل</label>
        </div>
        <div>
            <label for=""> رقم المنتج</label>
            <input type="text">
            <label for="">الكمية</label>
            <input type="text">
        </div>
        <div>
            <input type="submit" value="تسجيل">
        </div>
    </form>
</div>
@endsection
    