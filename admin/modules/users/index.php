<?php
    require_once __DIR__ .'/../../autoload.php';
    $modules = 'users';
    $title_global = ' Danh sách  thành viên ';
    $sql = " SELECT * FROM users WHERE 1";
    $users = Pagination::pagination('users','','page',10);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
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
                        <?= $title_global  ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                        <li><a href="#">Thành viên </a></li>
                        <li class="active"> Danh sách thành viên  </li>
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
                                            <th>ID</th>
                                            <th>Họ và tên</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Hình ảnh</th>
                                            <th>Vai trò</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                        <?php foreach($users as $user) :?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['name'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td><?= $user['phone'] ? $user['phone'] : 'Chưa cập nhật' ?></td>
                                                <td>
                                                    <img src="" onerror="this.src ='/public/uploads/users/<?= isset($user['avatar']) ? $user['avatar'] : 'user-default.jpg' ?>'" style="width: 40px;height: 40px;" alt="" />
                                                </td>
                                                <td>
                                                    <?php if ($user['level'] == 0) : ?>
                                                        Người dùng
                                                    <?php elseif ($user['level'] == 1) : ?>
                                                        Nhân viên
                                                    <?php elseif ($user['level'] == 2) : ?>
                                                        Quản trị viên
                                                    <?php endif; ?>
                                                </td>
                                                <td><a href="active.php?id=<?= $user['id'] ?>" class="custome-btn label <?= $user['status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $user['status'] == 1 ? 'Họat động' : 'Khóa' ?></span></a></td>
                                                <td>
                                                    <a href="update.php?id=<?= $user['id'] ?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Chỉnh sửa </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
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

