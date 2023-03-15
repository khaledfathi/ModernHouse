@extends('layout.layout')
@section('title', 'تحديث منتج')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/addProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product/updateProduct.css') }}">
@endsection
@section('scripts')

    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/product/addProduct.js') }}"></script>
    <script src="{{asset('assets/js/product/productProfile.js')}}"></script>
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
        <form action="{{ url('productupdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">رقم المنتج</label>
                <input class="readOnly" type="text" readonly name="id" id=""
                    value="{{ $record ? $record->id : null }}">
            </div>
            <div>
                <label for="">اسم المنتج</label>
                <input type="text" name="name" id="" value="{{ $record ? $record->name : null }}">
            </div>
            <div>
                <label for="">الصنف</label>
                <select name="category" id="">
                    @if ($categories)
                        @foreach ($categories as $category)
                            @if ($category->id == $record->category_id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option  value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label for="">وصف المنتج</label>
                <textarea name="description">{{ $record ? $record->description : null }}</textarea>
            </div>
            <div>
                <label for="">السعر</label>
                <input type="text" name="price" id="" value="{{ $record ? $record->price : null }}">
            </div>
            <div>
                <label for="">الكمية</label>
                <input type="text" name="quantity" id="" value="{{ $record ? $record->quantity : null }}">
            </div>
            <div class="uploadSectionDiv">
                <div id="uploadButton" class="uploadButton">
                    <img src="{{ asset('assets/images/svg/upload_icon.svg') }}" alt="">
                </div>
                <input type="file" accept=".jpeg,.jpg,.png,.WebP,.tif,.tiff" name="image" id="image"
                    style="display:none">
                <img id="imagePreview" class="imagePreview" src="{{ url($record ? $record->image : '') }}"
                    alt="صورة المنتج">
            </div>
            <div>
                <input type="submit" value="تحديث">
                <button id="deleteButton" class="deleteButton" type="button">حذف</button>
                <input id="deleteLink" type="hidden" value="{{url('productdelete/'.$record->id)}}">
            </div>
        </form>

    </div>
@endsection
