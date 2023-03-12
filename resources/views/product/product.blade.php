@extends('layout.layout')
@section('title', 'منتجات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/product/product.css') }}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeProduct', 'active')


@section('content')
    <div class="container">
        <div>
            <a href="{{ url('addproduct') }}">اضافة منتج</a>
        </div>
        @if ($records)
        @foreach ($records as $record)
            <div class="product">
                <img src="" alt="IMAGE">
                <p>{{$record->id}}</p>
                <p>{{$record->description}}</p>
                <p>{{$record->price}}</p>
                <a href="{{url('product/'.$record->id)}}">Edit</a>
            </div>
        @endforeach
        @endif
    </div>
@endsection
