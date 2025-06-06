```html
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Học trực tuyến với các khóa học và bài thi chất lượng cao.">
    <meta name="keywords" content="học trực tuyến, khóa học, bài thi, giáo dục">
    <title>Học Trực Tuyến - Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/home/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Học Trực Tuyến</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses">Khóa học</a></li>
                    <li class="nav-item"><a class="nav-link" href="#exams">Bài thi</a></li>
                    @auth
                        @if (Auth::user()->role === 'student')
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.home') }}">Khoá học của tôi</a>
                            </li>
                        @elseif (Auth::user()->role === 'teacher')
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.home') }}">Quản lý khoá học</a></li>
                        @elseif (Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->FULL_NAME }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="/login">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>



    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Học Trực Tuyến</h5>
                    <p>Nền tảng học tập và kiểm tra trực tuyến hàng đầu.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white">Trang chủ</a></li>
                        <li><a href="#courses" class="text-white">Khóa học</a></li>
                        @auth
                            @if (Auth::user()->role === 'student')
                                <li><a href="{{ route('student.home') }}" class="text-white">Dashboard</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liên hệ</h5>
                    <p>Email: support@hoctructuyen.com<br>
                        Hotline: 0123 456 789</p>
                </div>
            </div>
            <hr class="bg-light">
            <p class="text-center mb-0">© 2025 Học Trực Tuyến. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // AJAX tìm kiếm khóa học
        document.getElementById('searchForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = this.querySelector('input[name="q"]').value;
            fetch(`/?q=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    document.querySelector('#courses').outerHTML = doc.querySelector('#courses').outerHTML;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
```
