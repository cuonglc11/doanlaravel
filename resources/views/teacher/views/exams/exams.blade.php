@extends('teacher.layout.app')
@section('title')
    Danh sách Đề thi
@endsection
@section('content')
    <div class="container mt-5 pt-5">
        <h2>Quản lý khóa học của bạn</h2>
        <div class="mb-3">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học..." aria-label="Search">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addExamsModal">Thêm Bộ đề</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Khoảng thời gian</th>
                    <th>Tổng câu hỏi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @forelse ($exams as $exam)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $exam->title }}</td>
                        {{-- <td>{{ $exam->course->title }}</td> --}}
                        <td>{{ $exam->duration }} phút</td>
                        <td>{{ $exam->total_question }}</td>

                        <td>
                            {{-- <a href="#editCourseModal" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                data-bs-target="#addCourseModal" data-id="{{ $course->id }}"
                                data-title="{{ $course->title }}" data-description="{{ $course->description }}"
                                data-category="{{ $course->category_id }}" data-price="{{ $course->price }}"
                                data-img="{{ asset($course->img) }}">
                                Sửa
                            </a> --}}
                            <a href="{{ route('question.show', $exam->id) }}" class="btn btn-sm btn-success">
                                Ra để
                            </a>

                            {{-- <a href="{{ route('exams.show', $course->id) }}" class="btn btn-sm btn-info ">
                                Bộ đề
                            </a>
                            <a href="#deleteCourseModal" class="btn btn-sm btn-danger" data-bs-toggle="modal">Xóa</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có đề thi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm khóa học -->
    <div class="modal fade" id="addExamsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Đề thi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addExamsForm" method="POST" enctype="multipart/form-data">
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
                            <label for="price" class="form-label">Khoảng thời gian</label>
                            <input type="number" class="form-control" id="duration" name="duration" step="0.01"
                                value="0.00" required aria-label="Khoảng thời gian">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu Đề</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa khóa học -->
    {{-- <div class="modal fade" id="deleteCourseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa khóa học này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form action="/instructor/courses/delete" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="course_id" value="">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
