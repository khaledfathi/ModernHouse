@extends('layout.layout')
@section('title', 'استعلام مالى')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/transaction/transactionQuery.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/transaction/transactionsQuery.js') }}"></script>
@endsection


@section('content')
    <div class="container d-flex">
        <a class="backToTransactionButton" href="{{url('transaction')}}">عودة للماليات</a>
        <div class="query">
            <div class="errorOkDiv">
                @if ($errors->any())
                    <p class="error">{{ $errors->first() }}</p>
                @endif
            </div>

            <form action="{{ url('transactionfind') }}" method="get">
                <div class="queryForBlock">
                    <label for="">استعلام بـ</label>
                    <select name="queryFor" id="queryFor">
                        <option value="byId" selected>رقم العملية</option>
                        <option value="byDate">تاريخ العملية</option>
                    </select>
                    <div hidden id="transactionTypeList">
                        <label for="">نوع العملية</label>
                        <select name="transactionType" id="">
                            <option selected value="all">الكل</option>
                            @foreach ($transactionTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="findBlock">
                    <div class="queryByIdDiv" id="queryByIdDiv">
                        <input type="text" name="findById">
                    </div>

                    <div class="queryByDateDiv" id="queryByDateDiv">
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

        {{-- Results --}}
        <div class="results">
            @if (session('data'))
                <table>
                    <thead>
                        <th>رقم العملية</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>نوع العملية</th>
                        <th>الحركة</th>
                        <th>المبلغ</th>
                        <th>مستند</th>
                        <th>تفاصيل</th>
                        <th>عرض</th>
                    </thead>
                    <tbody>
                        @foreach (session('data')['records'] as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->date }}</td>
                                <td>{{ $record->time }}</td>
                                <td>{{ $record->type }}</td>
                                @if ($record->direction == 'withdraw')
                                    <td>سحب</td>
                                @elseif($record->direction == 'deposit')
                                    <td>ايداع</td>
                                @endif
                                <td>{{ abs($record->amount) }}</td>
                                @if ($record->document_image)
                                    <td><img class="docImage" src="{{ asset($record->document_image) }}" alt="DocImage"></td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $record->details }}</td>
                                <td><a href="{{ url('transaction/' . $record->id) }}"><img class="inTableIcon" src="{{asset('assets/images/svg/view_icon.svg')}}" alt=""></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (session('noResults'))
                <p>لا يوجد نتائج </p>
            @endif
        </div>
    </div>
@endsection
