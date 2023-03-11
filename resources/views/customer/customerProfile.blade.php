@extends('layout.layout')
@section('title', 'ادارة عميل')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/customer/customerProfile.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('assets/js/customer/customerProfile.js')}}"></script>
    <script src="{{asset('assets/js/external/sweatAlert/sweetalert2.all.min.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <form class="d-grid" action="{{url('customerupdate')}}" method="get">
            @csrf
            <div class="messages">
                @if ($errors->any())
                    <p class="error">
                        @foreach ($errors->all() as $error)
                            - {{ $error }}<br>
                        @endforeach
                    </p>
                @endif
                @if (session('ok'))
                    <p class="ok">{{ session('ok') }}</p>
                @endif
            </div>
            <div class="customerBlockA">
                <div>
                    <label for="">رقم العميل</label>
                    <input class="customerId" type="text" name="id" readonly value="{{ $record ? $record->id : null }}">
                </div>
                <div>
                    <label for="">الاسم</label>
                    <input type="text" name="name" value="{{ $record ? $record->name : null }}">
                </div>
                <div class="">
                    <label for="">التليفون</label>
                    <input type="text" name="phone" value="{{ $record ? $record->phone : null }}">
                </div>
            </div>

            <div class="customerBlockB">
                <div>
                    <label class="labelTextArea" for="">العنوان</label>
                    <textarea name="address"> {{ $record ? $record->address : null }}</textarea>
                </div>
                <div>
                    <label class="labelTextArea" for="">الموقع</label>
                    <input type="text" placeholder="رابط الموقع بخرائط جوجل" name="coordinates"
                        value="{{ $record ? $record->coordinates : null }}">
                </div>
                <div>
                    <label class="labelTextArea" for="">تفاصيل اخرى</label>
                    <textarea name="details"> {{ $record ? $record->details : null }}</textarea>
                </div>
            </div>

            <div class="customerButtons">
                <div class="buttonsDiv">
                    <button class="" type="submit" name="direction" value="save">تحديث</button>
                    <button class="deleteButton" type="button" id="deleteButton" >حذف</button>
                    <input type="hidden" value="{{($record) ? url('customerdelete/'.$record->id) :null }}" id="deleteLink">
                </div>
            </div>
        </form>
    </div>
    <div class="projectContainer">
        <a class="addProjectButton" href="{{url('project') }}">اضافة مشروع</a>
        <div class="results">
            @if ($record)
                @if ($projects->count())

                    <table>
                        <thead>
                            <th>رقم المشروع</th>
                            <th>التاريخ</th>
                            <th>البدء</th>
                            <th>التسليم</th>
                            <th>المبلغ</th>
                            <th>حالة المشروع</th>
                            <th>عرض</th>
                        </thead>
                        <tbody>
                            @foreach ($projects as $record)
                                <tr>
                                    <td width="5%">{{ $record->id }}</td>
                                    <td>{{ $record->date }}</td>
                                    <td>{{ $record->start_date }}</td>
                                    <td>{{ $record->end_date }}</td>
                                    <td>{{ $record->amount }}</td>
                                    <td>{{ $record->status }}</td>
                                    <td><a href="{{url('project/'.$record->id)}}"><img
                                                class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}"
                                                alt="view_icon"></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>لا يوجد مشاريع لهذا العميل</p>
                @endif
            @endif
        </div>
    </div>

@endsection
