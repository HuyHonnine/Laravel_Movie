@extends('layouts.app')
@section('title', 'Danh Sách Tài Khoản')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý tài khoản</a></li>
                <li class="active">Danh sách tài khoản</li>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Gmail</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Ngày Sinh</th>
                                    <th scope="col">Số ĐT</th>
                                    <th scope="col">Vai Trò</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Quản Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $user)
                                    <tr id="{{ $user->id }}">
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->description }}</td>
                                        <td>{{ $user->birthday }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @foreach ($user->roles as $key => $role)
                                                <span class="label label-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($user->status == 1)
                                                <span class="label label-success">Sử Dụng</span>
                                            @else
                                                <span class="label label-danger">Đóng</span>
                                            @endif
                                        </td>

                                        <td>
                                            <img style="margin-top: 1rem; height: 10rem; width: 10rem"
                                                src="{{ asset('uploads/user/' . $user->image) }}" alt="">
                                            <input type="file" data-user_id="{{ $user->id }}"
                                                id="file-{{ $user->id }}" class="form-control-static file_image"
                                                accept="image/*">
                                            <span id="success_image"></span>
                                        </td>

                                        <td class="row col-md-11">
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['user.destroy', $user->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                            ]) !!}
                                            <a href="{{ url('assign-role/' . $user->id) }}"
                                                class="btn btn-sm btn-success bg-green-600">Cấp vai trò</a>
                                            <a href="{{ route('user.edit', $user->id) }}"
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
