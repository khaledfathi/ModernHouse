@extends('layout.layout')
@section('title', 'تقارير')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/report/report.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeReport' , 'active')


@section('content')
<div class="container">
    <div style="border:1px solid black;">
        <p>الحركات المالية اليوم</p>        
        <table>
            <thead>
                <th>نوع العملية</th>
                <th>رقم العملية</th>
                <th>تاريخ</th>
                <th>وقت</th>
                <th>رقم العميل</th>
                <th>رقم المشروع</th>
                <th>الحركة</th>
            </thead>
        </table>
    </div>

    <div style="border:1px solid black;">
        <h3>رصيد اليوم (100 جنية )</h3>
        <p>ايرادات | مصروفات</p>
    </div>

    <div style="border:1px solid black;">
        <h3>رصيد الشهر الحالى (مارس 2023) - (1000 جنية)</h3>
        <p>ايرادات | مصروفات</p>
    </div>

    <div style="border:1px solid black;">
        <h3>عمليات اليوم</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>عدد العملاء المسجلين (320) عميل</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>عدد المنتجات المسجلة</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>عدد الاصناف المسجلة</h3>
    </div>

    <div>
        <h3>اجمالى اعداد المنتجات المتاحة</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>عدد المشاريع المسجلة (902) مشروع</h3>
    </div>

    <div style="border:1px solid black;">
        <h3> المشاريع المفتوحة</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>مشاريع اقترب ميعاد تسليمها (5 ايام)</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>مشاريع منتهية لم يتم تسليمها</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>مشاريع لديها مديونية</h3>
    </div>

    <div style="border:1px solid black;">
        <h3>مشاريع مؤجلة</h3>
    </div>

</div>
@endsection
    {{-- 
    <p>count products in count category</p>
    <p>project near to end (3 days)</p> --}}