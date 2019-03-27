<?php
if($story)
    $author = $story->authors()->first();
if($author)
    $stories = $author->stories()->where('stories.id', '<>', $story->id)->skip(0)->take(5)->get();
?>
<?php if($stories->count() > 0): ?>
<div class="list list-truyen col-xs-12">
    <div class="title-list"><h4>Truyện cùng tác giả</h4></div>
    <?php foreach($stories as $story): ?>
    <div class="row" itemscope="" itemtype="http://schema.org/Book">
        <div class="col-xs-12">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <h3 itemprop="name"><a href="<?php echo e(route('story.show', $story->alias)); ?>" title="<?php echo e($story->name); ?>" itemprop="url"><?php echo e($story->name); ?></a></h3>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>