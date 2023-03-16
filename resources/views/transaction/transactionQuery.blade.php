@extends('layout.layout')
@section('title', 'استعلام مالى')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/transaction/transactionsQuery.js') }}"></script>
@endsection
@section('activeTransaction', 'active')


@section('content')
    <div class="container">
        <div>
            <p>error/ok</p>
            @if ($errors->any())
                <p>{{$errors->first()}}</p>
            @endif
        </div>
        <div class="query">
            <form action="{{ url('transactionfind') }}" method="get">
                <div>
                    <label for="">استعلام بـ</label>
                    <select name="queryFor" id="queryFor">
                        <option value="byId" selected>رقم العملية</option>
                        <option value="byDate">تاريخ العملية</option>
                    </select>
                </div>
                <div hidden id="transactionTypeList">
                    <label for="">نوع العملية</label>
                    <select name="transactionType" id="">
                        <option selected value="all">الكل</option>
                        @foreach ($transactionTypes as $type)
                            <option value="{{$type->id}}">{{$type->type}}</option>
                        @endforeach        
                    </select>
                </div>
                <div>
                    <div class="queryByIdDiv" id="queryByIdDiv">
                        <input type="text" name="findById">
                    </div>

                    <div class="queryByDateDiv" id="queryByDateDiv" hidden>
                        <input type="checkbox" name="period" id="periodCheck">
                        <label for="periodCheck">مدة</label>
                        <div>
                            <input type="date" name="findByDate">
                        </div>
                        <div id="toDate" hidden>
                            <label for="">الى</label>
                            <input type="date" name="findByToDate">
                        </div>
                    </div>
                </div>
                <input type="submit" value="استعلام">
            </form>
        </div>
        <div class="result">
            @if (session('data'))                
                        <table>
                            <thead>
                                    <td>رقم العملية</td>
                                    <td>التاريخ</td>
                                    <td>الوقت</td>
                                    <td>نوع العملية</td>
                                    <td>الحركة</td>
                                    <td>المبلغ</td>
                                    <td>مستند</td>
                                    <td>تفاصيل</td>
                                    <td>تعديل</td>
                                    <td>حذف</td>
                            </thead>
                            <tbody>
                                @foreach (session('data')['records'] as $record)
                                    <tr>
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->date}}</td>
                                        <td>{{$record->time}}</td>
                                        <td>{{$record->type}}</td>
                                        @if($record->direction == 'withdraw')
                                            <td>سحب</td>
                                        @elseif($record->direction == 'deposit')
                                            <td>ايداع</td>
                                        @endif
                                        <td>{{abs($record->amount)}}</td>
                                        <td>{{$record->document_image}}</td>
                                        <td>{{$record->details}}</td>
                                        <td><a href="">Edit</a></td>
                                        <td><a href="">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

            @endif
            @if(session('noResults'))
                <p>لا يوجد نتائج </p>
            @endif
        </div>
    </div>
@endsection
