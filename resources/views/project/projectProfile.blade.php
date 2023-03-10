@extends('layout.layout')
@section('title', 'ادارة مشروع')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/projectProfile.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
@endsection
@section('activeCustomer', 'active')

@section('content')
    <div class="projectContainer">
        <div>
            <label for="">رقم المشروع</label>
            <input type="text" name="" id="">
        </div>
        <div>
            <label for="">رقم العميل</label>
            <input type="text" name="" id="">
        </div>
        <div>
            <label for="">اسم العميل</label>
            <input type="text" name="" id="">
        </div>
        <div>
            <label for="">تليفون العميل</label>
            <input type="text" name="" id="">
        </div>
        <div>
            <label for="">التاريخ</label>
            <input type="date" name="" id="">
        </div>
        <div>
            <label for="">تاريخ البدء</label>
            <input type="date" name="" id="">
        </div>
        <div>
            <label for="">تاريخ التسليم</label>
            <input type="date" name="" id="">
        </div>
        <div>
            <label for="">المبلغ المتفق علية</label>
            <input type="text" name="" id="">
            <label for="">المبلغ المستحق</label>
            <input type="text" name="" id="">
        </div>
        <div>
            <label for="">الخامات المطلوبة</label>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="">تفاصيل اخرى</label>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="">حالة المشروع</label>
            <select name="" id="">
                <option value="">AAAA</option>
                <option value="">AAAA</option>
                <option value="">AAAA</option>
            </select>
        </div>
    </div>
    <div class="paymentsDiv">

    </div>

    </div>
    <div class="results">
        <h3>معاملات مالية</h3>
        <a href="">اضافة معاملة مالية</a>
        @if (true)
            @if (true)

                <table>
                    <thead>
                        <th>رقم المشروع</th>
                        <th>التاريخ</th>
                        <th>البدء</th>
                        <th>التسليم</th>
                        <th>المبلغ</th>
                        <th>الخامات</th>
                        <th>حالة المشروع</th>
                        <th>تفاصيل</th>
                        <th>عرض</th>
                    </thead>
                </table>
            @else
                <p>لا يوجد مشاريع لهذا العميل</p>
            @endif
        @endif
    </div>
@endsection
