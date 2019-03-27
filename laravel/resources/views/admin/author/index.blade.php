@extends('layouts.admin')
@section('title', 'Tác giả')
@section('smallTitle', 'danh sách')
@section('content')

<div id="result"></div>
<div class="box box-primary"><div class="box-body">
<div class="form-inline" >
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="nameAuthor" placeholder="Tên tác giả">
        </div>
      </div>
    <button type="submit" class="btn btn-primary" id="createAuthor">Thêm nhanh</button>
    <a href="{{ URL::route('dashboard.author.create')}}" class="btn btn-primary">Đầy đủ</a>
    <p></p>
</div>

<table class="table table-striped table-bordered table-hover" id="dataTableList">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt = 0; ?>
    @foreach($data as $item)
        <?php $stt++; ?>
        <tr class="odd gradeX" align="center">
            <td>{{ $stt }}</td>
            <td>{{ $item['name'] }}</td>
            <td class="center">
                <form action="{{ route('dashboard.author.destroy', $item['id']) }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>

                    <a class="btn btn-primary btn-xs" href="{{ URL::route('dashboard.author.edit', $item['id']) }}">
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
