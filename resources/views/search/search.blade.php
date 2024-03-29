@extends('layout.layout')
@section('title', 'استعلامات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/search/search.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/search/search.js') }}"></script>
@endsection
@section('activeSearch', 'active')


@section('content')
    <div class="container">
        @if (session('ok'))
            <p class="ok">{{session('ok')}}</p>
        @endif 
        <form class="d-grid" action="{{ url('find') }}" method="get">
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
                <div>
                    <label for="">بحث بواسطة</label>
                    <select name="customerSearchBy" id="customerSearchBy">
                        {{-- customer --}}
                        <option selected value="customer_id">رقم العميل</option>
                        <option value="customer_name">الاسم</option>
                        <option value="customer_phone">التليفون</option>
                    </select>

                    {{-- project --}}
                    <select hidden name="projectSearchBy" id="projectSearchBy">
                        <option selected value="project_id">رقم المشروع</option>
                        <option value="project_customer_name">اسم العميل</option>
                        <option value="project_customer_phone">تليفون العميل</option>
                    </select>

                    {{-- Bill --}}
                    <select hidden name="billSearchBy" id="billSearchBy">
                        <option selected value="bill_id">رقم الفاتورة</option>
                        <option value="bill_customer_phone">تليفون العميل</option>
                        <option value="bill_customer_name">اسم العميل</option>
                    </select>

                    {{-- product --}}
                    <select hidden name="productSearchBy" id="productSearchBy">
                        <option selected value="product_id">رقم المنتج</option>
                        <option value="product_name">اسم المنتج</option>
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
                                <th width="10%">رقم العميل</th>
                                <th width="20%">الاسم</th>
                                <th width="10%">التليفون</th>
                                <th width="20%">العنوان</th>
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
                                        <td><a href="{{ url('customer/' . $record->id) }}"><img
                                                    class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}"
                                                    alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @break

                    @case('project')
                        <table>
                            <thead>
                                <th width="10%">رقم المشروع</th>
                                <th>التاريخ</th>
                                <th>العميل</th>
                                <th>تليفون</th>
                                <th>البدء</th>
                                <th>التسليم</th>
                                <th>المبلغ</th>
                                <th>حالة المشروع</th>
                                <th>عرض</th>
                            </thead>
                            <tbody>
                                @foreach (session('records') as $record)
                                    <tr>
                                        <td width="5%">{{ $record->id }}</td>
                                        <td>{{ $record->date }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->phone }}</td>
                                        <td>{{ $record->start_date }}</td>
                                        <td>{{ $record->end_date }}</td>
                                        <td>{{ $record->amount }}</td>
                                        <td>{{ $record->status }}</td>
                                        <td><a href="{{ url('project/' . $record->id) }}"><img
                                                    class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}"
                                                    alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @break

                    @case('bill')
                    <table>
                        <thead>
                            <thead>
                                <th>رقم الفاتورة</th>
                                <th>عميل</th>
                                <th>تليفون</th>
                                <th>تاريخ</th>
                                <th>وقت</th>
                                <th>عدد المنتجات</th>
                                <th>عدد القطع</th>
                                <th>اجمالى الفاتورة</th>
                                <th>عرض</th>
                            </thead>
                        </thead>
                        <tbody>
                            @foreach (session('records') as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->customer_name}}</td>
                                    <td>{{$record->customer_phone}}</td>
                                    <td>{{$record->date}}</td>
                                    <td>{{$record->time}}</td>
                                    <td>{{$record->productsCount}}</td>
                                    <td>{{$record->itemsCount}}</td>
                                    <td>{{$record->totalInvoice}}</td>
                                    <td><a href="{{ url('billprofile/' . $record->id) }}"><img
                                                    class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}"
                                                    alt="view_icon"></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @break

                    @case('transaction')
                    @break

                    @case('product')
                        <div class="productsDiv d-flex">
                            @if (session('records'))
                                @foreach (session('records') as $record)
                                    <div class="product">
                                        @if ($record->image)
                                            <img src="{{ asset($record->image) }}"alt="ProductImage">
                                        @else
                                            <img href="{{ url('product/' . $record->id) }} "src="{{ asset('assets/images/default/default.jpg') }}"
                                                alt="ProductImage">
                                        @endif
                                        <div class="productDataDiv">
                                            @if ($record->quantity)
                                                <p>ID : {{ $record->id }} - متاح: {{ $record->quantity }}</p>
                                            @else
                                                <p>ID : {{ $record->id }} - <span class="outOfStock"> غير متاح</span></p>
                                            @endif

                                            <p class="price">{{ $record->price }} جنية</p>                                           
                                            <input type="hidden" value="{{ $record->category_id }}">
                                            <a href="{{ url('product/' . $record->id) }}">
                                                <img src="{{ asset('assets/images/svg/edit_icon.svg') }}" alt="edit_icon">
                                            </a>
                                     
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @break

                @endswitch
            @endif
            @if (session('noResult'))
                <p class="noResult">{{ session('noResult') }}</p>
            @endif
        </div>

    </div>
@endsection
