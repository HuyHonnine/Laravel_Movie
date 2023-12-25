@extends('layouts.app')
@if (!isset($post))
    @section('title', 'Thêm bài viết mới')
@else
    @section('title', 'Sửa bài viết')
@endif
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý bài viết
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý bài viết</a></li>
                @if (!isset($post))
                    <li class="active">Thêm bài viết mới</li>
                @else
                    <li class="active">Sửa bài viết</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-12">
                <div class="">
                    <div class="box-header with-border">
                        @if (!isset($post))
                            <h3 class="box-title">Thêm mới bài viết</h3>
                        @else
                            <h3 class="box-title">Sửa bài viết</h3>
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
                    @if (!isset($post))
                        {!! Form::open(['route' => 'post.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['post.update', $post->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @endif
                    <div class="box-body space-x-2">
                        <div class="col-md-8 box box-primary px-10 py-4">
                            <div class="form-group row">
                                {!! Form::label('title', 'Tên bài viết') !!}
                                {!! Form::text('title', isset($post) ? $post->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                    'id' => 'slug',
                                    'onkeyup' => 'ChangeToSlug()',
                                ]) !!}
                            </div>
                            <div class="form-group row">
                                {!! Form::label('slug', 'Slug') !!}

                                {!! Form::text('slug', isset($post) ? $post->slug : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                    'id' => 'convert_slug',
                                ]) !!}
                            </div>
                            <div class="form-group row">
                                {!! Form::label('meta', 'Mô Tả') !!}

                                {!! Form::textarea('meta', isset($post) ? $post->meta : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'nhập dữ liệu...',
                                    'style' => 'resize: none',
                                ]) !!}
                            </div>

                            <div class="form-group row">
                                {!! Form::label('content', 'Nội Dung') !!}
                                {!! Form::textarea('content', isset($post) ? $post->content : '', [
                                    'class' => 'form-control tinymce_decrisption',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box box-primary px-10 py-4">
                                @role('admin')
                                    <div class="form-group row">
                                        {!! Form::label('status', 'Trạng Thái', []) !!}
                                        {!! Form::select('status', ['1' => 'Hiện Thị', '0' => 'Nháp'], isset($post) ? $post->status : '', [
                                            'class' => 'form-control h-100 cursor-pointer font-semibold',
                                        ]) !!}
                                    </div>
                                @endrole
                                @role('writer')
                                    <div class="form-group row">
                                        {!! Form::label('status', 'Trạng Thái', []) !!}
                                        {!! Form::select('status', ['0' => 'Nháp'], isset($post) ? $post->status : '', [
                                            'class' => 'form-control h-100 cursor-pointer font-semibold',
                                        ]) !!}
                                    </div>
                                @endrole

                            </div>
                            <div class="box px-10 py-4">
                                {!! Form::label('genre', 'Chuyên mục bài viết', []) !!}
                                {!! Form::select('genre_id', $genre, isset($post) ? $post->genre_id : '', [
                                    'class' => 'form-control h-100 cursor-pointer font-semibold',
                                    'id' => 'genre_id',
                                ]) !!}
                            </div>
                            <div class="box px-10 py-4">
                                {!! Form::label('user', 'Tác Giả', []) !!}
                                {!! Form::select('user_id', $user, isset($post) ? $post->user_id : Auth::id(), [
                                    'class' => 'form-control h-100 cursor-pointer font-semibold',
                                    'id' => 'user_id',
                                ]) !!}
                            </div>
                            <div class="box px-10 py-4">
                                <div class="form-group">
                                    {!! Form::label('image', 'Hình Ảnh') !!}
                                    {!! Form::file('image', ['class' => 'form-control-file', 'id' => 'imageInput']) !!}
                                </div>
                                @if (isset($post))
                                    <img class='w-[20%] object-cover' style="margin-top: 1rem" id="oldImage"
                                        src="{{ asset('uploads/post/' . $post->image) }}" alt="">
                                @endif

                                <div id="imagePreview" style="display:none;">
                                    <img id="preview" src="#" alt="Hình Ảnh"
                                        style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        @if (!isset($post))
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
