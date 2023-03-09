@extends('layout.layout')
@section('title', 'اضافة عملية دفع')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/payment.css') }}">
@endsection


@section('content')
<div class="container">
    <form action="">
        <div>
            <label for="">رقم المشروع</label>
            <input type="text">
        </div>
        <div>
            <label for="">رقم العميل</label>
            <input type="text">
        </div>
        <div>
            <label for="">اسم العميل</label>
            <input type="text">
        </div>
        <div>
            <label for="">تليفون العميل</label>
            <input type="text">
        </div>
        <div>
            <label for="">التاريخ</label>
            <input type="text">
        </div>
        <div>
            <label for="">الوقت</label>
            <input type="text">
        </div>
        <div>
            <label for="">المبلغ</label>
            <input type="text">
        </div>
        <div>
            <label for="">تفاصيل اخرى</label>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="حفظ">
        </div>
    </form>
</div>
@endsection
