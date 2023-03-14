
@extends('layout.layout')
@section('title', 'اضافة صنف')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/category/category.css')}}">
@endsection
@section('scripts')
    <script src="{{url('assets/js/category/category.js')}}"></script>
    <script src="{{asset('assets/js/external/sweatAlert/sweetalert2.all.min.js')}}"></script>
@endsection


@section('content')
<div class="container">
    <div class="newCategory'">
        <div>
            <a href="{{url('product')}}">الذهاب للمنتجات</a>
        </div>
        <form action="{{url('newcategory')}}">
            @if ($errors->any())
                <p>{{$errors->first()}}</p>
            @endif
            @if(session('ok'))
                <p>{{session('ok')}}</p>
                @endif
            <div>
                <label for="">اسم الصنف</label>
                <input type="text" name="name">
            </div>            
            <input type="submit" value="حفظ">
        </form>
    </div class="allCategories">
    <div>
        @if ($categories->count())
            <table>
                <thead>
                    <th>رقم الصنف</th>
                    <th>اسم الصنف</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                <tbody>

            @foreach ($categories as $category)
               <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td><a href="{{url('categoryupdate/'.$category->id)}}">Edit</a></td>
                <td><a href="{{url('categorydelete/'.$category->id)}}">Delete</a></td>
            </tr> 
            @endforeach
                </tbody>
            </table>
        @else 
            <p>لا يوجد اصناف</p>
        @endif

    </div>
</div>
@endsection
    