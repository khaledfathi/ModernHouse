
@extends('layout.layout')
@section('title', 'ماليات')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/transaction/transaction.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeTransaction' , 'active')


@section('content')
<div class="container">
    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error) 
                <p>- {{$error}}<br></p>
            @endforeach
        @endif
        <p>ERROR/OK</p>
    </div>
    <div>
        <h3>رصيد اليوم ( {{$todayBalance}} ) جنية</h3>
    </div>
    <form action="{{url('newtransaction')}}" method="get">
        @csrf
        <div>
            <label for="">التاريخ</label>
            <input type="date" name="date">
        </div>
        <div>
            <label for="">الوقت</label>
            <input type="time" name="time">
        </div>
        <div>
            <label for="">نوع العملية</label>
            <select name="transaction_type">
                @if ($transactionTypes->count())
                    @foreach ($transactionTypes as $type)
                        <option value="{{$type->id}}">{{$type->type}}</option> 
                    @endforeach
                @endif
            </select>
        </div>
        <div>
            <label for="">المبلغ</label>
            <input type="text" name="amount">
        </div>
         <div>
            <input type="radio" name="direction" value="deposit" id="deposit" checked>
            <label for="deposit">ايداع</label>
            <input type="radio" name="direction" value="withdraw" id="withdraw">
            <label for="withdraw">سحب</label>
        </div>
       <div>
            <label for="">تفاصيل العملية</label>
            <textarea name="details" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="حفظ">
        </div>
    </form>
</div>
@endsection
    