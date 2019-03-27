<!-- navibar -->
<div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Hiện menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="header-logo" href="/" title="doc truyen">doc truyen</a></h1>
        </div>
        <div class="navbar-collapse collapse" itemscope="" itemtype="http://schema.org/WebSite">
            <meta itemprop="url" content="<?php echo e(url('/')); ?>">
            <ul class="control nav navbar-nav ">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> Danh sách <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(route('danhsach.truyenmoi')); ?>" title="Truyện mới cập nhật">Truyện mới cập nhật</a></li>
                        <li><a href="<?php echo e(route('danhsach.truyenhot')); ?>" title="Truyện Hot">Truyện Hot</a></li>
                        <li><a href="<?php echo e(route('danhsach.truyenfull')); ?>" title="Truyện Full">Truyện Full</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-list"></span> Thể loại <span class="caret"></span></a>
                    <div class="dropdown-menu multi-column">
                        <div class="row">

                <?php
                $categories = \App\Category::select('id', 'name', 'alias', 'parent_id')->orderBy('id', 'DESC')->get();
                $t = 1; $c = 1;
                foreach($categories as $category)
                {
                    $count = count($categories);
                    if($t == 1)
                        echo '<div class="col-md-4"><ul class="dropdown-menu">';
                        echo '<li><a href="'. route('category.list.index', ['alias' => $category->alias]) .'">'. $category->name .'</a></li>';
                    if($t == 10 || $count == $c){
                        $t = 0;
                        echo '</ul></div>';
                    }
                    $t++; $c++;
                }
                ?>
                    </div>
                </div>
                </li>

     <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Tài khoản <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
  <li>
                    <?php if(Auth::user()): ?>
                        <a href="<?php echo e(route("dashboard.index")); ?>"><span class="glyphicon glyphicon-cog"></span>  Bảng Quản Trị</a>
                    <?php else: ?>
                        <a href="<?php echo e(url("/login")); ?>"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
                        <a href="<?php echo e(url("/register")); ?>"><span class="glyphicon glyphicon-cog"></span> Đăng ký</a>
                    <?php endif; ?>
                </li>
                    </ul>
                </li>


</ul>
<form class="navbar-form navbar-right" action="<?php echo e(route('danhsach.search')); ?>" role="search" itemprop="potentialAction" itemscope="" itemtype="http://schema.org/SearchAction">
    <div class="input-group search-holder">
        <meta itemprop="target" content="#?tukhoa={tukhoa}">
        <input class="form-control" id="search-input" type="search" name="q" placeholder="Tìm kiếm..." value="<?php echo e(old('q')); ?>" itemprop="query-input" required="">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    </div>
    <div class="list-group list-search-res hide"></div>
</form>

</div>
<!--/.nav-collapse -->
</div>
<div class="navbar-breadcrumb">
    <div class="container breadcrumb-container">
        <?php echo $__env->yieldContent('breadcrumb'); ?>

        <?php echo $__env->make('partials.social', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div>
</div><!-- navibar -->
