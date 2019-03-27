@extends('layouts.admin')
@section('title', 'Chương')
@section('smallTitle', 'thêm mới')
@section('content')
        @include('admin.block.error')
        <div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.chapter.store') }}" method="POST">
            {{ csrf_field() }}
            <input class="form-control" name="story_id" type="hidden" value="{{ old('story_id', $story_id) }}"/>

            <div class="form-group">
                <input class="form-control" name="txtSubname" value="{{ old('txtSubname', $chapterSubname) }}"/>
            </div>

            <div class="form-group">
                <label>Tên truyện</label>
                <input class="form-control" name="txtName" value="{{ old('txtName') }}"/>
            </div>

            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control editor" rows="10" name="txtContent" >{{ old('txtContent') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Đăng chương</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
@endsection
