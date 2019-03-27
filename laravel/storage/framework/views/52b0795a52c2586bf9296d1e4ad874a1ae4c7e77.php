<?php $__env->startSection('title', 'Báo cáo'); ?>
<?php $__env->startSection('smallTitle', 'danh sách'); ?>
<?php $__env->startSection('content'); ?>
<!-- /.col-lg-12 -->
<div id="result"></div>

<div class="box box-primary">
  <div class="box-header with-border">
      <h3 class="box-title">Quản lý báo cáo</h3>
  </div>
  <div class="box-body">

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên chương</th>
            <th>Nội dung</th>
            <th>Công cụ</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $item): ?>
        <tr class="odd gradeX" align="center">
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->chapter->name); ?></td>
            <td><?php echo e($item->message); ?></td>
            <td class="center">
                <form action="<?php echo e(route('dashboard.report.destroy', $item->id)); ?>" method="POST" class="form-inline">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return areYouSureDeleteIt('Bạn có chắc là muốn hủy nó không ?');"><i class="fa fa-trash-o  fa-fw"></i> Đã giải quyết</button>

                    <a class="btn btn-primary btn-xs" href="<?php echo e(URL::route('dashboard.chapter.edit', $item->chapter->id)); ?>">
                        <i class="fa fa-pencil fa-fw"></i> Sửa chương
                    </a>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo $data->links(); ?>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>