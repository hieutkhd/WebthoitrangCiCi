<?php
    $modules = 'posts';
    $title_global = 'Quản lý bài viết';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT * FROM posts WHERE 1 ORDER BY id DESC";
    $posts = Pagination::pagination('posts', $sql, 'page', 10);
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
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Bài viết </a></li>
                        <li class="active"> Danh sách</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <a href="add.php" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>STT</th>
                                            <th style="width: 30%">Name</th>
                                            <th style="width: 30%">Descriptions</th>
                                            <th>Thunbar</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($posts as $k => $post) :?>
                                        <tr>
                                            <td><?= $k + 1 ?></td>
                                            <td><?= $post['p_title'] ?></td>
                                            <td><?= $post['p_descriptions'] ?></td>
                                            <th>
                                                <?php if(isset($post['p_thunbar']) && !empty($post['p_thunbar'])) : ?>
                                                <img onerror="this.src ='/public/uploads/posts/<?= isset($post['p_thunbar']) ? $post['p_thunbar'] : 'default-image.jpg' ?>'" src="" style="width: 60px;height: 60px">
                                                <?php endif; ?>
                                            </th>
                                            <td>
                                                <a href="update.php?id=<?=  $post['id']?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                <a href="delete.php?id=<?= $post['id']?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="custome-paginate">
                                <div class="pull-right">
                                    <?php echo Pagination::getListpage() ?>
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
