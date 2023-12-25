@extends('layouts.app')
@section('title', 'Danh sách quyền')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý quyền
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý quyền</a></li>
                <li class="active">Danh sách quyền</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-12" style="margin-bottom: 1rem">
                <a href="{{ route('permission.create') }}" class="btn btn-info">Thêm Quyền</a>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table-hover table" id='table_panigation'>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Quyền</th>
                                    <th scope="col">Quản Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $permission)
                                    <tr id="{{ $permission->id }}">
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['permission.destroy', $permission->id],
                                                'onsubmit' => 'return confirm("Bạn có muốn xóa?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm bg-red-500']) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ route('permission.edit', $permission->id) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
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
