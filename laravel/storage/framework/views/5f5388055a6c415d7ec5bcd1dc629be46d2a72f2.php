<?php if($stories): ?>
    <?php $count = 1; ?>
    <?php foreach($stories as $story): ?>
        <div class="item top-<?php echo e($count); ?>" itemscope="" itemtype="http://schema.org/Book">
            <a href="<?php echo e(route('story.show', $story->alias)); ?>" itemprop="url">
                <span class="full-label"></span>
                <img src="<?php echo e(url($story->image)); ?>" alt="<?php echo e($story->name); ?>" class="img-responsive" itemprop="image">
                <div class="title"><h3 itemprop="name"><?php echo e($story->name); ?></h3></div>
            </a>
        </div>
        <?php $count++; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Không có bài viết nào ở đây !</p>
<?php endif; ?>