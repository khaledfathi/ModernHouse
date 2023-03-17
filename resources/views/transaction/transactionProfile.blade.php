@extends('layout.layout')
@section('title', 'تحديث معاملة مالية')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/transaction/transaction.css') }}">
@endsection
@section('scripts')
    <script src= "{{url('assets/js/transaction/transactionsUpdate.js')}}"></script>
@endsection

@section('content')
<div class="container d-grid">
    <div class="errorOkDiv">
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

    <form class="d-grid" action="{{ url('transactionupdate') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Date And Time Block --}}
        <div class="dateAndTimeBlock">
            <div>
                <label for="">رقم العملية</label>
                <input class="readOnly" type="text" readonly name="id" value="{{($record) ? $record->id : null}}">
            </div>
            <div>
                <label for="">التاريخ</label>
                <input type="date" name="date" id="date" value="{{($record) ? $record->date : null}}">
            </div>
            <div>
                <label for="">الوقت</label>
                <input type="time" name="time" id="time" value="{{($record) ? substr($record->time , 0,5) : null}}">
            </div>
        </div>

        <div class="transactionProcessBlock">
            <div>
                <label for="">نوع العملية</label>
                <select name="transaction_type" id="transaction_type">
                    @if ($transactionTypes->count() && $record)
                        @foreach ($transactionTypes as $type)
                            @if ($record->transaction_type_id == $type->id)
                                <option selected value="{{ $type->id }}">{{ $type->type }}</option>
                            @else
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label for="">المبلغ</label>
                <input type="text" name="amount" value="{{($record) ? abs($record->amount) : null}}">
            </div>
            <div class="transactionTypeDiv" id="transactionTypseDiv" {{($record->transaction_type_id == 1) ? null : 'hidden'}}>
                <label for="">الحركة </label>
                <input type="radio" name="direction" value="deposit" id="deposit" {{($record)? ( ($record->direction == 'deposit')? 'checked' : null) : null}}>
                <label for="deposit">ايداع</label>
                <input type="radio" name="direction" value="withdraw" id="withdraw" {{($record)? ( ($record->direction == 'withdraw')? 'checked' : null) : null}}>
                <label for="withdraw">سحب</label>
            </div>
        </div>

        <div class="docImageBlock">
            <button type="button" id="uploadDocButton">صورة مستند</button>
            <input id="browseFile" hidden type="file" name="documentImage">
            <div class="docPreview">
                @if ($record)
                    <img id="documentImage" src="{{($record->document_image) ? asset($record->document_image) : asset('assets/images/default/default.jpg')}}" alt="Document Image">
                @endif 
            </div>
        </div>

        <div class="detailsBlock">
            <label for="">تفاصيل العملية</label>
            <textarea name="details" id="" cols="30" rows="10">{{($record) ? $record->details : null}}</textarea>
        </div>

        <div class="buttonBlock">
            <input type="submit" value="تحدث">
            <input type="submit" value="حذف">
            <input type="hidden" value="{{($record) ? url('transactiondelete/'.$record->id) : null}}">
        </div>
    </form>
</div>
@endsection
