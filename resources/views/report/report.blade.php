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
        <div class="balanceBlock">
            <div>
                <h3>رصيد اليوم ({{ $todayBalance ? $todayBalance : 0 }} جنية )</h3>
                <p>ايرادات : {{ $todayDeposit ? $todayDeposit : 0 }} جنية </p>
                <p>مصروفات : {{ $todayWithdraw ? $todayWithdraw : 0 }} جنية </p>
            </div>
            <div>
                <h3>رصيد الشهر الحالى ({{ $currentMonthYear }}) - ({{ $thisMonthBalance ? $thisMonthBalance : 0 }} جنية)</h3>
                <p>ايرادات : {{ $thisMonthDeposit ? $thisMonthDeposit : 0 }} جنية</p>
                <p>مصروفات : {{ $thisMonthWithdraw ? $thisMonthWithdraw : 0 }} جنية</p>
            </div>
        </div>

        <div>
            <h3>الحركات المالية اليوم</h3>
            <div class="viewTableDiv">
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
                        <th>عرض</th>
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
                                    <td>
                                        @if ($transaction->project_id)
                                            <a href="{{ url('project/' . $transaction->project_id) }}"><img
                                                    src="assets/images/svg/view_icon.svg"></a>
                                        @elseif ($transaction->bill_id)
                                            <a href="{{ url('billprofile/' . $transaction->bill_id) }}"><img
                                                    src="assets/images/svg/view_icon.svg"></a>
                                        @else
                                            <a href="{{ url('transaction/' . $transaction->id) }}"><img
                                                    src="assets/images/svg/view_icon.svg"></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>


        <div>
            <h3> المشاريع المفتوحة ( {{ $projectsOpenCount ? $projectsOpenCount : 0 }} ) مشروع</h3>
            <div class="viewTableDiv">
                <table>
                    <thead>
                        <th width="20">رقم المشروع</th>
                        <th>تاريخ</th>
                        <th width="20">رقم العميل</th>
                        <th>اسم العميل</th>
                        <th>التليفون</th>
                        <th>عرض</th>
                    </thead>
                    <tbody>
                        @if ($projectsOpen)
                            @foreach ($projectsOpen as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->date }}</td>
                                    <td>{{ $project->customer_id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->phone }}</td>
                                    <td><a href="{{ url('project/' . $project->id) }}"><img
                                                src="assets/images/svg/view_icon.svg"></a></td>
                                    </td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3>مشاريع منتهية لديها مديونية
                ({{ $projectEndedWithIndebtednessCount ? $projectEndedWithIndebtednessCount : 0 }}) مشروع</h3>
            <div class="viewTableDiv">
                <table>
                    <thead>
                        <th width="20">رقم المشروع</th>
                        <th>تاريخ</th>
                        <th width="20">رقم العميل</th>
                        <th>اسم العميل</th>
                        <th>التليفون</th>
                        <th>عرض</th>
                    </thead>
                    <tbody>
                        @if ($projectEndedWithIndebtedness)
                            @foreach ($projectEndedWithIndebtedness as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->date }}</td>
                                    <td>{{ $project->customer_id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->phone }}</td>
                                    <td><a href="{{ url('project/' . $project->id) }}"><img
                                                src="assets/images/svg/view_icon.svg"></a></td>
                                    </td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3>مشاريع منتهية لم يتم تسليمها ({{ $projectsEndedNotDeliveredCount ? $projectsEndedNotDeliveredCount : 0 }})
                مشروع</h3>
            <div class="viewTableDiv">
                <table>
                    <thead>
                        <th width="20">رقم المشروع</th>
                        <th>تاريخ</th>
                        <th width="20">رقم العميل</th>
                        <th>اسم العميل</th>
                        <th>التليفون</th>
                        <th>عرض</th>
                    </thead>
                    <tbody>
                        @if ($projectsEndedNotDelivered)
                            @foreach ($projectsEndedNotDelivered as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->date }}</td>
                                    <td>{{ $project->customer_id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->phone }}</td>
                                    <td><a href="{{ url('project/' . $project->id) }}"><img
                                                src="assets/images/svg/view_icon.svg"></a></td>
                                    </td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3>مشاريع مؤجلة ({{ $projectsDelayedCount ? $projectsDelayedCount : 0 }}) مشروع</h3>
            <div class="viewTableDiv">
                <table>
                    <thead>
                        <th width="20">رقم المشروع</th>
                        <th>تاريخ</th>
                        <th width="20">رقم العميل</th>
                        <th>اسم العميل</th>
                        <th>التليفون</th>
                        <th>عرض</th>
                    </thead>
                    <tbody>
                        @if ($projectsDelayed)
                            @foreach ($projectsDelayed as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->date }}</td>
                                    <td>{{ $project->customer_id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->phone }}</td>
                                    <td><a href="{{ url('project/' . $project->id) }}"><img
                                                src="assets/images/svg/view_icon.svg"></a></td>
                                    </td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <div>
            <h3>عدد العملاء المسجلين ( {{ $customersCount ? $customersCount : 0 }} ) عميل</h3>
            <h3>عدد المشاريع المسجلة ( {{ $projectsCount ? $projectsCount : 0 }} ) مشروع</h3>
            <h3>عدد المنتجات المسجلة ( {{ $productsCount ? $productsCount : 0 }} ) منتج</h3>
            <h3>عدد الاصناف المسجلة ( {{ $categoriesCount ? $categoriesCount : 0 }} ) صنف</h3>
            <h3>اجمالى القطع بالمنتجات المتاحة ( {{ $itemsOnProductsCount ? $itemsOnProductsCount : 0 }} ) قطعة</h3>
        </div>

        <div hidden>
            <h3>مشاريع اقترب ميعاد تسليمها (5 ايام) Dev</h3>
        </div>

        <div hidden>
            <h3>عمليات اليوم monitoring table - Dev</h3>
        </div>

    </div>
@endsection
{{-- 
    <p>count products in count category</p>
    <p>project near to end (3 days)</p> --}}
