@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý người dùng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý người dùng</a></li>
                <li class="active">Cấp vai trò cho người dùng</li>
            </ol>
        </section>
        <section class="content">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cấp vai trò cho {{ $user->name }}</h3>
                    </div>

                    <div class="box-body">

                        {!! Form::open(['url' => url('/insert-role', [$user->id]), 'method' => 'POST']) !!}
                        {{ csrf_field() }}

                        @foreach ($list_role as $key => $list)
                            {!! Form::radio('role', $list->name, optional($all_colum_roles)->id == $list->id) !!}
                            {!! Form::label($list->id, $list->name) !!}
                        @endforeach
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Cấp vai trò', ['class' => 'btn btn-success bg-green-600']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
