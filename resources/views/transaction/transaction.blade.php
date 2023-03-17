@extends('layout.layout')
@section('title', 'ماليات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/transaction/transaction.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/transaction/transactions.js') }}"></script>
@endsection
@section('activeTransaction', 'active')


@section('content')
    <div class="container d-grid">
        <div class="errorOkDiv">
            <a href="{{ url('transactionquery') }}">استعلام مالى</a>
            @if ($errors->any())
                <p class="error">
                    @foreach ($errors->all() as $error)
                        - {{ $error }}<br>
                    @endforeach
                </p>
            @elseif(session('ok'))
                <p class="ok">{{ session('ok') }}</p>
            @endif
        </div>

        <div class="balanceDiv">
            <h3>رصيد اليوم ( {{ $todayBalance }} ) جنية</h3>
        </div>

        <form class="d-grid" action="{{ url('newtransaction') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Date And Time Block --}}
            <div class="dateAndTimeBlock">
                <div>
                    <label for="">التاريخ</label>
                    <input type="date" name="date" id="date">
                </div>
                <div>
                    <label for="">الوقت</label>
                    <input type="time" name="time" id="time">
                </div>
            </div>

            <div class="transactionProcessBlock">
                <div>
                    <label for="">نوع العملية</label>
                    <select name="transaction_type" id="transaction_type">
                        @if ($transactionTypes->count())
                            @foreach ($transactionTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label for="">المبلغ</label>
                    <input type="text" name="amount">
                </div>
                <div class="transactionTypeDiv" id="transactionTypseDiv">
                    <label for="">الحركة </label>
                    <input type="radio" name="direction" value="deposit" id="deposit" checked>
                    <label for="deposit">ايداع</label>
                    <input type="radio" name="direction" value="withdraw" id="withdraw">
                    <label for="withdraw">سحب</label>
                </div>
            </div>

            <div class="docImageBlock">
                <button type="button" id="uploadDocButton">صورة مستند</button>
                <input id="browseFile" hidden type="file" name="documentImage">
                <div class="docPreview">
                    <img id="documentImage" src="" alt="Document Image">
                </div>
            </div>

            <div class="detailsBlock">
                <label for="">تفاصيل العملية</label>
                <textarea name="details" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="buttonBlock">
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
@endsection
