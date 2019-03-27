<?php $__env->startSection('title', $story->name); ?>
<?php $__env->startSection('seo'); ?>
    <meta name="robots" content="noindex">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb', showBreadcrumb($breadcrumb)); ?>
<?php $__env->startSection('content'); ?>
    <div class="container" id="truyen">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="col-xs-12 col-info-desc" itemscope="" itemtype="http://schema.org/Book">
                <div class="title-list"><h2>Thông tin truyện</h2></div>
                <div class="col-xs-12 col-sm-4 col-md-4 info-holder">
                    <div class="books">
                        <div class="book">
                            <img src="<?php echo e(url($story->image)); ?>" alt="<?php echo e($story->name); ?>" itemprop="image">
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <h3>Tác giả:</h3>
                            <?php echo the_author($story->authors); ?>

                        </div>
                        <div>
                            <h3>Thể loại:</h3>
                            <?php echo the_category($story->categories); ?>

                        </div>
                        <div>
                            <h3>Lượt xem:</h3>
                            <?php echo number_format($story->view); ?>

                        </div>
                        <div>
                            <h3>Trạng thái:</h3> <?php echo dqhStatusStoryShow($story->status); ?>

                        </div>
                        <?php if($story->source): ?>
                        <div>
                            <h3>Nguồn Truyện:</h3> <?php echo $story->source; ?>

                        </div>
                        <?php endif; ?>
                        <div>
                   <div class="navbar-social pull-left">
  <div class="g-plusone" data-href="<?php echo e(route('story.show', $story->alias)); ?>" data-annotation="bubble" data-height="20" data-rel="publisher"></div>
                            <div class="navbar-social pull-left">
                     <div class="fb-like" data-href="<?php echo e(route('story.show', $story->alias)); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 desc">
                    <h3 class="title" itemprop="name"><?php echo e($story->name); ?></h3>
                    <div class="desc-text desc-text-full" itemprop="about">
                        <?php echo nl2p($story->content, false); ?>

                    </div>
                    <div class="showmore">
            					<a class="btn btn-default btn-xs" href="javascript:void(0)" title="Xem thêm">Xem thêm »</a>
            				</div>

                    <?php
                    $chapters = $story->chapters()->orderBy("created_at", "desc")->take(5)->get();
                    if ($chapters) {
                      echo '<div class="l-chapter"><div class="l-title"><h3>Các chương mới nhất</h3></div><ul class="l-chapters">';
                      foreach($chapters as $chapter):
                      ?>
                      <li>
                        <span class="glyphicon glyphicon-certificate"></span>
                        <a href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" title="<?php echo e($story->name); ?> - <?php echo e($chapter->subname); ?>: <?php echo e($chapter->name); ?>">
                            <span class="chapter-text"><?php echo e($chapter->subname); ?></span>: <?php echo e($chapter->name); ?>

                        </a>
                      <?php
                          endforeach;

                          echo '</ul></div>';
                    }
                    ?>
                </div>
            </div>

            <div class="ads container">
                <?php echo \App\Option::getvalue('ads_story'); ?>

            </div>

            <div class="col-xs-12" id="list-chapter">
                <div class="title-list"><h2>Danh sách chương</h2></div>
                <div class="row">
                    <?php
                    $t = 1; $c = 1;
                    $chapters = $story->chapters()->paginate(50);
                    foreach($chapters as $chapter):
                        $count = count($chapters);
                        if($t == 1) echo ' <div class="col-xs-12 col-sm-6 col-md-6"><ul class="list-chapter">';
                    ?>
                            <li>
                                <span class="glyphicon glyphicon-certificate"></span>
                                <a href="<?php echo e(route('chapter.show', [$story->alias, $chapter->alias])); ?>" title="<?php echo e($story->name); ?> - <?php echo e($chapter->subname); ?>: <?php echo e($chapter->name); ?>">
                                    <span class="chapter-text"><?php echo e($chapter->subname); ?></span>: <?php echo e($chapter->name); ?>

                                </a>
                            </li>
                    <?php
                        if($t == 25 || $count == $c){
                            $t = 0;
                            echo '</ul></div>';
                        }
                            $t++; $c++;
                        endforeach;
                        ?>
                </div>

                <?php echo e($chapters->fragment('list-chapter')->links()); ?>


                </div>
            <div class="visible-md visible-lg">
                <div class="col-xs-12 comment-box">
                    <div class="title-list"><h2>Bình luận truyện</h2></div>
                    <div class="fb-comments fb_iframe_widget" data-href="<?php echo e(route('story.show', $story->alias)); ?>" data-width="832" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered"></div>
                </div>
            </div>
        </div>
        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            <?php echo $__env->make('widgets.storiesByAuthor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('widgets.hotstory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>