<?php
require_once __DIR__. '/../autoload.php';
    $sql = "SELECT posts.*, name as name_user FROM posts INNER JOIN users ON posts.p_admin_id = users.id WHERE 1 ORDER BY id DESC ";
    $posts = Pagination::pagination('posts',$sql,'page',8);
    $filter = [];
    $sql = "SELECT posts.*, name as name_user FROM posts INNER JOIN users ON posts.p_admin_id = users.id  WHERE 1 ORDER BY id DESC LIMIT 5";
    $postsNew = DB::fetchsql($sql);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title> Danh sách chi tiết </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style>
            .box-menu .active a{ color:red !important }
        </style>
    </head>
<body>
<div id="wrapper">
    <!---->
    <!--HEADER-->
<?php require_once __DIR__.'/../layouts/inc_header.php'; ?>
    <!--END HEADER-->


    <!--MENUNAV-->
<?php require_once __DIR__.'/../layouts/inc_menu.php' ;?>
    <!--ENDMENUNAV-->

    <div id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="list-post">
                    <div class="row">
                        <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin: 19px;"> Danh sách bài viết </h2>
                        <?php foreach($posts as $post) :?>
                            <div class="col-sm-6" style="margin-bottom: 30px;">
                                <div class="item-post" style="border: 1px solid #f2f2f2">
                                    <div class="col-sm-5">
                                        <a href="chi-tiet.php?id=<?= $post['id'] ?>&&slug=<?= $post['p_slug'] ?>">
                                            <img src="/public/uploads/posts/<?= $post['p_thunbar'] ?>" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                                        </a>
                                    </div>
                                    <div class="col-sm-7">
                                        <h2 style="font-size: 20px;">
                                            <a href="chi-tiet.php?id=<?= $post['id'] ?>&&slug=<?= $post['p_slug'] ?>" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;"><?= $post['p_title'] ?></a>
                                        </h2>
                                        <p style="font-size: 14px;"><?= mb_substr($post['p_descriptions'],0,100) ?>...</p>
                                        <p><i class="fa fa-user"></i> <?= $post['name_user'] ?> | <i class="fa fa-times-o"></i> <?=  date("d-m-Y", strtotime($post['created_at'])); ?> </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <?= Pagination::getListpage($filter) ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin: 19px;"> Các bài viết mới nhất</h2>
                    <?php foreach($postsNew as $key => $postN) :?>
                        <div class="col-sm-5">
                            <a href="chi-tiet.php?id=<?= $postN['id'] ?>&&slug=<?= $postN['p_slug'] ?>">
                                <img src="/public/uploads/posts/<?= $postN['p_thunbar'] ?>" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <h2 style="font-size: 20px;">
                                <a href="chi-tiet.php?id=<?= $postN['id'] ?>&&slug=<?= $postN['p_slug'] ?>" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;"><?= $postN['p_title'] ?></a>
                            </h2>
                            <p style="font-size: 14px;"><?= mb_substr($postN['p_descriptions'],0,100) ?>...</p>
                            <p><i class="fa fa-user"></i> <?= $postN['name_user'] ?> | <i class="fa fa-times-o"></i> <?=  date("d-m-Y", strtotime($postN['created_at'])); ?> </p>
                        </div>
                        <div class="clearfix"></div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>