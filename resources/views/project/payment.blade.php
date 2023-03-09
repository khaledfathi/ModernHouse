@extends('layout.layout')
@section('title', 'اضافة عملية دفع')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/payment.css') }}">
@endsection


@section('content')
    <div class="container">
        <form action="">
            <div class="messageDiv">
                <p class="error">Error</p>
                <p class="ok">OK</p>
            </div>
            @csrf
            <div>
                <label for="">رقم المشروع</label>
                <input type="text" readonly class="readOnly">
            </div>
            <div>
                <label for="">رقم العميل</label>
                <input type="text" readonly class="readOnly">
            </div>
            <div>
                <label for="">اسم العميل</label>
                <input type="text" readonly class="readOnly">
            </div>
            <div>
                <label for="">تليفون العميل</label>
                <input type="text" readonly class="readOnly">
            </div>
            <div>
                <label for="">التاريخ</label>
                <input type="date">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time">
            </div>
            <div>
                <label for="">المبلغ</label>
                <input type="text">
            </div>
            <div>
                <label for="">تفاصيل اخرى</label>
                <textarea name=""></textarea>
            </div>
            <div>
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
@endsection
