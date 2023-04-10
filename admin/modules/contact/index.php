<?php
$modules = 'user-contact';
$title_global = 'Danh sách liên hệ ';
require_once __DIR__ .'/../../autoload.php';
$user_contacts = Pagination::pagination('user_contact','','page',10);
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
                <li class="active"> Danh sách liên hệ</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover border">
                            <tbody>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($user_contacts as $key => $contact): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $contact['name'] ?></td>
                                        <td><?= $contact['email'] ?></td>
                                        <td><?= $contact['content'] ?></td>
                                        <td><?= $contact['created_at'] ?></td>
                                        <td>
                                            <a href="reply.php?id=<?= $contact['id'] ?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Reply </a>
                                            <a href="delete.php?id=<?= $contact['id'] ?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
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
