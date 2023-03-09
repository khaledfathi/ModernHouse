@extends('layout.layout')
@section('title', 'اضافة مشروع')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/project.css') }}">
@endsection
@section('links')
    <script src="#"></script>
@endsection


@section('content')
    <div class="container">
        <form class="d-grid" action="newproject" , method="get">
            <div class="messageDiv">
                @if ($errors->any())
                    <p class="error">
                        @foreach ($errors->all() as $error)
                            - {{ $error }}<br>
                        @endforeach
                    </p>
                @elseif (session('ok'))
                    <p class="ok">{{ session('ok') . ' - رقم المشروع ( ' . session('id') . ' )' }}</p>
                @endif
            </div>
            @csrf
            <div class="customerDetails">
                <div>
                    <label for="">رقم العميل</label>
                    <input type="text" name="customer_id" id="" readonly
                        @if (session('customer')) ? value="{{ session('customer')->id }}" : value='' @endif>
                </div>
                <div>
                    <label for="">اسم العميل</label>
                    <input type="text" name="customer_name" id="" readonly
                        @if (session('customer')) ? value="{{ session('customer')->name }}" : value='' @endif>
                </div>
                <div>
                    <label for="">تليفون العميل</label>
                    <input type="text" name="customer_phone" id="" readonly
                        @if (session('customer')) ? value="{{ session('customer')->phone }}" : value='' @endif>
                </div>
            </div>

            <div class="projectDates">
                <div>
                    <label for="">تاريخ التعاقد</label>
                    <input type="date" name="date" id="">
                </div>
                <div>
                    <label for="">تاريخ البدء</label>
                    <input type="date" name="start_date" id="">
                </div>
                <div>
                    <label for="">تاريخ التسليم</label>
                    <input type="date" name="end_date" id="">
                </div>
            </div>

            <div class="projectDetails">
                <div>
                    <label for="">المبلغ المتفق علية</label>
                    <input class="amount" type="text" name="amount" id="">
                </div>
                <div class="materialsDiv">
                    <label for="">الخامات المطلوبة</label>
                    <textarea name="materials" id=""></textarea>
                </div>
                <div class="details ">
                    <label for="">تفاصيل اخرى</label>
                    <textarea name="details"></textarea>
                </div>
                <div>
                    <label for="">حالة المشروع</label>
                    <select name="project_status" id="">
                        @foreach ($projectStatus as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="submitButtons">
                <button type="sumbit" name="direction" value="save">حفظ</button>
                <button type="submit" name="direction" value="saveAndAddPay">حفظ ودفع</button>
            </div>
        </form>

    </div>
@endsection
