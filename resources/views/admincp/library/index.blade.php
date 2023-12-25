@extends('layouts.app')
@section('title', 'Danh Sách Hình Ảnh')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý thư viện
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="#">Quản lý thư viện</a></li>
                <li class="active">Danh sách hình ảnh</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="col-xs-12">
                <div class="box relative flex flex-row flex-wrap gap-6">
                    @foreach ($list as $key => $library)
                        <div class="group flex items-center justify-center" id="{{ $library->id }}">
                            <div class="absolute" style="line-height: 2.5">
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['library.destroy', $library->id],
                                    'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                ]) !!}
                                {!! Form::submit('Xóa', [
                                    'class' =>
                                        'btn btn-danger btn-sm bg-red-500 opacity-0 transition-all group-hover:opacity-100 group-hover:shadow-[0vh_0vh_10px_58px_rgba(0,0,0,0.4)] rounded-[0]',
                                ]) !!}
                                {!! Form::close() !!}
                            </div>
                            <img class="h-[15rem] w-[15rem] object-cover"
                                src="{{ asset('uploads/library/' . $library->image) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
