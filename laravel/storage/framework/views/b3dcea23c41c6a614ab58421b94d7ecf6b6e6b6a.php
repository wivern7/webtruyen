<div class="chapter-nav" id="chapter-nav-top">
    <input type="hidden" id="ten-truyen" value="<?php echo e($story->alias); ?>">
    <input type="hidden" id="truyen-id" value="<?php echo e($story->id); ?>">
    <input type="hidden" id="chapter-id" value="<?php echo e($chapter->id); ?>">
    <input type="hidden" id="chapter-bnum" value="">
    <input type="hidden" id="chapter-num" value="<?php echo e($story->id); ?>">
    <div class="btn-group">
        <?php if($chapterNav['previousChapter']): ?>
            <a class="btn btn-success" href="<?php echo e(route('chapter.show', [$story->alias, $chapterNav['previousChapter']->alias])); ?>" title="<?php echo e($chapterNav['previousChapter']->subname); ?>" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
        <?php else: ?>
            <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
        <?php endif; ?>
        <button type="button" class="btn btn-success btnGoToChapter"><span class="glyphicon glyphicon-list-alt"></span></button>
        <select name="goToChapter" class="goToChapter btn btn-success form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <?php foreach($story->chapters as $chap): ?>
                <option value="<?php echo e(route('chapter.show',[$story->alias, $chap->alias] )); ?>" <?php echo e($chapter->alias == $chap->alias ? 'selected' : ''); ?>><?php echo e($chap->subname); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if($chapterNav['nextChapter']): ?>
            <a class="btn btn-success" href="<?php echo e(route('chapter.show', [$story->alias, $chapterNav['nextChapter']->alias])); ?>" title="Chương 1" id="next_chap"><span class="hidden-xs">Chương </span>sau <span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php else: ?>
            <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="next_chap"><span class="hidden-xs">Chương </span>sau <span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php endif; ?>
    </div>
</div>