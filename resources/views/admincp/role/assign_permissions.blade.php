@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý vai trò
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý vai trò</a></li>
                <li class="active">Cấp quyền vai trò</li>
            </ol>
        </section>
        <section class="content">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cấp quyền cho {{ $role->name }}</h3>
                    </div>

                    <div class="box-body">
                        {!! Form::open(['route' => ['insert-permissions', $role->id], 'method' => 'POST']) !!}
                        {{ csrf_field() }}

                        @foreach ($list_permissions as $key => $list)
                            {!! Form::checkbox('permission[]', $list->id, $permissions->contains($list->id), ['id' => $list->id]) !!}
                            {!! Form::label($list->id, $list->name) !!}
                        @endforeach
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Cấp quyền', ['class' => 'btn btn-success bg-green-600']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
