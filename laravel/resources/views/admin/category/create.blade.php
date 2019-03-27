@extends('layouts.admin')
@section('title', 'Chuyên mục')
@section('smallTitle', 'Thêm mới')
@section('content')

@include('admin.block.error')

<div class="box box-primary">
  <div class="box-header with-border">
      <h3 class="box-title">Tạo chuyên mục mới</h3>
  </div>
  <div class="box-body">

    <form action="{{ route('dashboard.category.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Chuyên mục cha</label>
            <select name="intParent" class="form-control">
                <option value="0">Không có</option>
                {{ category_parent($parent) }}
            </select>
        </div>
        <div class="form-group">
            <label>Tên chuyên mục</label>
            <input class="form-control" name="txtCategoryName" placeholder="Nhập tên của chuyên mục" />
        </div>
        <div class="form-group">
            <label>Từ khóa tìm kiếm</label>
            <input class="form-control" name="txtKeyword" placeholder="Từ khóa thứ 1, từ khóa 2, từ khóa 3" />
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="txtDescription" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tạo mới</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>
    <form>
    </div>
</div>
@endsection()
