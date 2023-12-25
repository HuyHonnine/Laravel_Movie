@extends('layouts.app')
@if (!isset($role))
    @section('title', 'Thêm mới vai trò')
@else
    @section('title', 'Sửa vai trò')
@endif
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý vai trò
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý vai trò</a></li>
                @if (!isset($role))
                    <li class="active">Thêm mới vai trò</li>
                @else
                    <li class="active">Sửa vai trò</li>
                @endif
            </ol>
        </section>
        <section class="content">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if (!isset($role))
                            <h3 class="box-title">Thêm mới vai trò</h3>
                        @else
                            <h3 class="box-title">Sửa vai trò</h3>
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
                    @if (!isset($role))
                        {!! Form::open(['route' => 'role.store', 'method' => 'POST']) !!}
                    @else
                        {!! Form::open(['route' => ['role.update', $role->id], 'method' => 'PUT']) !!}
                    @endif

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Tên Vai Trò', []) !!}
                            {!! Form::text('name', isset($role) ? $role->name : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu....',
                            ]) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($role))
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
