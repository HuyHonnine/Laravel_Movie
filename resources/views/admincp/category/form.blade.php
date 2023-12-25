@extends('layouts.app')
@if (!isset($category))
    @section('title', 'Thêm danh mục')
@else
    @section('title', 'Sửa danh mục')
@endif

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý Danh Mục
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý danh mục</a></li>
                @if (!isset($category))
                    <li class="active">Thêm danh mục</li>
                @else
                    <li class="active">Sửa danh mục</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($category))
                            <h3 class="box-title">Thêm mới danh mục</h3>
                        @else
                            <h3 class="box-title">Sửa danh mục</h3>
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
                    @if (!isset($category))
                        {!! Form::open(['route' => 'category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['category.update', $category->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @endif

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu Đề', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu...',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Mô Tả', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu...',
                                'style' => 'resize: none',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng Thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiện Thị', '0' => 'Ẩn Đi'], isset($category) ? $category->status : '', [
                                'class' => 'form-control h-100',
                            ]) !!}
                        </div>
                        <div class="form-group row">
                            <div class="form-group">
                                {!! Form::label('image', 'Hình Ảnh') !!}
                                {!! Form::file('image', ['class' => 'form-control-file', 'id' => 'imageInput']) !!}
                            </div>
                            @if (isset($category))
                                <img class='w-[20%] object-cover' style="margin-top: 1rem" id="oldImage"
                                    src="{{ asset('uploads/category/' . $category->image) }}" alt="">
                            @endif

                            <div id="imagePreview" style="display:none;">
                                <img id="preview" src="#" alt="Hình Ảnh"
                                    style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($category))
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
@endsection
