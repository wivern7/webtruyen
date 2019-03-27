<?php $__env->startSection('title', 'Truyện'); ?>
<?php $__env->startSection('smallTitle', 'thêm mới'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.block.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="box box-primary"><div class="box-body">
    <form action="<?php echo e(route('dashboard.story.store')); ?>" method="POST" id="dqhStoryForm" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label>Tên truyện</label>
            <input class="form-control" name="txtName" value="<?php echo e(old('txtName')); ?>"/>
        </div>
        <div class="form-group">
            <label>Chuyên mục</label>
            <select name="intCategory[]" data-placeholder="Chọn chuyên mục" id="selectCategory" class="form-control chosen-select" multiple>
                <option value=""></option>
                <?php echo e(category_parent($categories)); ?>

            </select>

            <?php if( Auth::user()->isAdmin()): ?>
            <a href="#" class="btn btn-link" id="addNewCategory"><i class="fa fa-plus"></i> Thêm Chuyên Mục Mới</a>
            <div id="addNewCategoryF">
                <div class="form-inline" >
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" id="nameCategory" placeholder="Tên chuyên mục">
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary" id="createCategory">Thêm</button>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Tác giả</label>
            <select name="intAuthor[]" data-placeholder="Chọn tác giả" class="form-control chosen-select" id="selectAuthor" multiple>
                <option value=""></option>
                <?php echo e(author_options($authors)); ?>

            </select>
            <a href="#" class="btn btn-link" id="addNewAuthor"><i class="fa fa-plus"></i> Thêm Tác giả Mới</a>
            <div id="addNewAuthorF">
                <div class="form-inline" >
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" id="nameAuthor" placeholder="Tên tác giả">
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary" id="createAuthor">Thêm</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Mô tả nội dung</label>
            <textarea class="form-control editor" rows="10" name="txtContent" ><?php echo e(old('txtContent')); ?></textarea>
        </div>
        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="fImages">
        </div>
        <div class="form-group">
            <label>Từ khoá</label>
            <input class="form-control" name="txtKeyword" value="<?php echo e(old('txtKeyword')); ?>"/>
        </div>
        <div class="form-group">
            <label>Mô tả ngắn</label>
            <textarea name="txtDescription" class="form-control" rows="3"><?php echo e(old('txtDescription')); ?></textarea>
        </div>

        <div class="form-group">
            <label>Nguồn truyện</label>
            <input class="form-control" name="txtSource" value="<?php echo e(old('txtSource')); ?>" />
        </div>

        <div class="form-group">
            <label>Tình trạng</label>
            <select name="selStatus" class="form-control">
                <option value="0">Đang cập nhật</option>
                <option value="1">Hoàn thành</option>
                <option value="2">Ngưng cập nhật</option>
                <?php /*<option value="3">Bản nháp (không đăng)</option>*/ ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Đăng truyện</button>
        <button type="reset" class="btn btn-default">Làm lại</button>
    <form>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>