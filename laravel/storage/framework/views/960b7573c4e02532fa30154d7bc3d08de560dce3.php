<?php $__env->startSection('title', 'Bảng Quản Trị'); ?>
<?php $__env->startSection('smallTitle', 'Trang chủ'); ?>
<?php $__env->startSection('content'); ?>

    <div class="col-lg-8" style="padding-bottom:120px">
        <div id="log"></div>
        <div id="result"></div>

        <form method="POST" id="dqhStoryFormLeech">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <label>Chọn Trang</label>
                <select id="type" class="form-control">
                    <option value="santruyen.com">SanTruyen.com</option>
                    <option value="thichtruyen.vn">ThichTruyen.vn</option>
                </select>
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" id="url"  class="form-control">
            </div>
            <div class="form-group">
                <label>Chuyên mục</label>
                <select name="intCategory[]" data-placeholder="Chọn chuyên mục" id="selectCategory" class="form-control chosen-select" multiple>
                    <option value=""></option>
                    <?php echo e(category_parent($categories)); ?>

                </select>

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
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <select name="intAuthor[]" data-placeholder="Chọn chuyên mục" class="form-control chosen-select" id="selectAuthor" multiple>
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
            <button type="submit" class="btn btn-default">Chạy</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
            <form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js_admin'); ?>
    <script>
        $('.progress').hide();
        $("#dqhStoryFormLeech").on('submit', function(e){
            e.preventDefault();
            typeWeb = $("#type").val();
            url     = $("#url").val();
            categories = $("#selectCategory").val();
            authors = $("#selectAuthor").val();

            $.ajax({
                url: '/dashboard/api/leech/story',
                type: 'GET',
                dataType: 'json',
                data: {'type': typeWeb, 'url': url, 'categoriesID': categories, 'authorID': authors},
                success: function(data){
                    $("#log").text("<br>Đã nhận được thông tin truyện ...<br>");
                    $("#log").append("Đang lấy thông tin ...<br>");
                    $("#log").append("Đã lưu...Lấy chương truyện<br>");

                    $.each(data.chapters,function(k, v){
                        $.ajax({
                                    url: '/dashboard/api/leech/chapter',
                                    type: 'GET',
                                    dataType: 'json',
                                    data: {'type': typeWeb, 'url': v, 'story_id': data.story_id},
                                    success: function(data){
                                        $("#log").append("Chapter -> " + data.title + " -> " + data.status +  "<br>");
                                    },
                                })
                                .fail(function(){
                                    $('.progress').hide();
                                    $("#log").append('Có lỗi xuất hiện!<br>');
                                });
                    });
                    $("#log").append("== DONE == <br/>");
                },
            })
            .fail(function(){
                $('.progress').hide();
                $("#log").append('Có lỗi xuất hiện!<br>');
            });
            return false;
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>