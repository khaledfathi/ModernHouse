@extends('layout.layout')
@section('title', 'تقرير مشروع')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/projectProfileReport.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/project/projectProfileReport.js') }}"></script>
@endsection

@section('content')
    <div class="container d-grid">
        @if ($record)
            <div class="blockA">
                <div>
                    <label for="">رقم العميل</label>
                    <p>{{ $record[0]->customer_id }}</p>
                </div>
                <div>
                    <label for="">رقم المشروع</label>
                    <p>{{ $record[0]->project_id }}</p>
                </div>
            </div>
            <div class="blockB">
                <div>
                    <label for="">اسم العميل</label>
                    <p>{{ $record[0]->customer_name }}</p>
                </div>
                <div>
                    <label for="">تليفون العميل</label>
                    <p>{{ $record[0]->customer_phone }}</p>
                </div>
            </div>

            <div class="blockC">
                <div>
                    <label for="">تاريخ التعاقد</label>
                    <p>{{ $record[0]->project_date }}</p>
                </div>
                <div>
                    <label for="">تاريخ التنفيذ</label>
                    <p>{{ $record[0]->start_date }}</p>
                </div>
                <div>
                    <label for="">تاريخ التسليم</label>
                    <p>{{ $record[0]->end_date }}</p>
                </div>
            </div>

            <div class="blockD">
                <div>
                    <label for="">المبلغ المتفق علية</label>
                    <p id="amount">{{ $record[0]->project_amount }}</p>
                </div>
            </div>
            <div class="blockE">
                <div>
                    <label for="">الخامات المطلوبة</label>
                    <div>{{ $record[0]->materials }}</div>
                </div>
            </div>
            <div class="blockF">
                <div>
                    <label for="">تفاصيل اخرى</label>
                    <div>{{ $record[0]->details }}</div>
                </div>
            </div>
        @endif

        <div class="transactionsBlock">
            <p>معاملات مالية</p>
            <table>
                <thead>
                    <th>تاريخ</th>
                    <th>وقت</th>
                    <th>المبلغ</th>
                </thead>
                <tbody>
                    @foreach ($record as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_date }}</td>
                            <td>{{ $transaction->time }}</td>
                            <td>{{ $transaction->transaction_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="totalDiv">
            <div>
                <label for="">اجمالى المدفوع</label>
                <p id="total">{{ $total ? $total : null }}</p>
            </div>
            <div>
                <label for="">المبلغ المستحق</label>
                <p id="remaining"></p>
            </div>
        </div>
        <div class="buttonBlock">
            <button class="printButton" onclick=window.print()>طباعة</button>
        </div>
    </div>
@endsection
