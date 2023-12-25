@extends('layouts.app')
@section('title', 'Danh Sách Bài Viết')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý bài viết
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý bài viết</a></li>
                <li class="active">Danh sách bài viết</li>
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
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Bài Viết</th>
                                    <th scope="col">Meta</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Thể Loại</th>
                                    <th scope="col">Quản Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $post)
                                    <tr id="{{ $post->id }}">
                                        <th scope="row">{{ $key }}</th>

                                        <td>
                                            <img style="margin-top: 1rem; height: 5rem;"
                                                src="{{ asset('uploads/post/' . $post->image) }}" alt="">
                                        </td>
                                        <td>
                                            <div class="flex flex-col gap-2 align-middle">
                                                <h2 class="text-[1.75rem] font-semibold">{{ $post->title }}</h2>
                                                <span class="text-[1.25rem] italic text-gray-700">{{ $post->slug }}</span>
                                                <div class="flex flex-row">
                                                    <p class="text-[1.25rem] italic text-gray-600"><span
                                                            class="label label-primary">{{ $post->user->name }}</span> - Cập
                                                        nhật lần cuối: {{ $post->date_update }}</p>
                                                </div>
                                            </div>

                                        </td>
                                        <td> {{ substr($post->meta, 0, 60) }}</td>

                                        <td>
                                            @if ($post->status == 1)
                                                <span class="label label-success">Đã Duyệt</span>
                                            @else
                                                <span class="label label-warning">Chờ Duyệt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="label label-primary">{{ $post->genre->title }}</span>
                                        </td>
                                        <td class="row-cols-3" style="line-height: 2.5">
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['post.destroy', $post->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                            ]) !!}
                                            <a href="{{ route('post.edit', $post->id) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                            {!! Form::close() !!}
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
