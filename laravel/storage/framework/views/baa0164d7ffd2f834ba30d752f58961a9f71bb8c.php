<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng Quản Trị</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(url('admin/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Chosen Bootstrap CSS -->
    <link href="<?php echo e(url('admin/dist/css/bootstrap-chosen.css')); ?>" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables CSS -->
    <link href="<?php echo e(url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('admin/dist/css/AdminLTE.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(url('admin/dist/css/skins/_all-skins.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(url('admin/plugins/iCheck/flat/blue.css')); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo e(url('admin/plugins/datepicker/datepicker3.css')); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo e(url('admin/plugins/daterangepicker/daterangepicker-bs3.css')); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo e(url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

        <header class="main-header">
          <!-- Logo -->
          <a href="<?php echo e(route('dashboard.index')); ?>" class="logo">
            Bảng Quản Trị
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <?php if( Auth::user()->isAdmin()): ?>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger"><?php echo \App\Report::getCount(); ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Bạn có <?php echo \App\Report::getCount(); ?> báo cáo</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php $reports = \App\Report::getListReportNotSolved(); ?>
                        <?php foreach ($reports as $report) { ?>

                        <li><!-- start message -->
                          <a href="<?php echo e(URL::route('dashboard.report.index')); ?>#<?php echo $report->id; ?>">
                            <h4>
                              <?php echo $report->chapter->name ?>
                            </h4>
                            <p><?php echo $report->message ?></p>
                          </a>
                        </li>
                        <!-- end message -->

                        <?php } ?>
                      </ul>
                    </li>
                    <li class="footer">
                      <a href="<?php echo e(URL::route('dashboard.report.index')); ?>">Xem toàn bộ báo cáo</a>
                    </li>
                  </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <?php endif; ?>
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="http://www.gravatar.com/avatar/<?php echo md5( Auth::user()->email ); ?>?s=160" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo Auth::user()->name; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="http://www.gravatar.com/avatar/<?php echo md5( Auth::user()->email ); ?>?s=160" class="img-circle" alt="User Image">

                      <p>
                        <?php echo Auth::user()->name; ?>

                        <small>Hôm nay là <?php echo date('d/m/Y H:i'); ?></small>
                      </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="<?php echo e(route('dashboard.changepassword')); ?>" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                      </div>
                      <div class="pull-right">
                        <a href="<?php echo e(url('logout')); ?>" class="btn btn-default btn-flat">Thoát</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
              <li class="header">DANH MỤC CHÍNH</li>
              <li class="treeview">
                <a href="<?php echo e(url('/')); ?>">
                  <i class="fa fa-home"></i> <span>Trang chủ</span>
                </a>
              </li>
              <?php if( Auth::user()->isAdmin()): ?>
              <li class="treeview">
                <a href="<?php echo e(URL::route('dashboard.report.index')); ?>">
                  <i class="fa fa-flag-o"></i>
                  <span>Báo lỗi bài viết</span>
                  <small class="label pull-right bg-red"><?php echo \App\Report::getCount(); ?></small>
                </a>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder-o"></i>
                  <span>Chuyên mục</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                      <a href="<?php echo e(URL::route('dashboard.category.index')); ?>"><i class="fa fa-circle-o"></i> Danh sách chuyên mục</a>
                  </li>
                  <li>
                      <a href="<?php echo e(URL::route('dashboard.category.create')); ?>"> <i class="fa fa-circle-o"></i>Thêm chuyên mục</a>
                  </li>
                </ul>
              </li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user"></i>
                  <span>Tác giả</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                      <a href="<?php echo e(URL::route('dashboard.author.index')); ?>"><i class="fa fa-circle-o"></i> Danh sách tác giả</a>
                  </li>
                  <li>
                      <a href="<?php echo e(URL::route('dashboard.author.create')); ?>"> <i class="fa fa-circle-o"></i>Thêm tác giả</a>
                  </li>
                </ul>
              </li>
              <?php endif; ?>
              <?php if( Auth::user()->isComposer()): ?>
              <li class="treeview">
                  <a href="#"><i class="fa fa-book fa-fw"></i> Truyện <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                      <li>
                          <a href="<?php echo e(URL::route('dashboard.story.index')); ?>"><i class="fa fa-circle-o"></i> Danh sách truyện</a>
                      </li>
                      <li>
                          <a href="<?php echo e(URL::route('dashboard.chapter.index')); ?>"><i class="fa fa-circle-o"></i> Danh sách chương</a>
                      </li>
                      <li>
                          <a href="<?php echo e(URL::route('dashboard.story.create')); ?>"><i class="fa fa-circle-o"></i> Thêm truyện</a>
                      </li>
                  </ul>
              </li>
              <?php endif; ?>
              <?php if( Auth::user()->isAdmin()): ?>
              <li class="treeview">
                  <a href="#"><i class="fa fa-lock fa-fw"></i> Quản trị <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                      <li>
                          <a href="<?php echo e(URL::route('dashboard.user.index')); ?>"><i class="fa fa-circle-o"></i> Danh sách quản trị</a>
                      </li>
                      <li>
                          <a href="<?php echo e(URL::route('dashboard.user.create')); ?>"><i class="fa fa-circle-o"></i> Thêm quản trị</a>
                      </li>
                  </ul>
              </li>
              <li class="treeview">
                  <a href="<?php echo e(route('dashboard.setting.index')); ?>"><i class="fa fa-cog"></i> Cài đặt hệ thống</a>
              </li>
              <li class="treeview">
                  <a href="<?php echo e(route('dashboard.setting.ads')); ?>"><i class="fa fa-money"></i> Quản lý quảng cáo</a>
              </li>
              <li class="treeview">
                  <a href="<?php echo e(route('dashboard.setting.tos')); ?>"><i class="fa fa-pencil"></i> Chỉnh sửa điều khoản</a>
              </li>
              <li class="treeview">
                  <a href="<?php echo e(url('dashboard/leech')); ?>"><i class="fa fa-pencil"></i> Leech Tool</a>
              </li>
              <?php endif; ?>
            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <?php echo $__env->yieldContent('title'); ?>
              <small><?php echo $__env->yieldContent('smallTitle'); ?></small>
            </h1>
          </section>

          <!-- Main content -->
          <section class="content">
            <?php if(Session::has('flash_message')): ?>
            <div class="row">
              <div class="col-lg-12" id="flash">
                  <div class="alert alert-<?php echo e(Session::get('flash_level')); ?>" role="alert">
                      <?php echo e(Session::get('flash_message')); ?>

                  </div>
              </div>
            </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Phiên bản:</b> 2.0.3
          </div>
          <strong>Copyright &copy; 2015-<?php echo date('Y'); ?> <a href="https://www.dinhquochan.com">Đinh Quốc Hân</a>.</strong> All rights
          reserved.
        </footer>
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo e(url('admin/plugins/jQuery/jQuery-2.2.0.min.js')); ?>"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(url('admin/bootstrap/js/bootstrap.min.js')); ?>"></script>

    <!-- Chosen -->
    <script src="<?php echo e(url('admin/js/chosen.jquery.js')); ?>"></script>

    <!-- Tinymce -->
    <script src="<?php echo e(url('assets/js/tinymce/tinymce.min.js')); ?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo e(url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')); ?>"></script>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo e(url('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo e(url('admin/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo e(url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo e(url('admin/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(url('admin/plugins/fastclick/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(url('admin/dist/js/app.min.js')); ?>"></script>

    <script src="<?php echo e(url('admin/dist/js/dinhquochan.js')); ?>"></script>
    <?php echo $__env->yieldContent('js_admin'); ?>
</body>

</html>
