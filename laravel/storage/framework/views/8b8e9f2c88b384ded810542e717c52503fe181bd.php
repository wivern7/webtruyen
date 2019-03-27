<?php $__env->startSection('title', isset($story->name) ? $story->name : 'Tổng hợp chương'); ?>
<?php $__env->startSection('smallTitle', 'danh sách chương'); ?>
<?php $__env->startSection('content'); ?>
        <!-- /.col-lg-12 -->
<div class="box box-primary"><div class="box-body">
<p class="pull-left">
    <a href="<?php echo e(URL::route('dashboard.story.index')); ?>" class="btn btn-primary">
        <i class="fa fa-book"></i>
        Quản lý Truyện
    </a>

    <?php if(isset($story->name)): ?>
    <a href="<?php echo e(URL::route('dashboard.chapter.index')); ?>" class="btn btn-primary">
        <i class="fa fa-book"></i>
        Toàn Bộ Chương
    </a>
    <a href="<?php echo e(URL::route('dashboard.chapter.create', ['parentID' => $story->id])); ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        Thêm chương mới
    </a>
    <?php endif; ?>

</p>
<?php echo $__env->make('admin.block.searchbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<table class="table table-striped table-bordered table-hover" id="dataTableLists">
    <thead>
    <tr align="center">
        <th>Tên mục</th>
        <th>Tên Chương</th>

        <?php if(!isset($story->name)): ?>
        <th>Thuộc</th>
        <?php endif; ?>

        <th>Ngày Cập Nhật</th>
        <th>Công cụ</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($chapters as $item): ?>
        <tr class="odd gradeX" align="left">
            <td><?php echo e($item->subname); ?></td>
            <td><?php echo e($item->name); ?></td>

            <?php if(!isset($story->name)): ?>
                <td>
                    <?php echo e($item->story->name); ?>

                </td>
            <?php endif; ?>
            <td><?php echo e($item->updated_at->format('d/m/Y H:i')); ?></td>
            <td>
                <form action="<?php echo e(route('dashboard.chapter.destroy', $item->id)); ?>" method="POST" class="form-inline">
                    <a href="<?php echo e(URL::route('dashboard.chapter.create', ['parentID' => $item->story_id])); ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-plus">
                            Thêm chương mới
                        </i>
                    </a>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::route('dashboard.chapter.edit', $item->id)); ?>">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if(Request::has('q')): ?>
    <?php echo $chapters->appends(
    ['type' => Request::get('type'),
     'q'    => Request::get('q')]
    )->links(); ?>

<?php else: ?>
    <?php echo $chapters->links(); ?>

<?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>