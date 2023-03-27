<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    @yield('links')
</head>
<body>
    <nav class="d-grid">
        <div class="logo">
            <img class="logo" src="{{asset(Logo())}}" alt="modern_house_logo">
            <p><a href="{{url('profile')}}">{{auth()->user()->name}}</a></p>
        </div>
        <ul class="nav-list d-flex flex-row justify-content-center">
            <li>
                <a class="@yield('activeSearch')" href="{{url('search')}}">استعلام</a>
            </li>
            <li>
                <a  class="@yield('activeCustomer')" href="{{url('customer')}}">اضافة عميل</a>
            </li>
            <li>
                <a class="@yield('activeBill')" href="{{url('bill')}}">فاتورة</a>
            </li>
            <li>
                <a class="@yield('activeProduct')" href="{{url('product')}}">منتجات</a>
            </li>
             <li>
                <a class="@yield('activeTransaction')" href="{{url('transaction')}}">ماليات</a>
            </li>
            <li>
                <a class="@yield('activeReport')" href="{{url('report')}}">تقارير</a>
            </li>

            <li>
                <a class="@yield('activeSetting')" href="{{url('setting')}}">اعدادت</a>
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