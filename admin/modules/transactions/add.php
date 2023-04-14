<?php
    $modules = '';
    $title_global = '';
    require_once __DIR__ .'/../../autoload.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
        <!-- <link rel="stylesheet" href="/public/admin/css/bootstrap-tagsinput.css"> -->
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            
            <?php require_once __DIR__ .'/../../layouts/inc_header.php'; ?>
            <!-- ======================HEADER========================= -->
            <?php require_once __DIR__ .'/../../layouts/inc_sidebar.php'; ?>
            <!-- =======================SIDEBAR======================== -->
            <!-- ======================= CONTENT======================== -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        <?= isset($title_global) ? $title_global : '' ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"></a></li>
                        <li class="active">Thêm mới</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-8 col-sm-offset-2">
                                <!-- Horizontal Form -->
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Parent </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="parent_id">
                                                        <option value="0"> - ROOT - </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="VD laravel" autocomplete="off" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label"> Hot </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="hot" id="optionsRadios1" value="1">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="hot" id="optionsRadios2" value="0" checked="">
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                                <label for="" class="col-sm-2 control-label"> Active </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="active" id="optionsRadios2" value="1">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="active" id="optionsRadios1" value="0" checked="">
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label"> Sort </label>
                                                <div class="col-sm-3">
                                                    <input type="number" name="sort" class="form-control" value="">
                                                </div>
                                                <label for="" class="col-sm-2 control-label">Icon</label>
                                                <div class="col-sm-5">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="icon">
                                                        <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="logo" class="col-md-2 control-label"> Logo  </label>
                                                <div class="col-sm-10">
                                                    <input data-url="/upload" name="logo" type="file" value="" id="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> keywords  </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="keywords" id="name" value="" autocomplete="off" placeholder=" Laravel , php , javascript ">
                                                </div>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Description  </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="description" id="name" value="" autocomplete="off" placeholder=" Laravel , php , javascript ">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary btn-xs">Cập nhật  </button>
                                            <a href="/index.php" class="btn btn-danger btn-xs"> Huỷ bỏ </a>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
