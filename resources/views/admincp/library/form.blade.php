@extends('layouts.app')
@section('title', 'Thêm hình ảnh')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý thư viện
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý thư viện</a></li>
                <li class="active">Thêm hình ảnh</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm hình ảnh</h3>
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
                    @if (!isset($library))
                        {!! Form::open(['route' => 'library.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open([
                            'route' => ['library.update', $library->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình Ảnh', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        @if (!isset($library))
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
