@extends('layout.layout')
@section('title', 'منتجات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/product.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/product/product.js') }}"></script>
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
@endsection
@section('activeProduct', 'active')

@section('content')
    <div class="container">
        <div class="addProductDiv">
            <a href="{{ url('addproduct') }}">اضافة منتج</a>
            <a href="{{ url('category') }}">الاصناف</a>
            <div class="category">
                <label for="">تصنيف</label>
                <select name="category" id="category">
                    <option value="all">الكل</option>
                    @if ($categories)
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="productsDiv d-flex">
            @if ($records)
                @foreach ($records as $record)
                    <div class="product">
                        @if ($record->image)
                            <a href="{{ url('product/' . $record->id) }}"><img src="{{ asset($record->image) }}"
                                    alt="ProductImage"></a>
                        @else
                            <img href="{{ url('product/' . $record->id) }} "src="{{ asset('assets/images/default/default.jpg') }}"
                                alt="ProductImage">
                        @endif
                        <div class="productDataDiv">
                            @if($record->quantity)
                                <p>ID : {{ $record->id }} - متاح: {{ $record->quantity }}</p>
                            @else
                                <p>ID : {{ $record->id }} - <span class="outOfStock"> غير متاح</span></p>
                            @endif

                            <p class="price">{{$record->price}} جنية</p>
                            <input type="hidden" value="{{ url('productdelete/' . $record->id) }}">
                            <input type="hidden" value="{{$record->category_id}}">
                            <a href="{{ url('product/' . $record->id) }}">
                                <img src="{{ asset('assets/images/svg/edit_icon.svg') }}" alt="edit_icon">
                            </a>
                            <div class="deleteButton">
                                <img src="{{ asset('assets/images/svg/delete_icon.svg') }}" alt="delete_icon">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
