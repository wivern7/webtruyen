@extends('layouts.admin')
@section('title', 'Quản trị viên')
@section('smallTitle', 'danh sách')
@section('content')

<div class="box box-primary"><div class="box-body">
<p><a href="{{ URL::route('dashboard.user.create')}}" class="btn btn-primary">Thêm thành viên mới</a></p>

<table class="table table-striped table-bordered table-hover" id="dataTableList">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Chức vụ</th>
            <th>Ngày tạo</th>
            <td>Truyện đăng</td>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt = 0; ?>
    @foreach($data as $item)
        <?php $stt++; ?>
        <tr class="odd gradeX" align="center">
            <td>{{ $stt }}</td>
            <td>{{ $item->name }}</td>
            <th>{{ $item->email }}</th>
            <td>{{ dqhLevelName($item->level) }}</td>
            <td>{{ $item->created_at }}</td>
            <td><a href="{{route('dashboard.story.index', ['user_id' => $item->id])}}">{{ $item->stories()->count()  }}</a></td>
            <td class="center">
                <form action="{{ route('dashboard.user.destroy', $item->id) }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="{{ URL::route('dashboard.user.edit', $item->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div></div>
@endsection
