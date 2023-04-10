<?php
    $modules = 'user-contact';
    $title_global = 'Trả lời liên hệ';
    require_once __DIR__ .'/../../autoload.php';

    // lấy giá trị id
    $id = Input::get('id');
    // lấy dữ liệu danh mục trong database
    $contact = DB::fetchOne('user_contact', intval($id));

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // lấy giá trị input
        $title   = Input::get("title");
        $content    = Input::get("content");
        $errors = [];

        // kiểm tra tiêu đề gửi mail
        if ($title == '') {
            $errors['title'] = "Nhập tiêu đề gửi mail";
        }
        // kiểm tra nội dung gửi mail
        if ($content == '') {
            $errors['content'] = "Nhập nội dung trả lời liên hệ";
        }
        // trả lời liên hệ
        if (empty($errors)) {
            
            SendMail::send($title, $content, $contact['name'], $contact['email']);
            $_SESSION['success'] = "Trả lời liên hệ thành công ";
            header("Location: ".baseServerName().'/admin/modules/contact');exit();
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi không thể trả lời liên hệ";
            header("Location: ".baseServerName().'/admin/modules/contact');exit();
        }

    }
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
                <?= isset($title_global) ? $title_global : '' ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Trả lời liên hệ</a></li>
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
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề <span class="color-red">(*)</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" id="inputEmail3" placeholder="Tiêu đề gửi mail" autocomplete="off" value="">
                                            <?php if(isset($errors['title'])) :?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['title'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nội dung <span class="color-red">(*)</span></label>
                                        <div class="col-sm-10">
                                            <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea>
                                            <?php if(isset($errors['content'])) :?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['content'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-xs">Trả lời</button>
                                    <a href="index.php" class="btn btn-danger btn-xs"> Huỷ bỏ </a>
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