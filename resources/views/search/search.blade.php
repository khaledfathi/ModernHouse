@extends('layout.layout')
@section('title', 'بحث')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/search/search.css') }}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeSearch', 'active')


@section('content')
    <div class="container">
        <form class="d-grid" action="find" method="get">
            <div class="searchFor">
                <div>
                    <label for="">بحث عن</label>
                    <select name="searchFor" id="">
                        <option value="customer">عميل</option>
                        <option value="project">مشروع</option>
                        <option value="bill">فاتورة</option>
                        <option value="transaction">معاملة مالية</option>
                        <option value="product">منتج</option>
                    </select>
                </div>
            </div>
            <div class="searchBy">
                <div>

                    <label for="">بحث بواسطة</label>
                    <select name="searchBy" id="">
                        <option value="id">رقم العميل</option>
                        <option value="name">الاسم</option>
                        <option value="phone">التليفون</option>
                    </select>
                </div>
            </div>
            <div class="search justify-item-center">
                <div class="searchBox">
                    <input type="text" name="find">
                    <button type="submit"><img src="{{url('assets/images/svg/search_icon.svg')}}" alt=""></button>
                </div>
            </div>
        </form>

        <div class="results">
            @if (session('records'))
                @switch(session('searchFor'))
                    @case('customer')
                        <table>
                            <thead>
                                <th width="5%">رقم العميل</th>
                                <th width="20%">الاسم</th>
                                <th width="10%">التليفون</th>
                                <th width="30%">العنوان</th>
                                <th width="20%">تفاصيل</th>
                                <th width="5%">الموقع</th>
                                <th width="5%">عرض</th>
                            </thead>
                            <tbody>
                                @foreach (session('records') as $record)
                                    <tr>
                                        <td>{{ $record->id }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->phone }}</td>
                                        <td>{{ $record->address }}</td>
                                        <td>{{ $record->details }}</td>
                                        @if ($record->coordinates)
                                            <td><a href="{{$record->coordinates}}" target="_blank"><img class="inTableIcon" src="{{url('assets/images/svg/map_icon.svg')}}" alt="map_icon"></a></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td><a href=""><img class="inTableIcon" src="{{url('assets/images/svg/view_icon.svg')}}" alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @break

                    @case('project')
                    @break

                    @case('bill')
                    @break

                    @case('transaction')
                    @break

                    @case('product')
                    @break
                @endswitch
            @endif
            @if (session('noResult'))
                <p class="noResult">{{ session('noResult') }}</p>
            @endif
        </div>

    </div>
@endsection
