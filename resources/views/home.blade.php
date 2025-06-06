@extends('layouts.app')

@section('content')
 <section class="hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Khám Phá Kiến Thức Mới</h1>
            <p class="lead mb-4">Tham gia các khóa học chất lượng và kiểm tra kỹ năng với bài thi chuyên sâu.</p>
            <form class="search-form d-flex" action="{{ route('home') }}" method="GET" id="searchForm">
                <input class="form-control me-2" type="search" name="q" placeholder="Tìm kiếm khóa học..." value="{{ request('q') }}" aria-label="Search">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <a href="{{ route('student.home') }}" class="btn btn-light btn-lg mt-4">Bắt đầu học ngay</a>
        </div>
    </section>
@endsection
