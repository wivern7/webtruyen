<?php $__env->startSection('title', 'Tác giả'); ?>
<?php $__env->startSection('smallTitle', 'Thêm mới'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.block.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="box box-primary"><div class="box-body">
    <form action="<?php echo e(route('dashboard.author.store')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label>Tên tác giả</label>
            <input class="form-control" name="txtAuthorName" placeholder="Nhập tên của tác giả" />
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
        <button type="reset" class="btn btn-default">Làm lại</button>
    <form>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>