@extends('layout.layout')
@section('title', 'عرض الفاتورة')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/bill/billPreview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bill/billProfile.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/bill/billProfile.js') }}"></script>
@endsection

@section('content')
    <div class="container d-grid">
        <div class="blockA">
            <p>فاتورة رقم : {{ $fullBill[0]->id }}</p>
            <p> تاريخ : {{ $fullBill[0]->date }}</p>
            <p> توقيت : {{ $fullBill[0]->time }}</p>
        </div>
        <div class="blockB">
            <p> عميل : {{ $fullBill[0]->customer_name }}</p>
            <p> تليفون : {{ $fullBill[0]->customer_phone }}</p>
        </div>
        <div class="resultDiv">
            <table>
                <thead>
                    <th>المنتج</th>
                    <th width="20%">الكمية</th>
                    <th width="20%">سعر القطعة</th>
                    <th width="20%">الاجمالى</th>
                </thead>
                <tbody>
                    @foreach ($fullBill as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="totalInvoice">اجمالى قيمة الفاتورة : {{ $totalInvoice }}</p>
        <button class="printButton" onclick="window.print()">طابعة الفاتورة</button>
        <button class="deleteButton" , id="deleteButton">حذف الفاتورة</button>
        <input id="deleteLink" type="hidden" value="{{url('billdelete/'.$fullBill[0]->id)}}">
    </div>
@endsection
