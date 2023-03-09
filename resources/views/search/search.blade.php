@extends('layout.layout')
@section('title', 'بحث')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/search/search.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/search/search.js') }}"></script>
@endsection
@section('activeSearch', 'active')


@section('content')
    <div class="container">
        <form class="d-grid" action="find" method="get">
            <div class="searchFor">
                <div>
                    <label for="">بحث عن</label>
                    <select name="searchFor" id="searchFor">
                        <option selected value="customer">عميل</option>
                        <option value="project">مشروع</option>
                        <option value="bill">فاتورة</option>
                        <option value="product">منتج</option>
                    </select>
                </div>
            </div>
            <div class="searchBy">
                <div >
                    <label for="">بحث بواسطة</label>
                    <select name="customerSearchBy" id="customerSearchBy">
                        {{-- customer --}}
                        <option selected value="customer_id">رقم العميل</option>
                        <option value="customer_name">الاسم</option>
                        <option value="customer_phone">التليفون</option>
                    </select>

                        {{-- project --}}
                    <select hidden name="projectSearchBy" id="projectSearchBy">
                        <option selected  value="project_id">رقم المشروع</option>
                        <option  value="project_customer_name">اسم العميل</option>
                        <option  value="project_customer_phone">تليفون العميل</option>
                    </select>

                        {{-- Bill --}}
                    <select hidden name="billSearchBy" id="billSearchBy">
                        <option selected  value="phone">رقم الفاتورة</option>
                        <option  value="id">تليفون العميل</option>
                        <option  value="phone">اسم العميل</option>
                    </select>

                        {{-- product --}}
                    <select hidden name="productSearchBy" id="productSearchBy">
                        <option selected value="phone">رقم المنتج</option>
                        <option value="phone">اسم المنتج</option>
                    </select>
                </div>
            </div>
            <div class="search justify-item-center">
                <div class="searchBox">
                    <input type="text" name="find">
                    <button type="submit">
                        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11ZM11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C13.125 20 15.078 19.2635 16.6177 18.0319L20.2929 21.7071C20.6834 22.0976 21.3166 22.0976 21.7071 21.7071C22.0976 21.3166 22.0976 20.6834 21.7071 20.2929L18.0319 16.6177C19.2635 15.078 20 13.125 20 11C20 6.02944 15.9706 2 11 2Z"
                                    fill="#000000" />
                            </g>
                        </svg>
                    </button>
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
                                            <td><a href="{{ $record->coordinates }}" target="_blank"><img class="inTableIcon"
                                                        src="{{ url('assets/images/svg/map_icon.svg') }}" alt="map_icon"></a></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td><a href=""><img class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}" alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @break

                    @case('project')
                        <table>
                            <thead>
                                <th>رقم المشروع</th>
                                <th>العميل</th>
                                <th>تليفون</th>
                                <th>التاريخ</th>
                                <th>البدء</th>
                                <th>التسليم</th>
                                <th>المبلغ</th>
                                <th>الخامات</th>
                                <th>حالة المشروع</th>
                                <th>تفاصيل</th>
                                <th>عرض</th>
                            </thead>
                            <tbody>
                                @foreach (session('records') as $record)
                                    <tr>
                                        <td width="5%">{{$record->id}}</td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->phone}}</td>
                                        <td>{{$record->date}}</td>
                                        <td>{{$record->start_date}}</td>
                                        <td>{{$record->end_date}}</td>
                                        <td>{{$record->amount}}</td>
                                        <td>{{$record->materials}}</td>
                                        <td>{{$record->status}}</td>
                                        <td>{{$record->details}}</td>
                                        <td><a href=""><img class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}" alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
