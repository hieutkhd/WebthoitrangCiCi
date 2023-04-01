<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/layouts/inc_css.php'; ?>
        <!-- <link rel="stylesheet" href="/public/admin/css/bootstrap-tagsinput.css"> -->
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            
            <?php require_once __DIR__ .'/layouts/inc_header.php'; ?>
            <!-- ======================HEADER========================= -->
            <?php require_once __DIR__ .'/layouts/inc_sidebar.php'; ?>
            <!-- =======================SIDEBAR======================== -->
            <!-- ======================= CONTENT======================== -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Danh sách danh mục
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">News (modules)</a></li>
                        <li class="active">Categorys</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <a href="/public/admin/news/categorys/add" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                            <a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Xoá vĩnh viễn  </a>
                            <a href="/public/admin/news/categorys/list-trash" class="btn btn-success btn-xs"><i class="fa fa-list"></i> List Trash ( 0)</a>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Hot</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Học jquery</td>
                                            <td><a href="/public/admin/news/categorys/4/hot" class="custome-btn label label-info"><span>Hot</span></a></td>
                                            <td><a href="/public/admin/news/categorys/4/active" class="custome-btn label label-info"><span>Active</span></a></td>
                                            <td>
                                                <a href="/public/admin/news/categorys/4/edit" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                <a href="/public/admin/news/categorys/4/delete" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Lập trình web</td>
                                            <td><a href="/public/admin/news/categorys/3/hot" class="custome-btn label label-info"><span>Hot</span></a></td>
                                            <td><a href="/public/admin/news/categorys/3/active" class="custome-btn label label-info"><span>Active</span></a></td>
                                            <td>
                                                <a href="/public/admin/news/categorys/3/edit" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                <a href="/public/admin/news/categorys/3/delete" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>lap trinh laravel</td>
                                            <td><a href="/public/admin/news/categorys/1/hot" class="custome-btn label label-default"><span>None</span></a></td>
                                            <td><a href="/public/admin/news/categorys/1/active" class="custome-btn label label-info"><span>Active</span></a></td>
                                            <td>
                                                <a href="/public/admin/news/categorys/1/edit" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                <a href="/public/admin/news/categorys/1/delete" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="custome-paginate">
                                <div class="pull-left">
                                    <p>Trang 1 - Số bản ghi hiển thị 20 - Tổng số trang 1 - Tổng số bản ghi 3</p>
                                </div>
                                <div class="pull-right"></div>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/layouts/inc_js.php'; ?>
        <!-- <script src="/public/admin/js/bootstrap-tagsinput.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> -->