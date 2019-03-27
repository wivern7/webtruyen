<?php $__env->startSection('title', $story->name . ' - ' . $chapter->subname . ' :' . $chapter->name); ?>
<?php $__env->startSection('breadcrumb', showBreadcrumb($breadcrumb)); ?>
<?php $__env->startSection('content'); ?>
    <div class="container chapter" id="chapterBody" style="margin-top: 0px;">
        <div class="row">
            <div class="col-xs-12">
                <button type="button" class="btn btn-responsive btn-success toggle-nav-open">
                    <span class="glyphicon glyphicon-menu-up"></span>
                </button>

                <a class="truyen-title" href="<?php echo e(route('story.show', $story->alias)); ?>" title="<?php echo e($story->name); ?>"><?php echo e($story->name); ?></a>
                <h2>
                    <a class="chapter-title" href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" title="<?php echo e($story->name); ?> - <?php echo e($chapter->subname); ?>: <?php echo e($chapter->name); ?>">
                        <span class="chapter-text"><?php echo e($chapter->subname); ?></span>: <?php echo e($chapter->name); ?>

                    </a>
                </h2>
                <hr class="chapter-start">
                <?php echo $__env->make('partials.chapter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <hr class="chapter-end">

                <div class="chapter-content">
                    <?php echo ($chapter->content); ?>

                </div>

                <div class="ads container">
                    <?php echo \App\Option::getvalue('ads_chapter'); ?>

                </div>

                <hr class="chapter-end">
                <div class="chapter-nav" id="chapter-nav-bot">
                    <?php echo $__env->make('partials.chapter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" id="chapter_error" chapter-id="<?php echo e($chapter->id); ?>"><span class="glyphicon glyphicon-exclamation-sign"></span> Báo lỗi chương</button>
                        <button type="button" class="btn btn-info" id="chapter_comment"><span class="glyphicon glyphicon-comment"></span> Bình luận</button>
                    </div>
                    <div class="bg-info text-center visible-md visible-lg box-notice">Bình luận văn minh lịch sự là động lực cho tác giả. Nếu gặp chương bị lỗi hãy "Báo lỗi chương" để BQT xử lý!</div>
                    <div class="col-xs-12">
                        <div class="row" id="fb-comment-chapter">
                            <div class="fb-comments fb_iframe_widget" data-href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" data-width="832" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>