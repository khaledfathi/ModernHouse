@extends('layout.layout')
@section('title', 'اضافة صنف')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/category/category.css') }}">
@endsection
@section('scripts')
    <script src="{{ url('assets/js/category/category.js') }}"></script>
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
@endsection


@section('content')
    <div class="container">
        <div class="newCategory">
            <div class="goToProductDiv">
                <a href="{{ url('product') }}">الذهاب للمنتجات</a>
            </div>
            <form action="{{ url('newcategory') }}">
                @if ($errors->any())
                    <p class="error">{{ $errors->first() }}</p>
                @endif
                @if (session('ok'))
                    <p class="ok">{{ session('ok') }}</p>
                @endif
                <div>
                    <label for="">اسم الصنف</label>
                    <input type="text" name="name">
                </div>
                <input type="submit" value="حفظ">
            </form>
        </div>
        <div class="allCategories">
            @if ($categories->count())
                <div class="resultDiv">

                    <table>
                        <thead>
                            <th width="10%">رقم الصنف</th>
                            <th width="60%">اسم الصنف</th>
                            <th width="15%">تعديل</th>
                            <th width="155">حذف</th>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ url('category/' . $category->id) }}">
                                            <img src="{{ url('assets/images/svg/edit_icon.svg') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="deleteButton" name="deleteButton" type="button">
                                            <img src="{{ url('assets/images/svg/delete_icon.svg') }}" alt="">
                                        </div>
                                    </td>
                                    <td hidden>{{ url('categorydelete/' . $category->id) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>لا يوجد اصناف</p>
            @endif

        </div>
    </div>
@endsection
