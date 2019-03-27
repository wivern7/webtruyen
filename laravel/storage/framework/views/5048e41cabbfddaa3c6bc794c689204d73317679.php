<?php $__env->startSection('title', 'Truyện'); ?>
<?php $__env->startSection('smallTitle', 'danh sách'); ?>
<?php $__env->startSection('content'); ?>

<div class="box box-primary"><div class="box-body">
<p class="pull-left"><a href="<?php echo e(URL::route('dashboard.story.create')); ?>" class="btn btn-primary">Thêm truyện mới</a></p>
<?php echo $__env->make('admin.block.searchbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<table class="table table-striped table-bordered table-hover" id="dataTableLists">
    <thead>
        <tr align="center">
            <th>Tên</th>
            <th>Chuyên mục</th>
            <th>Tác giả</th>
            <th>Người Đăng</th>
            <th>Số Chương</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $item): ?>
        <tr class="odd gradeX" align="center">
            <td><?php echo dqhStatusStoryShow($item->status); ?> <?php echo e($item->name); ?></td>
            <td>
            <?php foreach($item->categories as $category): ?>
                <?php echo e($category->name); ?>,
            <?php endforeach; ?>
            </td>
            <td>
            <?php foreach($item->authors as $author): ?>
                <?php echo e($author->name); ?>,
            <?php endforeach; ?>
            </td>
            <td>
                <?php echo e($item->user->name); ?>

            </td>
            <td>
                <?php echo e($item->chapters->count()); ?>

            </td>
            <td>

                <form action="<?php echo e(route('dashboard.story.destroy', $item->id)); ?>" method="POST" class="form-inline">
                    <a class="btn btn-success btn-xs" href="<?php echo e(URL::route('dashboard.chapter.list', $item->id)); ?>">
                        <i class="fa fa-book fa-fw"></i> Quản lý chương
                    </a>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::route('dashboard.story.edit', $item->id)); ?>">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if(Request::has('q')): ?>
    <?php echo $data->appends(
    ['type' => Request::get('type'),
     'q'    => Request::get('q')]
    )->links(); ?>

<?php else: ?>
    <?php echo $data->links(); ?>

<?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>