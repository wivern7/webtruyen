<?php $__env->startSection('title', 'Điều khoản sử dụng'); ?>
<?php $__env->startSection('breadcrumb', showBreadcrumb([[url('tos'), 'Điều khoản sử dụng']])); ?>
<?php $__env->startSection('content'); ?>
    <div class="container single-page" id="tos">
        <div class="row">
            <div class="list list-truyen col-xs-12">
                <div class="title-list"><h2>Privacy &amp; Terms of use - Điều khoản sử dụng</h2></div>
                <div class="row">
                    <div class="col-xs-12 content">
                        <?php echo \App\Option::getvalue('tos_content'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>