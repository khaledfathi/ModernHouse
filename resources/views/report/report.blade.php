@extends('layout.layout')
@section('title', 'تقارير')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/report/report.css') }}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeReport', 'active')


@section('content')
    <div class="container">
        <div>
            <p>الحركات المالية اليوم</p>
            <div class="transactionTodayTableDiv">
                <table>
                    <thead>
                        <th>تاريخ</th>
                        <th>وقت</th>
                        <th>نوع العملية</th>
                        <th>المبلغ</th>
                        <th>الحركة</th>
                        <th width="50">رقم العملية</th>
                        <th width="50">رقم الفاتورة</th>
                        <th width="50">رقم المشروع</th>
                    </thead>
                    <tbody>
                        @if ($todayTransactions)
                            @foreach ($todayTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->time }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ abs($transaction->amount) }}</td>
                                    @if ($transaction->direction == 'deposit')
                                        <td>ايداع</td>
                                        @elseif ($transaction->direction == 'withdraw')
                                        <td>سحب</td>
                                    @endif
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->bill_id }}</td>
                                    <td>{{ $transaction->project_id }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3>رصيد اليوم ({{($todayBalance)?$todayBalance:0}} جنية )</h3>
            <p>ايرادات : {{($todayDeposit)?$todayDeposit:null}}</p>
            <p>مصروفات : {{($todayWithdraw)?$todayWithdraw:null}}</p>
        </div>

        <div>
            <h3>رصيد الشهر الحالى (مارس 2023) - (1000 جنية)</h3>
            <p>ايرادات | مصروفات</p>
        </div>

        <div>
            <h3>عمليات اليوم monitoring table</h3>
        </div>

        <div>
            <h3>عدد العملاء المسجلين ( {{($customersCount)?$customersCount:0}} ) عميل</h3>
        </div>

        <div>
            <h3>عدد المنتجات المسجلة ( {{($productsCount)?$productsCount:0}} ) منتج</h3>
        </div>

        <div>
            <h3>عدد الاصناف المسجلة ( {{($categoriesCount)?$categoriesCount:0}} ) صنف</h3>
        </div>

        <div>
            <h3>اجمالى القطع بالمنتجات المتاحة ( {{($itemsOnProductsCount)?$itemsOnProductsCount:0}} ) قطعة</h3>
        </div>

        <div>
            <h3>عدد المشاريع المسجلة ( {{($projectsCount)?$projectsCount:0 }} ) مشروع</h3>
        </div>

        <div>
            <h3> المشاريع المفتوحة ( {{($projectsOpenCount)?$projectsOpenCount:0}} ) مشروع</h3>
        </div>

        <div>
            <h3>مشاريع اقترب ميعاد تسليمها (5 ايام)</h3>
        </div>

        <div>
            <h3>مشاريع منتهية لم يتم تسليمها</h3>
        </div>

        <div>
            <h3>مشاريع لديها مديونية</h3>
        </div>

        <div>
            <h3>مشاريع مؤجلة</h3>
        </div>

    </div>
@endsection
{{-- 
    <p>count products in count category</p>
    <p>project near to end (3 days)</p> --}}
