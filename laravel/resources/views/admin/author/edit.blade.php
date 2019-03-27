@extends('layouts.admin')
@section('title', 'Tác giả')
@section('smallTitle', 'Sửa')
@section('content')

    @include('admin.block.error')
    <div class="box box-primary"><div class="box-body">
    <form action="{{ route('dashboard.author.update', $data['id']) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $data['id'] }}">
        <div class="form-group">
            <label>Tên tác giả</label>
            <input class="form-control" name="txtAuthorName" placeholder="Nhập tên của tác giả" value="{{ old('txtAuthorName', isset($data['name']) ? $data['name'] : '')}}" />
        </div>
        <div class="form-group">
            <label>Từ khóa tìm kiếm</label>
            <input class="form-control" name="txtKeyword" placeholder="Từ khóa thứ 1, từ khóa 2, từ khóa 3" value="{{ old('txtKeyword', isset($data['keyword']) ? $data['keyword'] : '')}}" />
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="txtDescription" class="form-control" rows="3">{{ old('txtDescription', isset($data['description']) ? $data['description'] : '')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <button type="reset" class="btn btn-default">Làm lại</button>
    <form>
</div></div>
@endsection()
