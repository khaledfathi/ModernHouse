
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
    <form class="d-flex flex-col justify-content-center" action="">
        @csrf
        <p class="error">Errror</p>
        <p class="ok">OK</p>
        <div>
            <label for="">الاسم</label>
            <input type="text">
        </div>
        <div class="d-flex">
            <label for="">التليفون</label>
            <input type="text">
        </div>
        <div>
            <label class="lableTextArea" for="">العنوان</label>
            <textarea name="" id=""></textarea>
        </div>
      
        <div>
            <label class="lableTextArea" for="">الموقع</label>
            <input type="url" placeholder="رابط الموقع بخرائط جوجل">
        </div>
        <div>
            <label class="labelTextArea" for="">تفاصيل اخرى</label>
            <textarea name=""></textarea>
        </div>
        <div class="buttonsDiv">
            <button type="submit" value="save">حفظ</button>
            <button type="submit" value="saveAndAddProject">حفظ واضافة مشروع</button>
        </div>
    </form>
</div>
@endsection
    