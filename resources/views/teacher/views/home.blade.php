@extends('teacher.layout.app')
@section('title')
    Danh sách Khoá học
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
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCourseModal">Thêm khóa học
            mới</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên khóa học</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @forelse ($listCouser as $course)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><img src="{{ asset($course->img) }}" class="course-image" alt="Khóa học"></td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->category->name_category }}</td>
                        <td>{{ $course->price }} VNĐ</td>
                        <td>
                            <a href="#editCourseModal" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                data-bs-target="#addCourseModal" data-id="{{ $course->id }}"
                                data-title="{{ $course->title }}" data-description="{{ $course->description }}"
                                data-category="{{ $course->category_id }}" data-price="{{ $course->price }}"
                                data-img="{{ asset($course->img) }}">
                                Sửa
                            </a>
                            <a href="{{ route('lesson.show', $course->id) }}" class="btn btn-sm btn-success">
                                Bài giảng
                            </a>

                            <a href="{{ route('exams.show', $course->id) }}" class="btn btn-sm btn-info ">
                                Bộ đề
                            </a>
                            <a href="#deleteCourseModal" class="btn btn-sm btn-danger" data-bs-toggle="modal">Xóa</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có khoá học nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm khóa học -->
    <div class="modal fade" id="addCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm khóa học mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" name="id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên khóa học</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                aria-label="Tên khóa học">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required aria-label="Mô tả khóa học"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá (VNĐ)</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                value="0.00" required aria-label="Giá khóa học">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh khóa học</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*"
                                aria-label="Hình ảnh khóa học">
                            <img id="imagePreview" src="#" alt="Xem trước hình ảnh" class="img-fluid mt-2">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu khóa học</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa khóa học -->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1">
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
    </div>

    <!-- Bootstrap JS -->
@endsection
