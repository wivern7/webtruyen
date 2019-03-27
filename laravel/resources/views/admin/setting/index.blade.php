@extends('layouts.admin')
@section('title', 'Cài đặt hệ thống')
@section('smallTitle', '')
@section('content')

@include('admin.block.error')
<div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.setting.update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_redirect" value="dashboard.setting.index">
            <div class="form-group">
                <label>Tên của web</label>
                <input type="text" class="form-control" name="sitename" value="{{ old('sitename', \App\Option::getvalue('sitename'))}}" />
            </div>
            <div class="form-group">
                <label>Từ khóa</label>
                <input type="text" class="form-control" name="keyword" value="{{ old('keyword', \App\Option::getvalue('keyword'))}}" />
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', \App\Option::getvalue('description'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Cho phép đăng ký </label>
                <input type="checkbox" value="1" name="has_register" {{ (\App\Option::getvalue('has_register') == 1 ? 'checked' : '') }}>
            </div>
            <div class="form-group">
                <label>Email Liên Hệ</label>
                <input type="text" class="form-control" name="email_contact" value="{{ old('email_contact', \App\Option::getvalue('email_contact'))}}" />
            </div>
            <div class="form-group">
                <label>Fanpage</label>
                <input type="text" class="form-control" name="fb_fanpage" value="{{ old('fb_fanpage', \App\Option::getvalue('fb_fanpage '))}}" />
            </div>
            <div class="form-group">
                <label>Facebook AppID</label>
                <input type="text" class="form-control" name="fb_app" value="{{ old('fb_app', \App\Option::getvalue('fb_app'))}}" />
            </div>
            <div class="form-group">
                <label>Facebook Admin ID</label>
                <input type="text" class="form-control" name="fb_admin_id" value="{{ old('fb_admin_id', \App\Option::getvalue('fb_admin_id'))}}" />
            </div>
            <div class="form-group">
                <label>Google Analytics</label>
                <input type="text" class="form-control" name="google_analytics" value="{{ old('google_analytics', \App\Option::getvalue('google_analytics'))}}" />
            </div>
            <div class="form-group">
                <label>Google Webmaster Veri</label>
                <input type="text" class="form-control" name="google_veri" value="{{ old('fb_app', \App\Option::getvalue('google_veri'))}}" />
            </div>
            <div class="form-group">
                <label>Copyright Text</label>
                <textarea name="copyright" id="description" class="form-control" cols="30" rows="10">{{ old('copyright', \App\Option::getvalue('copyright'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Đoạn mã Header</label>
                <textarea name="pageheader" id="description" class="form-control" cols="30" rows="10">{{ old('pageheader', \App\Option::getvalue('pageheader'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Đoạn mã Footer</label>
                <textarea name="pagefooter" id="description" class="form-control" cols="30" rows="10">{{ old('pagefooter', \App\Option::getvalue('pagefooter'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Ảnh đóng dấu</label>
                    <p><img src="{{ url('assets/images/watermark.png') }}" alt="thumbnail"></p>
                <input type="file" name="fImages">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div></div>
@endsection()
