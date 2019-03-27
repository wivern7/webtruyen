@extends('layouts.admin')
@section('title', 'Bảng Quản Trị')
@section('smallTitle', 'Trang chủ')
@section('content')

    <div class="row">

        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Tên</td>
                            <td><strong>{{ Auth::user()->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Chức vụ</td>
                            <td><strong>{{ dqhLevelName(Auth::user()->level) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Ngày tham gia</td>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                        <tr>
                            <td><a href="#">Đổi mật khẩu</a></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(Auth::user()->isComposer())

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thống kê</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tổng số bài viết</td>
                                <td><strong>{{ Auth::user()->stories()->count() }}</strong></td>
                            </tr>
                            <tr>
                                <td><a href="{{ route('dashboard.story.create') }}">Đăng truyện mới</a></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endif

        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Truyện đang xem</h3>
                </div>
                <div class="panel-body">
                  <?php
                  $viewed = new \App\Viewed;
                  $data = $viewed->getListReading();
                  if(count($data) > 0):
                   ?>
                   <ul>
                      @foreach ($data as $item)
                      <li><a href="{{route('story.show', $item->story->alias)}}/">{{ $item->story->name}}</a> (<a href="{{route('chapter.show', [$item->story->alias, $item->chapter->alias])}}">Đọc tiếp {{ $item->chapter->subname}}</a>)</li>
                      @endforeach
                    </ul>
                  <?php else: ?>
                    <p>
                      Bạn chưa đọc truyện nào cả :)
                    </p>
                  <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

@endsection()
