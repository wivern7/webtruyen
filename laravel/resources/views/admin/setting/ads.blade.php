@extends('layouts.admin')
@section('title', 'Chỉnh sửa quảng cáo')
@section('smallTitle', '')
@section('content')
@include('admin.block.error')
<div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.setting.update') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_redirect" value="dashboard.setting.ads">
            <div class="form-group">
                <label>Đầu trang</label>
                <textarea name="ads_header" class="form-control" cols="30" rows="10">{{ old('ads_header', \App\Option::getvalue('ads_header'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Cuối Trang</label>
                <textarea name="ads_footer" class="form-control" cols="30" rows="10">{{ old('ads_footer', \App\Option::getvalue('ads_footer'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Ở giữa truyện</label>
                <textarea name="ads_story" id="ads_story" class="form-control" cols="30" rows="10">{{ old('ads_story', \App\Option::getvalue('ads_story'))}}</textarea>
            </div>
            <div class="form-group">
                <label>Ở Cuối Chương</label>
                <textarea name="ads_chapter" id="description" class="form-control" cols="30" rows="10">{{ old('ads_chapter', \App\Option::getvalue('ads_chapter'))}}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div></div>
@endsection()
