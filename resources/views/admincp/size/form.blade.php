@extends('layouts.app')
@section('title', 'Quản lý kích cỡ')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý kích cỡ
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý kích cỡ</a></li>
                @if (!isset($size))
                    <li class="active">Thêm kích cỡ</li>
                @else
                    <li class="active">Sửa kích cỡ</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($size))
                            <h3 class="box-title">Thêm mới kích cỡ</h3>
                        @else
                            <h3 class="box-title">Sửa kích cỡ</h3>
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
                    @if (!isset($size))
                        {!! Form::open(['route' => 'size.store', 'method' => 'POST']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['size.update', $size->id],
                            'method' => 'PUT',
                        ]) !!}
                    @endif

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu Đề', []) !!}
                            {!! Form::text('title', isset($size) ? $size->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'nhập dữ liệu...',
                            ]) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($size))
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
                            <h3 class="box-title">Danh sách kích cỡ</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table-hover table" id='table_panigation'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Quản Lý</th>
                                        <th scope="col">Tên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $size)
                                        <tr id="{{ $size->id }}">
                                            <th scope="row">{{ $key }}</th>
                                            <td>{{ $size->title }}</td>
                                            <td>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['size.destroy', $size->id],
                                                    'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                                ]) !!}
                                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{ route('size.edit', $size->id) }}" style="margin-top: .5rem"
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
