@extends('layouts.app')
@if (!isset($user))
    @section('title', 'Thêm mới tài khoản')
@else
    @section('title', 'Cập nhật thông tin tài khoản')
@endif
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý Tài Khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý tài khoản</a></li>
                @if (!isset($user))
                    <li class="active">Thêm mới tài khoản</li>
                @else
                    <li class="active">Cập nhật tài khoản</li>
                @endif
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="row col-md-12">
                <div class="box box-primary" style="padding: 0 1rem">
                    <div class="box-header with-border">
                        @if (!isset($user))
                            <h3 class="box-title">Thêm mới tài khoản</h3>
                        @else
                            <h3 class="box-title">Cập nhật tài khoản</h3>
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

                    @if (!isset($user))
                        {!! Form::open([
                            'route' => 'user.store',
                            'method' => 'POST',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @else
                        {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 1rem">
                            <div class="form-group row">
                                {!! Form::label('name', __('Tên Người Dùng'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name', old('name', isset($user) ? $user->name : ''), [
                                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                        'required',
                                        'autocomplete' => 'name',
                                        'autofocus',
                                        'placeholder' => 'Nhập dữ liệu...',
                                        'id' => 'slug',
                                        'onkeyup' => 'ChangeToSlug()',
                                    ]) !!}

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('slug', 'Slug', ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('slug', isset($user) ? $user->slug : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                        'id' => 'convert_slug',
                                    ]) !!}
                                </div>

                            </div>

                            <div class="form-group row">
                                {!! Form::label('email', __('Địa chỉ Email'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email', old('email', isset($user) ? $user->email : ''), [
                                        'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                        'required',
                                        'autocomplete' => 'email',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if (!isset($user))
                                <div class="form-group row">
                                    {!! Form::label('password', __('Mật Khẩu'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                    <div class="col-md-6">
                                        {!! Form::password('password', [
                                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                            'required',
                                            'autocomplete' => 'new-password',
                                            'placeholder' => 'Nhập dữ liệu...',
                                        ]) !!}

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {!! Form::label('password-confirm', __('Xác Nhận Mật Khẩu'), ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                    <div class="col-md-6">
                                        {!! Form::password('password_confirmation', [
                                            'class' => 'form-control',
                                            'required',
                                            'autocomplete' => 'new-password',
                                            'placeholder' => 'Nhập dữ liệu...',
                                        ]) !!}
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                {!! Form::label('status', 'Trạng Thái', ['class' => 'col-md-3 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('status', ['1' => 'Hoạt Động', '0' => 'Đóng'], isset($user) ? $user->status : '', [
                                        'class' => 'form-control h-100',
                                    ]) !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" style="margin-top: 1rem">
                            <div class="form-group row">
                                {!! Form::label('phone', 'Số Điện Thoại', ['class' => 'col-md-2 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('phone', isset($user) ? $user->phone : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('birthday', 'Ngày sinh', ['class' => 'col-md-2 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::date('birthday', isset($user) ? $user->birthday : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập dữ liệu...',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('description', 'Mô Tả', ['class' => 'col-md-2 col-form-label text-md-end']) !!}
                                <div class="col-md-6">
                                    {!! Form::textarea('description', isset($user) ? $user->description : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'nhập dữ liệu...',
                                        'style' => 'resize: none, height: 15rem,',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group">
                                    {!! Form::label('image', 'Hình Ảnh') !!}
                                    {!! Form::file('image', ['class' => 'form-control-file', 'id' => 'imageInput']) !!}
                                </div>
                                @if (isset($user))
                                    <img class='w-[20%] object-cover' style="margin-top: 1rem" id="oldImage"
                                        src="{{ asset('uploads/user/' . $user->image) }}" alt="">
                                @endif

                                <div id="imagePreview" style="display:none;">
                                    <img id="preview" src="#" alt="Hình Ảnh"
                                        style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="box-footer">
                        @if (!isset($user))
                            {!! Form::submit('Thêm Tài Khoản', ['class' => 'btn btn-success bg-green-600']) !!}
                        @else
                            {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success bg-green-600']) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection
