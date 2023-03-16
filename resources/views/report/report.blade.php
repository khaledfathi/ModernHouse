@extends('layout.layout')
@section('title', 'تقارير')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/report/report.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection
@section('activeReport' , 'active')


@section('content')
    <h1>REPORT PAGE</h1>
    <p>transaction for this day with total</p>
    <p>transaction for this month with total</p>
    <p>records in all tables for this day</p>
    <p>count products in count category</p>
    <p>customer count</p>
    <p>project count status</p>
    <p>open project count</p>
    <p>project near to end (3 days)</p>



@endsection
    