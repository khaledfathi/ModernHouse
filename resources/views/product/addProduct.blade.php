@extends('layout.layout')
@section('title', 'اضافة منتج')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/addProduct.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/product/addProduct.js') }}"></script>
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
        <form action="{{ url('newproduct') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">اسم المنتج</label>
                <input type="text" name="name" id="">
            </div>
            <div>
                <label for="">الصنف</label>
                <select name="category" id="">
                    @if ($categories)
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label for="">وصف المنتج</label>
                <textarea name="" name="description"></textarea>
            </div>
            <div>
                <label for="">السعر</label>
                <input type="text" name="price" id="">
            </div>
            <div>
                <label for="">الكمية</label>
                <input type="text" name="quantity" id="">
            </div>
            <div class="uploadSectionDiv">
                {{-- <label for="">صورة</label> --}}
                <div id="uploadButton" class="uploadButton">
                    <img src="{{ asset('assets/images/svg/upload_icon.svg') }}" alt="">
                </div>
                <input type="file" accept=".jpeg,.jpg,.png,.WebP,.tif,.tiff" name="image" id="image"
                    style="display:none">
                <img id="imagePreview" class="imagePreview" src="" alt="صورة المنتج">
            </div>
            <input type="submit" value="حفظ">
        </form>

    </div>
@endsection
