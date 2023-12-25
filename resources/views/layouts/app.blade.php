<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    {{--  <!-- Tell the browser to be responsive to screen width -->  --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--  <!-- Bootstrap 3.3.7 -->  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
    <script src="{{ asset('backend/js/angular.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>

    {{--  // riêng  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


</head>

<body class="hold-transition skin-blue sidebar-mini">
    @if (Auth::check())
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="logo"
                    style="background-color: #222d32; border-bottom: 1px solid #444;">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">HIHI</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">BANHANG_ADMIN</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="d-flex navbar-static-top" style="background-color: #222d32">
                    <!-- Sidebar toggle button-->
                    <a href="#" style="color: #fff" class="sidebar-toggle mr-auto" data-toggle="push-menu"
                        role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav d-flex flex-row">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu text-white">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="{{ asset('backend/images/user2-160x160.jpg') }}"
                                                            class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu text-white">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu text-white">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                            role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user user-menu text-white">
                                @php
                                    $userId = Auth::id();
                                    $user = App\Models\User::find($userId);
                                @endphp

                                @if ($user)
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset('uploads/user/' . $user->image) }}" class="user-image"
                                            alt="User Image">
                                        <span class="hidden-xs">
                                            {{ $user->name }}
                                        </span>
                                    </a>
                                @endif
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header flex flex-col items-center">
                                        <img src="{{ asset('uploads/user/' . $user->image) }}" class="img-circle"
                                            alt="User Image">
                                        <p>
                                            {{ $user->name }}
                                            <small>Thành viên vào {{ $user->created_at }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ url('profile-user/' . $user->id) }}"
                                                class="btn btn-success btn-flat bg-green-600">Trang Cá Nhân</a>
                                        </div>

                                        <form action="{{ route('logout') }}" method="POST" class="pull-right">
                                            @csrf
                                            <input type="submit" class="btn btn-danger btn-flat sign_out bg-red-500"
                                                value="Đăng Xuất" />
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('uploads/user/' . $user->image) }}" class="img-circle"
                                alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ $user->name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                        class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <ul class="sidebar-menu" data-widget="tree">
                        @php
                            $segment = Request::segment(1);
                        @endphp
                        @role('admin')
                            <li class="treeview {{ $segment == 'user' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-contacts-fill"></i>
                                    <span> Quản lý Tài Khoản</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('user.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Tài Khoản</a></li>
                                    <li><a href="{{ route('user.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách Tài Khoản</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'role' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-user-2-line"></i>
                                    <span> Quản lý Vai Trò Và Quyền</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('role.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách Vai Trò</a></li>
                                    <li><a href="{{ route('permission.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách quyền</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'category' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-stack-line"></i> <span> Quản lý Danh Mục</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('category.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Danh Mục</a></li>
                                    <li><a href="{{ route('category.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách
                                            Danh Mục</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'genre' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-indent-decrease"></i><span> Quản lý Thể Loại</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('genre.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Thể Loại</a></li>
                                    <li><a href="{{ route('genre.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách
                                            Thể Loại</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'brand' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-building-4-line"></i><span> Quản lý Thương Hiệu</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('brand.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Thương Hiệu</a></li>
                                    <li><a href="{{ route('brand.index') }}"><i class="fa fa-angle-right"></i> Danh sách
                                            Thương Hiệu</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'product' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-shirt-line"></i><span> Quản lý Sản Phẩm</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('product.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Sản Phẩm</a></li>
                                    <li><a href="{{ route('product.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách
                                            Sản Phẩm</a></li>
                                </ul>
                            </li>

                            <li class="treeview {{ $segment == 'storage' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-database-2-line"></i><span> Quản lý kho</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('storage.create') }}"><i class="fa fa-angle-right"></i>Thêm
                                            vào kho</a></li>
                                    <li><a href="{{ route('storage.index') }}"><i class="fa fa-angle-right"></i>Danh
                                            sản phẩm trong kho</a></li>
                                </ul>
                            </li>
                        @endrole
                        @role('admin|writer')
                            <li class="treeview {{ $segment == 'post' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-file-settings-line"></i><span> Quản lý Bài Viết</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('post.create') }}"><i class="fa fa-angle-right"></i> Thêm
                                            Bài Viết</a></li>
                                    <li><a href="{{ route('post.index') }}"><i class="fa fa-angle-right"></i> Danh
                                            sách bài viết</a></li>
                                </ul>
                            </li>
                            <li class="treeview {{ $segment == 'library' ? 'active' : '' }}">
                                <a href="#">
                                    <i class="ri-image-line"></i></i><span> Quản lý Thư Viện</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('library.create') }}"><i class="fa fa-angle-right"></i>Thêm
                                            Hình Ảnh</a></li>
                                    <li><a href="{{ route('library.index') }}"><i class="fa fa-angle-right"></i>Danh
                                            Sách Hình Ảnh</a></li>
                                </ul>
                            </li>
                        @endrole

                    </ul>
                </section>
            </aside>

            @yield('content')
        </div>
    @else
        @yield('content_login')
    @endif
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('backend/js/dashboard.js') }}"></script>
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/tinymce/config.js') }}"></script>
    <script src="{{ asset('backend/js/function.js') }}"></script>

    {{--  <!-- link script riêng -->  --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">
        let table = new DataTable('#table_panigation');
    </script>

    {{--  <--------------------------> Start tinymce <-------------------------->  --}}

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

    <script>
        $('.tinymce_decrisption').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
        $('.tinymce_decrisption').tinymce({
            charset: 'utf-8',
            // ...các tùy chọn khác...
        });
    </script>

    {{--  <-------------------Hiển thị hình ảnh khi thêm mới và update----------------->  --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{--  -------------------show-image-genre----------  --}}
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Hiển thị hình ảnh mới
                        preview.attr('src', e.target.result);
                        imagePreview.show();

                        // Ẩn ảnh cũ
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-genre') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>
    {{--  -------------------show-image-category----------  --}}

    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Hiển thị hình ảnh mới
                        preview.attr('src', e.target.result);
                        imagePreview.show();

                        // Ẩn ảnh cũ
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-category') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>
    {{--  -------------------show-image-post----------  --}}
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        imagePreview.show();
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-post') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>
    {{--  -------------------show image brand----------  --}}
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        imagePreview.show();
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-brand') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>
    {{--  -------------------show image product----------  --}}
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        imagePreview.show();
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-product') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>
    {{--  -------------------show image user----------  --}}
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function(e) {
                var fileInput = e.target;
                var preview = $('#preview');
                var imagePreview = $('#imagePreview');
                var oldImage = $('#oldImage');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        imagePreview.show();
                        oldImage.addClass('hidden');
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addImageBtn').on('click', function(e) {
                var fileInput = $('#imageInput')[0];

                if (fileInput.files.length > 0) {
                    var formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    $.ajax({
                        url: "{{ route('show-image-user') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Image added successfully:', data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding image:', error);
                        },
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '.file_image', function() {
            var form_data = new FormData();
            form_data.append("image", document.querySelector('.file_image').files[0]);

            $.ajax({
                url: "{{ route('store-image-library-ajax') }}",
                method: "POST",
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    if (response.success) {
                        location.reload();
                        $('#success_image').html(
                            '<span class="text-success">Thêm hình ảnh thành công</span>');
                    } else {
                        $('#success_image').html('<span class="text-danger">' + response.message +
                            '</span>');
                    }
                }
            });
        });
    </script>



    {{-- // sap xep danh muc --}}
    <script type="text/javascript">
        $('.cate_position').sortable({
            placehoder: 'ui-state-highlight',
            update: function(event, ui) {
                var array_id = [];
                $('.cate_position tr').each(function() {
                    array_id.push($(this).attr('id'));
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('resorting_cate') }}",
                    method: "POST",
                    data: {
                        array_id: array_id
                    },
                    success: function(data) {
                        alert('Sắp xếp thành công');
                    }
                })
            }
        })
    </script>

    {{--  Cap nhat hinh anh bang ajax  --}}
    <script type="text/javascript">
        $(document).on('change', '.file_image', function() {
            var brand_id = $(this).data('brand_id');
            var files = $("#file-" + brand_id)[0].files;

            var image = document.getElementById("file-" + brand_id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-" + brand_id).files[0]);
            form_data.append("brand_id", brand_id);

            $.ajax({
                url: "{{ route('update-image-brand-ajax') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,

                success: function() {
                    location.reload();
                    $('#success_image').html(
                        '<span class="text-success">Cập nhật hình ảnh thành công</span>');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '.file_image', function() {
            var user_id = $(this).data('user_id');
            var files = $("#file-" + user_id)[0].files;

            var image = document.getElementById("file-" + user_id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-" + user_id).files[0]);
            form_data.append("user_id", user_id);

            $.ajax({
                url: "{{ route('update-image-user-ajax') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,

                success: function() {
                    location.reload();
                    $('#success_image').html(
                        '<span class="text-success">Cập nhật hình ảnh thành công</span>');
                }
            });
        });
    </script>

    {{--  Thay đổi bằng ajax  --}}

    {{-- Slug tự động --}}
    <script type="text/javascript">
        function ChangeToSlug() {

            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gọi hàm để xử lý biểu tượng con mắt cho các trường mật khẩu
            togglePasswordVisibility('.toggle-password-field', '.eye-icon');
        });

        function togglePasswordVisibility(passwordFieldSelector, eyeIconSelector) {
            const passwordFields = document.querySelectorAll(passwordFieldSelector);
            const eyeIcons = document.querySelectorAll(eyeIconSelector);

            eyeIcons.forEach((eyeIcon, index) => {
                eyeIcon.addEventListener('click', function() {
                    const type = passwordFields[index].getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordFields[index].setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '&#128065;' : '&#128064;'; // Change eye icon
                });
            });
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 2rem;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .eye-icon:hover {
            color: #007bff;
        }

        .toggle-password-field:focus {
            border-color: #007bff;
        }

        .toggle-password-field[type="password"] {
            padding-right: 30px;
        }

        .toggle-password {
            color: #555;
        }
    </style>
</body>

</html>
