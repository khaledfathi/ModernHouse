@extends('layout.layout')
@section('title', 'فاتورة')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/bill/bill.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('assets/js/bill/bill.js')}}"></script>
@endsection
@section('activeBill', 'active')

@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            @endif
        </div>
        <form action="{{url('newbill')}}" , method="get">
            @csrf
            <div>
                <label for="">التاريخ</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time" id="time" name="time">
            </div>
            <div>
                <input type="checkbox" name="existCustomerCheck" id="existCustomerCheck" >
                <label for="existCustomerCheck">عميل مسجل</label>
                <input type="checkbox" name="" id="newCustomerCheck">
                <label for="newCustomerCheck">عميل جديد</label>
            </div>
            <div>
                <label for="">العميل</label>
                <input type="text" name="customerName" id="customerNameInput">
            </div>
            <div>
                <label for="">تليفون</label>
                <input type="text" name="customerPhone" id="customerPhoneInput">
                <img src="{{asset('assets/images/svg/exist_error_icon.svg')}}" alt="" width=25px id="phoneExistIcon" hidden>
            </div>
            <div id="productParentDiv">
                <div id="productBlock">
                    <label for=""> رقم المنتج</label>
                    <input type="text" name="ProductId">
                    <label for="">الكمية</label>
                    <input type="number" name="quantity">
                    <img src="" alt="Product Image" id="productImage">
                </div>
                <input type="hidden" name="products">
            </div>
            <div>
                <button type="button" id="addProductButton">اضافة منتج</button>
            </div>
            <div>
                <input type="submit" value="تسجيل">
            </div>
        </form>
    </div>
@endsection
