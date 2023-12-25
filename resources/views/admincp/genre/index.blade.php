@extends('layouts.app')
@section('title', 'Danh Sách Thể Loại')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý thể loại
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý thể loại</a></li>
                <li class="active">Danh sách thể loại</li>
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
                                @foreach ($list as $key => $genre)
                                    <tr id="{{ $genre->id }}">
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['genre.destroy', $genre->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ route('genre.edit', $genre->id) }}" style="margin-top: .5rem"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td>{{ $genre->title }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td>{{ $genre->description }}</td>
                                        <td>
                                            <img style="margin-top: 1rem; height: 5rem;"
                                                src="{{ asset('uploads/genre/' . $genre->image) }}" alt="">
                                            <input type="file" data-genre_id="{{ $genre->id }}"
                                                id="file-{{ $genre->id }}" class="form-control-static file_image"
                                                accept="image/*">
                                            <span id="success_image"></span>
                                        </td>
                                        <td>
                                            @if ($genre->status == 1)
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
