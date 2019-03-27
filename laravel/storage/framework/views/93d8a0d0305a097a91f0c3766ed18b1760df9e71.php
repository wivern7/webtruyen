<?php $__env->startSection('title', 'Quản trị'); ?>
<?php $__env->startSection('smallTitle', 'Thêm mới'); ?>
<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('admin.block.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="box box-primary"><div class="box-body">
        <form action="<?php echo e(route('dashboard.changepassword')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu mới" />
            </div>
            <div class="form-group">
                <label>Mật khẩu xác nhận</label>
                <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập mật khẩu mới" />
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>