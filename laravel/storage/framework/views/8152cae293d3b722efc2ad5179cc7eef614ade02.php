<div class="container" id="truyen-slide">
    <div class="list list-thumbnail col-xs-12">
        <div class="title-list"><h2><a href="<?php echo e(route('danhsach.truyenfull')); ?>" title="Truyện full">Truyện đã hoàn thành</a></h2><a href="http://truyenfull.vn/danh-sach/truyen-full/" title="Truyện full"><span class="glyphicon glyphicon-menu-right"></span></a></div>
        <div class="row">
            <?php if($stories): ?>
                <?php foreach($stories as $story): ?>
                    <?php
                    $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first();
                    ?>
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="<?php echo e(route('story.show', $story->alias)); ?>" title="<?php echo e($story->name); ?>">
                            <img src="<?php echo e(url($story->image)); ?>" alt="<?php echo e($story->name); ?>">
                            <div class="caption">
                                <h3><?php echo e($story->name); ?></h3>
                                <small class="btn-xs label-primary">Hoàn thành - <?php echo e($story->chapters()->count()); ?> chương</small>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bài viết nào ở đây !</p>
            <?php endif; ?>
        </div>

    </div>
</div>