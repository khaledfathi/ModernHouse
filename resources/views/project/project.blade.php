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
        <form class="d-grid" action="">
            <div class="messageDiv">
                <p class="error">Error</p>
                <p class="ok">OK</p>
            </div>
            @csrf
            <div class="customerDetails">
                <div>
                    <label for="">رقم العميل</label>
                    <input type="text" name="" id="" readonly value="{{ session('customer')->id }}">
                </div>
                <div>
                    <label for="">اسم العميل</label>
                    <input type="text" name="" id="" readonly value="{{ session('customer')->name }}">
                </div>
                <div>
                    <label for="">تليفون العميل</label>
                    <input type="text" name="" id="" readonly value="{{ session('customer')->phone }}">
                </div>
            </div>

            <div class="projectDates">
                <div>
                    <label for="">تاريخ التعاقد</label>
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
            </div>

            <div class="projectDetails">
                <div >
                    <label for="">المبلغ المتفق علية</label>
                    <input class="amount" type="text" name="" id="">
                </div>
                <div class="materialsDiv">
                    <label for="">الخامات المطلوبة</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="details ">
                    <label for="">تفاصيل اخرى</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <label for="">حالة المشروع</label>
                    <select name="" id="">
                        @foreach ($projectStatus as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="submitButtons">
                <button>حفظ</button>
                <button>حفظ ودفع</button>
            </div>
        </form>

    </div>
@endsection
