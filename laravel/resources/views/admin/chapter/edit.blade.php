@extends('layouts.admin')
@section('title', 'Chương')
@section('smallTitle', 'Sửa')
@section('content')

        @include('admin.block.error')
        <div class="box box-primary"><div class="box-body">
        <form action="{{ route('dashboard.chapter.update', $chapter->id) }}" method="POST">
            {{ csrf_field() }}
            <input class="form-control" name="id" type="hidden" value="{{ old('id', $chapter->id) }}"/>
            <input class="form-control" name="_method" type="hidden" value="PUT"/>
            <div class="form-group">
                <input class="form-control" name="txtSubname" value="{{ old('txtSubname', $chapter->subname) }}"/>
            </div>

            <div class="form-group">
                <label>Tên truyện</label>
                <input class="form-control" name="txtName" value="{{ old('txtName', $chapter->name) }}"/>
            </div>

            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control editor" rows="10" name="txtContent" >{{ old('txtContent', $chapter->content ) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
@endsection
