<?php $__env->startSection('title', 'Quản trị'); ?>
<?php $__env->startSection('smallTitle', 'Thêm mới'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.block.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="box box-primary"><div class="box-body">
    <form action="<?php echo e(route('dashboard.user.store')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label>Tên tác giả</label>
            <input type="text" class="form-control" name="txtName" placeholder="Nhập tên thành viên" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Nhập email thành viên" />
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu thành viên" />
        </div>
        <div class="form-group">
            <label>Mật khẩu xác nhận</label>
            <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập mật khẩu thành viên" />
        </div>

        <div class="form-group">
            <label>Chức vụ</label>
            <select class="form-control" name="txtLevel" placeholder="Chọn chức vụ">
                <option value="0">Thành viên</option>
                <option value="1">Biên Soạn</option>
                <option value="2">Quản trị</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tạo mới</button>
        <button type="reset" class="btn btn-default">Làm lại</button>
    <form>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>