<?php
require_once __DIR__ . '/../autoload.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $current_password     = Input::get("current_password");
    $new_password         = Input::get("new_password");
    $r_new_password       = Input::get("r_new_password");
    $errors = [];
    $id = $_SESSION['id'];
    // lấy thông tin user
    $user = DB::fetchOne('users', ' id = '. $id);
    // kiểm tra mật khẩu cũ có trùng hay không
    if (md5($current_password) != $user['password']) {
        $errors['current_password'] = "Mật khẩu cũ không trùng khớp";
    }
    // kiểm tra yêu cầu nhập vào mật khẩu mới
    if ($new_password == '') {
        $errors['new_password'] = "Nhập vào mật khẩu mới";
    }
    // kiểm tra nhập lại mật khẩu
    if ($r_new_password == '') {
        $errors['r_new_password'] = "Nhập lại mật khẩu mới";
    }

    // kiểm tra mật khẩu có trùng nhau
    if ($new_password != $r_new_password) {
        $errors['r_new_password'] = "Mật khẩu không trùng khớp";
    }

    if(empty($errors)) {
        $data = [
            'password' => md5($r_new_password),
        ];

        //tiến hành update thông tin user
        $id_update = DB::update('users', $data, ' id = '. $id);

        if($id_update > 0) {
            // gán session thông báo thành công
            //chuyển về trang index trong thư mục đổi mật khẩu
            $_SESSION['success'] = "Đổi mật khẩu thành công";
            header("Location: ".baseServerName().'/account/doi-mat-khau.php');exit();
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi không thể đổi mật khẩu";
            header("Location: ".baseServerName().'/account/doi-mat-khau.php');exit();
        }
    }

}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Đổi thông tin mật khẩu</title>
        <meta charset="utf-8">
        <?php require_once __DIR__ . '/../layouts/inc_head.php'; ?>
        <style type="text/css">
        </style>
    </head>
<body>
<div id="wrapper">
    <!---->
    <!--HEADER-->
<?php require_once __DIR__ . '/../layouts/inc_header.php'; ?>
    <!--END HEADER-->

    <!--MENUNAV-->
<?php require_once __DIR__ . '/../layouts/inc_menu.php';?>
    <!--ENDMENUNAV-->

    <div id="maincontent">
    <div class="container">
        <div class="col-md-3  fixside" >
            <?php require_once __DIR__ . '/../layouts/inc_left_user.php';?>
        </div>
        <div class="col-md-9 bor">
            <!-- SLIDE -->
            <section style="padding: 20px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">Đổi mật khẩu </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">


                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Mật khẩu cũ <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" value="" name="current_password">
                                    <?php if(isset($errors['current_password'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['current_password'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Mật khẩu mới <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" value="" name="new_password">
                                    <?php if(isset($errors['new_password'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['new_password'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Nhập lại mk  <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" value="" name="r_new_password">
                                    <?php if(isset($errors['r_new_password'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['r_new_password'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-xs"> Đổi mật khẩu </button>
                                    <a href="/pages" class="btn btn-danger btn-xs"> Huỷ bỏ  </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="container">
        <div class="col-md-4 bottom-content">
            <a href=""><img src="/public/frontend/images/free-shipping.png"></a>
        </div>
        <div class="col-md-4 bottom-content">
            <a href=""><img src="/public/frontend/images/guaranteed.png"></a>
        </div>
        <div class="col-md-4 bottom-content">
            <a href=""><img src="/public/frontend/images/deal.png"></a>
        </div>
    </div>
<?php require_once __DIR__ . '/../layouts/inc_footer.php'; ?>