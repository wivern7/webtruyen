<?php $__env->startSection('title', $data['title']); ?>

<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e($data['description']); ?>">
    <meta name="keywords" content="<?php echo e($data['keyword']); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb', showBreadcrumb($breadcrumb)); ?>
<?php $__env->startSection('content'); ?>
    <div class="container" id="list-page">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="list list-truyen col-xs-12">
                <div class="title-list">
                    <h2><?php echo e($data['title']); ?></h2>

                    <?php if($data['alias'] != route('danhsach.truyenfull')): ?>
                        <div class="filter"><a href="?filter=full">Chỉ hiện truyện đã hoàn (full)</a></div>
                    <?php endif; ?>

                </div>

                <?php foreach( $data['stories'] as $story): ?>
                    <div class="row" itemscope="" itemtype="http://schema.org/Book">
                        <div class="col-xs-3">
                            <div>
                                <img class="visible-xs-block" src="<?php echo e(url(dqhImageThumb($story->image, false))); ?>" alt="<?php echo e($story->name); ?>"><img class="visible-sm-block visible-md-block visible-lg-block" src="<?php echo e(url(dqhImageThumb($story->image, true))); ?>" alt="<?php echo e($story->name); ?>">
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name">
                                    <a href="<?php echo e(route('story.show', $story->alias)); ?>" title="<?php echo e($story->name); ?>" itemprop="url"><?php echo e($story->name); ?></a>
                                </h3>
                                <?php if($story->status == 1): ?>
                                    <span class="label-title label-full"></span>
                                <?php endif; ?>
                                <?php /*<span class="label-title label-hot"></span>*/ ?>
                                <?php foreach($story->authors as $author): ?>
                                    <span class="author" itemprop="author">
                                        <span class="glyphicon glyphicon-pencil"></span> <?php echo e($author->name); ?>

                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first(); ?>
                        <?php if($chapter): ?>
                        <div class="col-xs-2 text-info">
                            <div>
                                <a href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" title="<?php echo e($chapter->name); ?>"><span class="chapter-text"><?php echo e($chapter->subname); ?></span></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                    <?php echo e($data['stories']->links()); ?>

                </div>
            </div>
        </div>

        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            <?php if(isset($data['description'])): ?>
                <div class="panel cat-desc text-left">
                    <div class="panel-body">
                       <?php echo nl2br($data['description']); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php echo $__env->make('widgets.categories', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('widgets.hotstory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>