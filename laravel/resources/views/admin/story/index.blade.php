@extends('layouts.admin')
@section('title', 'Truyện')
@section('smallTitle', 'danh sách')
@section('content')

<div class="box box-primary"><div class="box-body">
<p class="pull-left"><a href="{{ URL::route('dashboard.story.create')}}" class="btn btn-primary">Thêm truyện mới</a></p>
@include('admin.block.searchbox')

<table class="table table-striped table-bordered table-hover" id="dataTableLists">
    <thead>
        <tr align="center">
            <th>Tên truyện</th>
            <th>Chuyên mục</th>
            <th>Tác giả</th>
            <th>Người Đăng</th>
            <th>Số Chương</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
        <tr class="odd gradeX" align="left">
            <td>{!! dqhStatusStoryShow($item->status)  !!} {{ $item->name }}</td>
            <td>
            @foreach ($item->categories as $category)
                {{ $category->name }},
            @endforeach
            </td>
            <td>
            @foreach ($item->authors as $author)
                {{ $author->name }},
            @endforeach
            </td>
            <td>
                {{ $item->user->name  }}
            </td>
            <td>
                {{ $item->chapters->count() }}
            </td>
            <td>

                <form action="{{ route('dashboard.story.destroy', $item->id) }}" method="POST" class="form-inline">
                    <a class="btn btn-success btn-xs" href="{{ URL::route('dashboard.chapter.list', $item->id) }}">
                        <i class="fa fa-book fa-fw"></i> Quản lý chương
                    </a>
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="{{ URL::route('dashboard.story.edit', $item->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if(Request::has('q'))
    {!! $data->appends(
    ['type' => Request::get('type'),
     'q'    => Request::get('q')]
    )->links() !!}
@else
    {!! $data->links() !!}
@endif
</div></div>
@endsection
