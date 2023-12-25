@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý Danh Mục
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý danh mục</a></li>
                <li class="active">Danh sách danh mục</li>
            </ol>
        </section>
        <section class="content">
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
                                    <th scope="col">Hiển Thị/Không</th>
                                    <th scope="col">Hình Ảnh</th>
                                </tr>
                            </thead>
                            <tbody class="cate_position">
                                @foreach ($list as $key => $cate)
                                    <tr id="{{ $cate->id }}">
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['category.destroy', $cate->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ route('category.edit', $cate->id) }}" style="margin-top: .5rem"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td>{{ $cate->title }}</td>
                                        <td>{{ $cate->slug }}</td>
                                        <td>{{ $cate->description }}</td>
                                        <td>
                                            @if ($cate->status == 1)
                                                Hiển Thị
                                            @else
                                                Không Hiển Thị
                                            @endif
                                        </td>
                                        <td>
                                            <img style="margin-top: 1rem; height: 5rem;"
                                                src="{{ asset('uploads/category/' . $cate->image) }}" alt="">
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
