<?php $__env->startSection('title', 'Bảng Quản Trị'); ?>
<?php $__env->startSection('smallTitle', 'Trang chủ'); ?>
<?php $__env->startSection('content'); ?>

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
                            <td><strong><?php echo e(Auth::user()->name); ?></strong></td>
                        </tr>
                        <tr>
                            <td>Chức vụ</td>
                            <td><strong><?php echo e(dqhLevelName(Auth::user()->level)); ?></strong></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo e(Auth::user()->email); ?></td>
                        </tr>
                        <tr>
                            <td>Ngày tham gia</td>
                            <td><?php echo e(Auth::user()->created_at); ?></td>
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

        <?php if(Auth::user()->isComposer()): ?>

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
                                <td><strong><?php echo e(Auth::user()->stories()->count()); ?></strong></td>
                            </tr>
                            <tr>
                                <td><a href="<?php echo e(route('dashboard.story.create')); ?>">Đăng truyện mới</a></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php endif; ?>

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
                      <?php foreach($data as $item): ?>
                      <li><a href="<?php echo e(route('story.show', $item->story->alias)); ?>/"><?php echo e($item->story->name); ?></a> (<a href="<?php echo e(route('chapter.show', [$item->story->alias, $item->chapter->alias])); ?>">Đọc tiếp <?php echo e($item->chapter->subname); ?></a>)</li>
                      <?php endforeach; ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>