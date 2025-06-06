@extends('stdutent.layout.app')
@section('title')
    Trang chủ
@endsection
@section('content')

    <div class="container mt-5 pt-5">
            <h2>Chào Học viên {{ Auth::user()->name }}!</h2>
    </div>
@endsection
