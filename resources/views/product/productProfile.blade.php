@extends('layout.layout')
@section('title', 'تحديث منتج')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/addProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product/updateProduct.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('assets/js/product/addProduct.js')}}"></script>
@endsection


@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                <p class="error">
                    @foreach ($errors->all() as $error)
                        - {{ $error }}<br>
                    @endforeach
                </p>
            @endif
        </div>
        <form action="{{url('productupdate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">رقم المنتج</label>
                <input class="readOnly" type="text" readonly name="id" id="" value="{{ ($record) ? $record->id : null}}">
            </div>
            <div>
                <label for="">اسم المنتج</label>
                <input type="text" name="name" id="" value="{{ ($record) ? $record->name : null}}">
            </div>
            <div>
                <label for="">وصف المنتج</label>
                <textarea name="" name="description">{{($record) ? $record->name : null}}</textarea>
            </div>
            <div>
                <label for="">السعر</label>
                <input type="text" name="price" id="" value= "{{($record) ? $record->price  : null}}">
            </div>
            <div>
                <label for="">الكمية</label>
                <input type="text" name="quantity" id="" value= "{{($record) ? $record->quantity : null}}">
            </div>
            <div class="uploadSectionDiv">
                {{-- <label for="">صورة</label> --}}
                <div id="uploadButton" class="uploadButton">
                    <img src="{{ asset('assets/images/svg/upload_icon.svg') }}" alt="">
                </div>
                <input type="file" accept=".jpeg,.jpg,.png,.WebP,.tif,.tiff" name="image" id="image"
                    style="display:none">
                <img id="imagePreview" class="imagePreview" src="{{url(($record) ? $record->image : '')}}" alt="صورة المنتج">
            </div>
            <input type="submit" value="تحديث">
        </form>

    </div>
@endsection
