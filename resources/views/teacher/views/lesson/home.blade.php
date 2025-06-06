@extends('teacher.layout.app')
@section('title')
    Danh sách bài giảng
@endsection
@section('content')
    <div class="container mt-5 pt-5">
        <h2>Quản lý Bài giảng</h2>
        <div class="mb-3">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học..." aria-label="Search">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addLessonModal">Thêm Bài giảng</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Khóa học</th>
                    <th>Nội dung</th>
                    <th>URL nội dung</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->course ? $lesson->course->title : '-' }}</td>
                        <td>{{ $lesson->content }}</td>
                        <td>
                            @if ($lesson->content_url)
                                <a href="{{ $lesson->content_url }}" target="_blank">Xem</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="#editLessonModal" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                data-bs-target="#addLessonModal" data-id="{{ $lesson->id }}"
                                data-title="{{ $lesson->title }}" data-content="{{ $lesson->content }}"
                                data-content_url="{{ $lesson->content_url }}">Sửa</a>
                            {{-- <form action="{{ route('instructor.lessons.destroy', $lesson->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có bài giảng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="modal fade" id="addLessonModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Bài giảng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addLessonForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" name="course_id"
                                value="{{ request()->route('id') ?? $course_id }}">
                            <input type="hidden" name="id" name="id">

                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="title" name="title" required
                                    aria-label="Tên khóa học">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Nội dụng</label>
                                <textarea class="form-control" id="content" name="content" rows="4" required aria-label="Mô tả khóa học"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Nội dung</label>
                                <input type="url" class="form-control" id="content_url" name="content_url" required
                                    aria-label="Giá khóa học">
                            </div>

                            <button type="submit" class="btn btn-primary">Lưu khóa học</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
