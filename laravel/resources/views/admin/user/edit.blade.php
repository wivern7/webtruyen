@extends('layouts.admin')
@section('title', 'Quản trị')
@section('smallTitle', 'Sửa')
@section('content')

        @include('admin.block.error')
        <div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="form-group">
                <label>Tên tác giả</label>
                <input type="text" class="form-control" name="txtName" placeholder="Nhập tên thành viên" value="{{old('txtName', $user->name)}}"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="txtEmail" placeholder="Nhập email thành viên" value="{{old('txtEmail', $user->email)}}"/>
            </div>
            <div class="form-group">
                <label>Mật khẩu (để trống để không thay đổi)</label>
                <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu thành viên" />
            </div>
            <div class="form-group">
                <label>Mật khẩu xác nhận</label>
                <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập mật khẩu thành viên" />
            </div>

            <div class="form-group">
                <label>Chức vụ</label>
                <select class="form-control" name="txtLevel" placeholder="Chọn chức vụ">
                    <option value="0">Thành viên</option>
                    <option value="1" {{ ($user->level == 1) ? 'selected' : '' }}>Biên Soạn</option>
                    <option value="2" {{ ($user->level == 2) ? 'selected' : '' }}>Quản trị</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
@endsection()
