<?php $__env->startSection('title', 'Quản trị viên'); ?>
<?php $__env->startSection('smallTitle', 'danh sách'); ?>
<?php $__env->startSection('content'); ?>

<div class="box box-primary"><div class="box-body">
<p><a href="<?php echo e(URL::route('dashboard.user.create')); ?>" class="btn btn-primary">Thêm thành viên mới</a></p>

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
    <?php foreach($data as $item): ?>
        <?php $stt++; ?>
        <tr class="odd gradeX" align="center">
            <td><?php echo e($stt); ?></td>
            <td><?php echo e($item->name); ?></td>
            <th><?php echo e($item->email); ?></th>
            <td><?php echo e(dqhLevelName($item->level)); ?></td>
            <td><?php echo e($item->created_at); ?></td>
            <td><a href="<?php echo e(route('dashboard.story.index', ['user_id' => $item->id])); ?>"><?php echo e($item->stories()->count()); ?></a></td>
            <td class="center">
                <form action="<?php echo e(route('dashboard.user.destroy', $item->id)); ?>" method="POST" class="form-inline">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn xóa nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Xóa</button>
                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::route('dashboard.user.edit', $item->id)); ?>">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>