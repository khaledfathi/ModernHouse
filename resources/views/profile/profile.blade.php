@extends('layout.layout')
@section('title', '{{auth()->user->name}}')
@section('links')
    <link rel="stylesheet" href="{{asset('assets/css/profile/profile.css')}}">
@endsection
@section('links')
    <script src="#"></script>
@endsection

@section('content')
    <h1>PROFILE PAGE</h1>
@endsection
    