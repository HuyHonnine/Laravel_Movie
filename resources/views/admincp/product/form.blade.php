@extends('layouts.app')
@if (!isset($product))
    @section('title', 'Thêm thông tin sản phẩm')
@else
    @section('title', 'Sửa thông tin sản phẩm')
@endif
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý sản phẩm</a></li>
                @if (!isset($product))
                    <li class="active">Thêm thông tin sản phẩm</li>
                @else
                    <li class="active">Sửa thông tin sản phẩm</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($product))
                            <h3 class="box-title">Thêm thông tin sản phẩm</h3>
                        @else
                            <h3 class="box-title">Sửa thông tin sản phẩm</h3>
                        @endif
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" style="padding: 0.75rem 2.25rem; margin-bottom: 0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($product))
                        {!! Form::open(['route' => 'product.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['product.update', $product->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @endif
                    <div class="box-body z-1 relative">
                        <div class="col-md-12">
                            <div class="col-md-4" style="margin-top: 1rem">
                                <div class="form-group row">
                                    {!! Form::label('title', 'Tên sản phẩm') !!}
                                    {!! Form::text('title', isset($product) ? $product->title : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                        'id' => 'slug',
                                        'onkeyup' => 'ChangeToSlug()',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('slug', 'Slug') !!}

                                    {!! Form::text('slug', isset($product) ? $product->slug : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                        'id' => 'convert_slug',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('description', 'Mô Tả') !!}

                                    {!! Form::textarea('description', isset($product) ? $product->description : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'nhập dữ liệu...',
                                        'style' => 'resize: none',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('hot', 'Nổi Bật') !!}
                                    {!! Form::select('hot', ['0' => 'KHÔNG', '1' => 'CÓ'], isset($product) ? $product->hot : '', [
                                        'class' => 'form-control h-100',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('status', 'Trạng Thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiện Thị', '0' => 'Ẩn Đi'], isset($product) ? $product->status : '', [
                                        'class' => 'form-control h-100',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('Category', 'Danh Mục sản phẩm', []) !!}
                                    {!! Form::select('category_id', $category, isset($product) ? $product->category_id : '', [
                                        'class' => 'form-control h-100',
                                        'id' => 'category_id',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('Brand', 'Thương hiệu sản phẩm', []) !!}
                                    {!! Form::select('brand_id', $brand, isset($product) ? $product->brand_id : '', [
                                        'class' => 'form-control h-100',
                                        'id' => 'brand_id',
                                    ]) !!}
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('price', 'Giá Thành') !!}
                                    {!! Form::text('price', isset($product) ? $product->price : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-top: 1rem">
                                <div class="form-group">
                                    {!! Form::label('content', 'Nội Dung') !!}
                                    {!! Form::textarea('content', isset($product) ? $product->content : '', [
                                        'class' => 'form-control tinymce_decrisption',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Image', 'Hình Ảnh Đại Diện', []) !!}
                                    {!! Form::file('image', ['class' => 'form-control-file']) !!}
                                    @if (isset($product))
                                        <img style="margin-top: 1rem" width="30%"
                                            src="{{ asset('uploads/product/' . $product->image) }}" alt="">
                                    @endif
                                </div>

                                <p class="btn btn-primary btn-sm" id="library-btn">Thêm Ảnh Khác</p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 95%;" id="library"
                        class="library absolute left-10 top-[10rem] z-10 translate-y-5 scale-0 border border-black bg-white p-8 shadow-[100vh_100vh_100vh_200vh_rgba(0,0,0,0.4)]">
                        <div class="ri-close-line absolute right-2 top-2 cursor-pointer text-[3rem] font-bold hover:text-red-500"
                            id="close-menu"></div>
                        <h1 class="mb-4 text-3xl font-semibold text-[#222d32]">Thư Viện Ảnh</h1>
                        <div class="flex flex-row items-center bg-[#222d32]">
                            <p class="cursor-pointer px-4 py-2 text-white hover:shadow-[0px_10px_10px_rgba(0,0,0,0.4)]"
                                id="load-image-btn">Tải Hình</p>
                            <p class="cursor-pointer border border-black px-4 py-2 text-white hover:shadow-[0px_10px_10px_rgba(0,0,0,0.4)]"
                                id="show-images-btn">Hình Ảnh
                            </p>
                        </div>

                        <div id="load-image-section">
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="file" class="form-control-static file_image" accept="image/*">
                                    <span id="success_image"></span>
                                </div>
                            </div>
                        </div>


                        <div id="show-images-section">
                            <div class="flex flex-row flex-wrap items-center justify-center gap-6 overflow-auto">
                                @foreach ($list_library as $key => $list)
                                    <div class="relative">
                                        {!! Form::checkbox(
                                            'library[]',
                                            $list->id,
                                            isset($product_library) && $product_library->contains($list->id) ? true : false,
                                            [
                                                'class' => 'absolute cursor-pointer top-4 left-2',
                                            ],
                                        ) !!}
                                        <img class="h-[10rem] w-[15rem] rounded-lg border border-black object-cover"
                                            style="margin-top: 1rem" width="30%"
                                            src="{{ asset('uploads/library/' . $list->image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($product))
                            {!! Form::submit('Thêm Dữ Liệu', ['class' => 'btn btn-success bg-green-600']) !!}
                        @else
                            {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success bg-green-600']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function() {
            uploadImage();
        });

        function uploadImage() {
            var input = document.getElementById('imageInput');
            var file = input.files[0];
            var formData = new FormData();
            formData.append('image', file);

            axios.post('/library/store_image', formData)
                .then(function(response) {
                    // Xử lý phản hồi từ server, ví dụ hiển thị ảnh đã tải lên
                    var previewDiv = document.getElementById('preview');
                    previewDiv.innerHTML = '<img src="' + response.data.imagePath + '" alt="Preview">';
                })
                .catch(function(error) {
                    console.error('Error uploading image:', error);
                });
        }
    </script>

    <script>
        let library = document.querySelector('#library');
        let loadImageSection = document.querySelector('#load-image-section');
        let showImagesSection = document.querySelector('#show-images-section');

        document.querySelector('#load-image-btn').onclick = () => {
            loadImageSection.style.display = 'block';
            showImagesSection.style.display = 'none';
        }

        document.querySelector('#show-images-btn').onclick = () => {
            loadImageSection.style.display = 'none';
            showImagesSection.style.display = 'block';
        }

        document.querySelector('#library-btn').onclick = () => {
            library.classList.toggle('active');
        }

        document.querySelector('#close-menu').onclick = () => {
            library.classList.remove('active')
        }
    </script>
    <style>
        #library {
            transform: scale(0);
        }

        #library.active {
            transform: scale(1);
        }

        #load-image-section {
            display: none;
        }
    </style>
@endsection
