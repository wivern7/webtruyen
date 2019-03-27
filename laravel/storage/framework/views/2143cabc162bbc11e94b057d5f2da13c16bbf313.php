<?php $__env->startSection('title', 'Chương'); ?>
<?php $__env->startSection('smallTitle', 'thêm mới'); ?>
<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('admin.block.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="box box-primary"><div class="box-body">
        <form action="<?php echo e(route('dashboard.chapter.store')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <input class="form-control" name="story_id" type="hidden" value="<?php echo e(old('story_id', $story_id)); ?>"/>

            <div class="form-group">
                <input class="form-control" name="txtSubname" value="<?php echo e(old('txtSubname', $chapterSubname)); ?>"/>
            </div>

            <div class="form-group">
                <label>Tên truyện</label>
                <input class="form-control" name="txtName" value="<?php echo e(old('txtName')); ?>"/>
            </div>

            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control editor" rows="10" name="txtContent" ><?php echo e(old('txtContent')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Đăng chương</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>