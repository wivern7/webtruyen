@extends('layouts.admin')
@section('title', isset($story->name) ? $story->name : 'Tổng hợp chương')
@section('smallTitle', 'danh sách chương')
@section('content')
        <!-- /.col-lg-12 -->
<div class="box box-primary"><div class="box-body">
<p class="pull-left">
    <a href="{{ URL::route('dashboard.story.index')}}" class="btn btn-primary">
        <i class="fa fa-book"></i>
        Quản lý Truyện
    </a>

    @if (isset($story->name))
    <a href="{{ URL::route('dashboard.chapter.index')}}" class="btn btn-primary">
        <i class="fa fa-book"></i>
        Toàn Bộ Chương
    </a>
    <a href="{{ URL::route('dashboard.chapter.create', ['parentID' => $story->id])}}" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        Thêm chương mới
    </a>
    @endif

</p>
@include('admin.block.searchbox')

<table class="table table-striped table-bordered table-hover" id="dataTableLists">
    <thead>
    <tr align="center">
        <th>Tên mục</th>
        <th>Tên Chương</th>

        @if (!isset($story->name))
        <th>Thuộc</th>
        @endif

        <th>Ngày Cập Nhật</th>
        <th>Công cụ</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($chapters as $item)
        <tr class="odd gradeX" align="left">
            <td>{{ $item->subname }}</td>
            <td>{{ $item->name }}</td>

            @if (!isset($story->name))
                <td>
                    {{ $item->story->name }}
                </td>
            @endif
            <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
            <td>
                <form action="{{ route('dashboard.chapter.destroy', $item->id) }}" method="POST" class="form-inline">
                    <a href="{{ URL::route('dashboard.chapter.create', ['parentID' => $item->story_id])  }}" class="btn btn-success btn-xs">
                        <i class="fa fa-plus">
                            Thêm chương mới
                        </i>
                    </a>
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="{{ URL::route('dashboard.chapter.edit', $item->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@if(Request::has('q'))
    {!! $chapters->appends(
    ['type' => Request::get('type'),
     'q'    => Request::get('q')]
    )->links() !!}
@else
    {!! $chapters->links() !!}
@endif
</div></div>
@endsection
