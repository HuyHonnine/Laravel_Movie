@extends('layouts.app')
@section('title', 'Trang Cá Nhân')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="{{ url('profile-user/' . $user->id) }}">Trang cá nhân</a></li>
                <li class="active">Cập nhật tài khoản</li>
            </ol>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row col-md-12">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/user/' . $user->image) }}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <p class="text-muted text-center">
                                    Chức vụ:
                                    @foreach ($user->roles as $key => $role)
                                        <span class="label label-primary">{{ $role->name }}</span>
                                    @endforeach
                                    <i class="fa fa-circle text-success"></i>
                                </p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email: </b> <a class="float-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Ngày sinh: </b> <a class="float-right">{{ $user->birthday }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Điện Thoại: </b> <a class="float-right">{{ $user->phone }}</a>
                                    </li>
                                </ul>
                                <a href="{{ url('edit-user/' . $user->id) }}" class="btn btn-warning btn-block"><b>Chỉnh sửa
                                        thông tin</b></a>

                            </div>

                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Về tôi</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="ri-shield-user-line"></i>
                                    Tiểu Sử</strong>
                                <p class="text-muted">
                                    {{ $user->description }}
                                </p>
                                <hr>
                                <strong><i class="ri-map-pin-line"></i>
                                    </i> Địa Chỉ</strong>
                                <p class="text-muted">Ho Chi Minh, VietNam</p>
                            </div>
                            <a href="{{ url('edit-password/' . $user->id) }}" class="btn btn-danger btn-block"><b>Đổi
                                    Mật Khẩu</b></a>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Activity</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .profile_box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title_profile {
            font-weight: 700;
        }

        .subtitle_profile {
            font-style: italic;
            color: #444;
            font-weight: 500;
        }

        .p_profile {
            margin-top: .5rem;

        }
    </style>
@endsection
