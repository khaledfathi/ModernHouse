<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/search/style.css')}}">
    @yield('links')
</head>
<body>
    <nav class="d-grid">
        <div class="logo">
            <img class="logo" src="{{asset('assets/images/logo/modern_house_logo.png')}}" alt="modern_house_logo">
            <p><a href="{{url('profile')}}">{{auth()->user()->name}}</a></p>
        </div>
        <ul class="nav-list d-flex flex-row justify-content-center">
            <li>
                <a class="@yield('activeSearch')" href="{{url('search')}}">استعلام</a>
            </li>
            <li>
                <a  class="@yield('activeSearch')" href="{{url('customer')}}">اضافة عميل</a>
            </li>
            <li>
                <a class="@yield('activeSearch')" href="{{url('bill')}}">فاتورة</a>
            </li>
            <li>
                <a class="@yield('activeSearch')" href="{{url('products')}}">منتجات</a>
            </li>
             <li>
                <a class="@yield('activeSearch')" href="{{url('transaction')}}">ماليات</a>
            </li>
            <li>
                <a class="@yield('activeSearch')" href="{{url('report')}}">تقارير</a>
            </li>

            <li>
                <a class="@yield('activeSearch')" href="{{url('setting')}}">اعدادت</a>
            </li>
            <li>
                <a class="logout" href="{{url('logout')}}">خروج</a>
            </li>
        </ul>
    </nav>
    @yield('content')
    @yield('scripts')
</body>
</html>