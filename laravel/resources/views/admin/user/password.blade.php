@extends('layouts.admin')
@section('title', 'Quản trị')
@section('smallTitle', 'Thêm mới')
@section('content')
        @include('admin.block.error')
        <div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.changepassword') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu mới" />
            </div>
            <div class="form-group">
                <label>Mật khẩu xác nhận</label>
                <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập mật khẩu mới" />
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
@endsection()
