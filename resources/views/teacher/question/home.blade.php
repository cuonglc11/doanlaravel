@extends('teacher.layout.app')
@section('title')
    Ngân sách câu hỏi
@endsection
@section('content')
    <div class="container mt-5 pt-5">
        <h2>Quản lý Câu hỏi</h2>
        <div class="mb-3">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm khóa học..." aria-label="Search">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Thêm Câu hỏi</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>Đáp án</th>
                    <th>Đáp án đúng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listQuestion as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->content }}</td>
                        <td>
                            @if (!empty($question->option))
                                <ul class="list-unstyled mb-0">
                                    @foreach (json_decode($question->option, true) as $key => $opt)
                                        <li><strong>{{ $key }}:</strong> {{ $opt }}</li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $question->correct }}</td>
                        {{-- <td>
                            <a href="#editLessonModal" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal"
                                data-bs-target="#addLessonModal" data-id="{{ $lesson->id }}"
                                data-title="{{ $lesson->title }}" data-content="{{ $lesson->content }}"
                                data-content_url="{{ $lesson->content_url }}">Sửa</a>

                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Chưa có bài giảng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="modal fade" id="addQuestionModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addQuestionForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="exam_id" name="exam_id"
                                value="{{ request()->route('id') ?? $exam_id }}">
                            <input type="hidden" name="id" name="id">

                            <div class="mb-3">
                                <label for="description" class="form-label">Nội dụng</label>
                                <textarea class="form-control" id="content" name="content" rows="4" required aria-label="Mô tả khóa học"></textarea>
                            </div>
                            <div id="optionsSection">
                                <h5>Đáp án</h5>
                                <div class="row">
                                    @foreach (['A', 'B', 'C', 'D'] as $label)
                                        <div class="col-md-6 mb-3">
                                            <label for="option_{{ $label }}" class="form-label">Đáp án
                                                {{ $label }}</label>
                                            <input type="text"
                                                class="form-control @error('option.' . $label) is-invalid @enderror"
                                                id="option_{{ $label }}" name="option[{{ $label }}]"
                                                value="{{ old('option.' . $label) }}"
                                                aria-label="Đáp án {{ $label }}" required>
                                            @error('option.' . $label)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="correct" class="form-label">Đáp án đúng</label>
                                    <select class="form-select @error('correct') is-invalid @enderror" id="correct"
                                        name="correct" required>
                                        <option value="">Chọn đáp án đúng</option>
                                        @foreach (['A', 'B', 'C', 'D'] as $label)
                                            <option value="{{ $label }}"
                                                {{ old('correct') == $label ? 'selected' : '' }}>{{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('correct')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu câu hỏi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
