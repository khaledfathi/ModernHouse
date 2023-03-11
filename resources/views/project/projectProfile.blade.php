@extends('layout.layout')
@section('title', 'ادارة مشروع')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/project/projectProfile.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/project/projectProfile.js') }}"></script>
    <script src="{{ asset('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
@endsection

@section('content')
    <div class="projectContainer">
        <div class="result">
            <form class="d-grid" action="{{ url('projectupdate') }}" method="get">
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
                <div class="formBlockA">
                    <div>
                        <label for="">رقم المشروع</label>
                        <input class="readOnly" type="text" name="id" readonly
                            value="{{ $project ? $project->id : null }}">
                    </div>
                    <div>
                        <label for="">رقم العميل</label>
                        <input class="readOnly" type="text" name="customer_id" readonly
                            value="{{ $customer ? $customer->id : null }}">
                    </div>
                    <div>
                        <label for="">اسم العميل</label>
                        <input class="readOnly" type="text" name="customer_name" readonly
                            value="{{ $customer ? $customer->name : null }}">
                    </div>
                    <div>
                        <label for="">تليفون العميل</label>
                        <input class="readOnly" type="text" name="customer_phone" readonly
                            value="{{ $customer ? $customer->phone : null }}">
                    </div>
                </div>

                <div class="formBlockB">
                    <div>
                        <label for="">التاريخ</label>
                        <input type="date" name="date" value="{{ $project ? $project->date : null }}">
                    </div>
                    <div>
                        <label for="">تاريخ البدء</label>
                        <input type="date" name="start_date" value="{{ $project ? $project->start_date : null }}">
                    </div>
                    <div>
                        <label for="">تاريخ التسليم</label>
                        <input type="date" name="end_date" value="{{ $project ? $project->end_date : null }}">
                    </div>
                </div>

                <div class="formBlockC">
                    <div>
                        <label for="">المبلغ المتفق علية</label>
                        <input type="text" id="amount" name="amount"
                            value="{{ $project ? $project->amount : null }}">
                    </div>
                    <div>
                        <label for="">المبلغ المستحق</label>
                        <input class="readOnly" type="text" id="remaining" name="remaining" id="" readonly
                            value="{{ $remaining ? $remaining : null }}">
                    </div>
                    <div class="textareaDiv">
                        <label for="">الخامات المطلوبة</label>
                        <textarea name="materials" id="" cols="30" rows="10">{{ $project ? $project->materials : null }}</textarea>
                    </div>
                    <div class="textareaDiv">
                        <label for="">تفاصيل اخرى</label>
                        <textarea name="details" id="" cols="30" rows="10">{{ $project ? $project->details : null }}</textarea>
                    </div>
                    <div>
                        <label for="">حالة المشروع</label>
                        <select name="project_status" id="">
                            @foreach ($projectStatus as $item)
                                @if ($project)
                                    @if ($item->id == $project->project_status_id)
                                        <option selected value="{{ $item->id }}">{{ $item->status }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->status }}</option>
                                    @endif
                                @else
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="buttonBlock">
                    <button type="submit">تحديث</button>
                    <button class="deleteButton" id="deleteButton" type="button">حذف</button>
                    <input id="deleteLink" type="hidden"
                        value="{{ $project ? url('projectdelete/' . $project->id . '?customer_id=' . $customer->id) : null }}">
                </div>
            </form>
        </div>
        <div class="transactionContainer">
            <h3>معاملات مالية</h3>
            <a class="addTransactionButton" href="{{ url('payment') }}">اضافة معاملة مالية</a>
            <div class="results">
                @if ($project)
                    @if ($transactions)
                        <table>
                            <thead>
                                <th>رقم العملية</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>المبلغ</th>
                                <th>تفاصيل</th>
                                <th>عرض</th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>{{ $transaction->time }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->details }}</td>
                                        <td><a
                                                href="{{ url('payment/' . $transaction->id . '?project_id=' . $project->id . '&customer_id=' . $customer->id) }}"><img
                                                    class="inTableIcon"src="{{ url('assets/images/svg/view_icon.svg') }}"
                                                    alt="view_icon"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>لا يوجد تعاملات مالية لهذا المشروع</p>
                    @endif
                @else
                    <p>لا يوجد تعاملات مالية لهذا المشروع</p>
                @endif
            </div>
        </div>
    </div>
@endsection
