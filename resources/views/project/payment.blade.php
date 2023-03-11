@extends('layout.layout')
@section('title', 'اضافة عملية دفع')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/payment.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/project/payment.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <form action="{{url('newpayment')}}" method="get">
            <div class="messageDiv">
                @if ($errors->any())
                    <p class="error">
                        @foreach ($errors->all() as $error)
                            - {{ $error}}<br>
                        @endforeach
                    </p>
                @endif
            </div>
            @csrf
            <div>
                <label for="">رقم المشروع</label>
                <input type="text" readonly class="readOnly" name="project_id"
                    value="{{ session('project') ? session('project')->id : null }}">
            </div>
            <div>
                <label for="">رقم العميل</label>
                <input type="text" readonly class="readOnly" name="customer_id"
                    value="{{ session('project') ? session('project')->customer_id : null }}">
            </div>
            <div>
                <label for="">اسم العميل</label>
                <input type="text" readonly class="readOnly"
                    value="{{ session('project') ? session('project')->customer_name : null }}">
            </div>
            <div>
                <label for="">تليفون العميل</label>
                <input type="text" readonly class="readOnly"
                    value="{{ session('project') ? session('project')->customer_phone : null }}">
            </div>
            <div>
                <label for="">التاريخ</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time" id="time" name="time">
            </div>
            <div>
                <label for="">المبلغ</label>
                <input class="amount" type="text" id="amount" name="amount" value=0>
                <label for="">المبلغ المستحق</label>
                <input class="remaining readOnly" type="text" id="remainingCalculated" readonly name="remaining"
                    value="{{ session('project') ? session('project')->remaining : null }}">
                <input type="hidden" id="remaining" value="{{ session('project') ? session('project')->remaining : null }}">
                <input type="hidden" id="projectAmount" value="{{ session('project') ? session('project')->amount : null }}">
            </div>
            <div>
                <label for="">تفاصيل اخرى</label>
                <textarea name="details"></textarea>
            </div>
            <div>
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
@endsection
