
@extends('layout.layout')
@section('title', 'اضافة عميل')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/customer/customer.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeCustomer' , 'active')


@section('content')
<div class="container">
    <form class="d-flex flex-col justify-content-center" action="{{url('newcustomer')}}" method="get">
        @csrf
        @if ($errors->any())
            <p class="error">
            @foreach ($errors->all() as $error)
                - {{$error}}<br>
            @endforeach
            </p>
        @endif
        <div>
            <label for="">الاسم</label>
            <input type="text" name="name" value="">
        </div>
        <div class="d-flex">
            <label for="">التليفون</label>
            <input type="text" name="phone" value="">
        </div>
        <div>
            <label class="lableTextArea" for="">العنوان</label>
            <textarea  name="address"></textarea>
        </div>
        <div>
            <label class="lableTextArea" for="" >الموقع</label>
            <input type="text" placeholder="رابط الموقع بخرائط جوجل" name="coordinates" value="">
        </div>
        <div>
            <label class="labelTextArea" for="">تفاصيل اخرى</label>
            <textarea name="details"></textarea>
        </div>
        <div class="buttonsDiv">
            <button type="submit" name="direction" value="save">حفظ</button>
            <button type="submit" name="direction" value="saveAndAddProject">حفظ واضافة مشروع</button>
        </div>
    </form>
</div>
@endsection
    