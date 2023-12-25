@extends('layouts.app')
@section('title', 'Thêm Tài Khoản')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý Tài Khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="{{ url('profile-user/' . $user->id) }}">Trang cá nhân</a></li>
                <li class="active">Đổi mật khẩu</li>
            </ol>
        </section>
        <section class="content">
            <div class="row col-md-12">
                <div class="box box-primary" style="padding: 0 1rem">
                    <div class="box-header with-border">
                        <h3 class="box-title">Đổi mật khẩu</h3>
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
                    {!! Form::open(['url' => url('/update-password', [$user->id]), 'method' => 'PUT']) !!}
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 1rem">
                            <div class="form-group row">
                                {!! Form::label('old_password', __('Mật Khẩu Cũ'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('old_password', [
                                        'class' => 'form-control toggle-password-field' . ($errors->has('old_password') ? ' is-invalid' : ''),
                                        'required',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                    <span class="eye-icon toggle-password">&#128065;</span>
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                {!! Form::label('password', __('Mật Khẩu Mới'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', [
                                        'class' => 'form-control toggle-password-field' . ($errors->has('password') ? ' is-invalid' : ''),
                                        'required',
                                        'autocomplete' => 'new-password',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                    <span class="eye-icon toggle-password">&#128065;</span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('password-confirm', __('Xác Nhận Mật Khẩu Mới'), [
                                    'class' => 'col-md-3 col-form-label text-md-end',
                                ]) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation', [
                                        'class' => 'form-control toggle-password-field',
                                        'required',
                                        'autocomplete' => 'new-password',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                    <span class="eye-icon toggle-password">&#128065;</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Đổi mật khẩu', ['class' => 'btn btn-success bg-green-600']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection
