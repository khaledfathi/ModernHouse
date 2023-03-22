@extends('layout.layout')
@section('title', 'فاتورة')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/bill/bill.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/bill/bill.js') }}"></script>
@endsection
@section('activeBill', 'active')

@section('content')
    <div class="container">
        <div>
            {{-- <p>ERROR/OK</p> --}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <form class="d-grid" action="{{ url('newbill') }}" , method="get">
            @csrf
            <div class="dateTimeBlock">
                <div>
                    <label for="">التاريخ</label>
                    <input type="date" id="date" name="date">
                </div>
                <div>
                    <label for="">الوقت</label>
                    <input type="time" id="time" name="time">
                </div>
            </div>

            <div class="customerBlock">
                <div class="customerCheckBoxes">
                    <input type="checkbox" name="existCustomerCheck" id="existCustomerCheck">
                    <label for="existCustomerCheck">عميل مسجل</label>
                    <input type="checkbox" name="newCustomerCheck" id="newCustomerCheck">
                    <label for="newCustomerCheck">عميل جديد</label>
                </div>
                <div>
                    <label for="">العميل</label>
                    <input type="text" name="customerName" id="customerNameInput">
                </div>
                <div>
                    <label for="">تليفون</label>
                    <input type="text" name="customerPhone" id="customerPhoneInput">
                    <img src="{{ asset('assets/images/svg/exist_error_icon.svg') }}" alt="" width=25px
                        id="phoneExistIcon" hidden>
                </div>
            </div>


            <div id="productParentDiv" class="productParentDivBlock">
                <div id="productBlock" hidden>
                    <label for=""> رقم المنتج</label>
                    <input type="number" name="ProductId" id="productIdInput">
                    <img hidden src="" alt="Product Image" id="productImage" >
                    <label for="">الكمية</label>
                    <input type="number" name="quantity" id="quantity" value=1 min="0">
                    <label for="">سعر القطعة</label>
                    <input type="text" value=0 readonly>
                    <label for=""> الاجمالى</label>
                    <input type="text" name="total" readonly min="0" value="0">
                    <input type="hidden" id="productName">
                </div>
            </div>
            <input type="hidden" name="collectedProducts" id="collectedProducts"> {{-- collect products details --}}

            <div class="addProductButtonBlock">
                <button type="button" id="addProductButton">اضافة منتج</button>
            </div>

            <div class="invoiceValueBlock">
                <p id="invoiceValue">اجمالى الفاتورة 0 جنية</p>
            </div>

            <div class="saveButtonBlock">
                <input type="submit" value="تسجيل" id="saveButton">
            </div>
        </form>
    </div>
@endsection
