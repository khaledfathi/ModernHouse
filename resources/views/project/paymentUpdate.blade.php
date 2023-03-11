@extends('layout.layout')
@section('title', 'تعديل عملية دفع')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/payment.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/project/paymentUpdate.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <form action="{{url('paymentupdate')}}" method="get">
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
                <label for="">رقم العملية</label>
                <input type="text" readonly class="readOnly" name="id"
                    value="{{$transaction->id}}">
            </div>
            <div>
                <label for="">رقم المشروع</label>
                <input type="text" readonly class="readOnly" name="project_id"
                    value="{{$project->id}}">
            </div>
            <div>
                <label for="">رقم العميل</label>
                <input type="text" readonly class="readOnly" name="customer_id"
                    value="{{$customer->id }}">
            </div>
            <div>
                <label for="">اسم العميل</label>
                <input type="text" readonly class="readOnly"
                    value="{{$customer->name}}">
            </div>
            <div>
                <label for="">تليفون العميل</label>
                <input type="text" readonly class="readOnly"
                    value="{{$customer->phone}}">
            </div>
            <div>
                <label for="">التاريخ</label>
                <input type="date" id="date" name="date" value="{{$transaction->date}}">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time" id="time" name="time" value="{{substr($transaction->time, 0, -3)}}">
            </div>
            <div>
                <label for="">المبلغ</label>
                <input class="amount" type="text" id="amount" name="amount" value="{{$transaction->amount}}">
                <label for="">المبلغ المستحق</label>
                <input class="remaining readOnly" type="text" id="remainingCalculated" readonly name="remaining" value="{{$remaining}}">
                <input type="hidden" id="remaining" value="{{$remaining}}">
                <input type="hidden" id="projectAmount" value="{{$project->amount}}">
            </div>
            <div>
                <label for="">تفاصيل اخرى</label>
                <textarea name="details">{{$transaction->details}}</textarea>

            </div>
            <div>
                <input type="submit" value="تحديث">
                <a href="{{url('paymentdelete/'.$transaction->id.'?project_id='.$project->id)}}">حذف</a>
                
            </div>
        </form>
    </div>
@endsection
