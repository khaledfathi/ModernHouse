@extends('layout.layout')
@section('title', 'اضافة عملية دفع')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/payment.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('assets/js/project/payment.js')}}"></script>
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
                <input type="text" readonly class="readOnly" @if (session('project')) ? value="{{ session('project')->id }}" : value='' @endif>
            </div>
            <div>
                <label for="">رقم العميل</label>
                <input type="text" readonly class="readOnly" @if (session('project')) ? value="{{ session('project')->customer_id }}" : value='' @endif>
            </div>
            <div>
                <label for="">اسم العميل</label>
                <input type="text" readonly class="readOnly" @if (session('project')) ? value="{{ session('project')->customer_name }}" : value='' @endif>
            </div>
            <div>
                <label for="">تليفون العميل</label>
                <input type="text" readonly class="readOnly" @if (session('project')) ? value="{{ session('project')->customer_phone }}" : value='' @endif>
            </div>
            <div>
                <label for="">التاريخ</label>
                <input type="date" id="date">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time" id="time"> 
            </div>
            <div>
                <label for="">المبلغ</label>
                <input class="amount" type="text">
                <label for="">المبلغ المستحق</label>
                <input class="remaining readOnly" type="text" readonly>
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
