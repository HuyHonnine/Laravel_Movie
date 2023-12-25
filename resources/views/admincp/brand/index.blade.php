@extends('layouts.app')
@section('title', 'Danh Sách Thương Hiệu')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý thương hiệu
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý thương hiệu</a></li>
                <li class="active">Danh sách thương hiệu</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table-hover table" id='table_panigation'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Quản Lý</th>
                                    <th scope="col">Tiêu Đề</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Hiển Thị/Không</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $brand)
                                    <tr id="{{ $brand->id }}">
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['brand.destroy', $brand->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ route('brand.edit', $brand->id) }}" style="margin-top: .5rem"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td>{{ $brand->title }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>{{ $brand->description }}</td>
                                        <td>
                                            <img style="margin-top: 1rem; height: 5rem;"
                                                src="{{ asset('uploads/brand/' . $brand->image) }}" alt="">
                                            <input type="file" data-brand_id="{{ $brand->id }}"
                                                id="file-{{ $brand->id }}" class="form-control-static file_image"
                                                accept="image/*">
                                            <span id="success_image"></span>
                                        </td>
                                        <td>
                                            @if ($brand->status == 1)
                                                <span class="label label-success">Hiển Thị</span>
                                            @else
                                                <span class="label label-danger">Không Hiển Thị</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
