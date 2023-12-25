@extends('layouts.app')
@if (!isset($permission))
    @section('title', 'Thêm quyền mới')
@else
    @section('title', 'Sửa quyền')
@endif
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý quyền
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý quyền</a></li>
                @if (!isset($permission))
                    <li class="active">Thêm quyền mới</li>
                @else
                    <li class="active">sửa quyền</li>
                @endif
            </ol>
        </section>
        <section class="content">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($permission))
                            <h3 class="box-title">Thêm quyền mới</h3>
                        @else
                            <h3 class="box-title">Sửa quyền</h3>
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
                    @if (!isset($permission))
                        {!! Form::open(['route' => 'permission.store', 'method' => 'POST']) !!}
                    @else
                        {!! Form::open(['route' => ['permission.update', $permission->id], 'method' => 'PUT']) !!}
                    @endif

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Tên quyền', []) !!}
                            {!! Form::text('name', isset($permission) ? $permission->name : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu....',
                            ]) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($permission))
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
