@extends('layouts.app')
@section('title', 'Quản lý màu sắc')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý màu sắc
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý màu sắc</a></li>
                @if (!isset($color))
                    <li class="active">Thêm màu sắc</li>
                @else
                    <li class="active">Sửa màu sắc</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($color))
                            <h3 class="box-title">Thêm mới màu sắc</h3>
                        @else
                            <h3 class="box-title">Sửa màu sắc</h3>
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
                    @if (!isset($color))
                        {!! Form::open(['route' => 'color.store', 'method' => 'POST']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['color.update', $color->id],
                            'method' => 'PUT',
                        ]) !!}
                    @endif

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Tiêu Đề', []) !!}
                            {!! Form::text('name', isset($color) ? $color->name : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu...',
                            ]) !!}
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('bg_color', 'Bảng Màu', []) !!}
                            {!! Form::text('bg_color', isset($color) ? $color->bg_color : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu màu sắc (VD: EF4040)...',
                            ]) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($color))
                            {!! Form::submit('Thêm Dữ Liệu', ['class' => 'btn btn-success bg-green-600']) !!}
                        @else
                            {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success bg-green-600']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title">Danh sách màu sắc</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table-hover table" id='table_panigation'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Quản Lý</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Bảng Màu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $color)
                                        <tr id="{{ $color->id }}">
                                            <th scope="row">{{ $key }}</th>
                                            <td>{{ $color->name }}</td>
                                            <td><span
                                                    class="inline-block h-12 w-12 rounded-full bg-[#{{ $color->bg_color }}] p-6"></span>
                                            </td>
                                            <td>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['color.destroy', $color->id],
                                                    'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                                ]) !!}
                                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{ route('color.edit', $color->id) }}" style="margin-top: .5rem"
                                                    class="btn btn-warning btn-sm">Sửa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
