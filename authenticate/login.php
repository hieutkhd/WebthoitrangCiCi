<?php
    session_start();
    @ob_start();
    // goi file Function
    require_once __DIR__ .'/../vendor/init.php';

    // goi file Config
    require_once __DIR__ .'/../config.php';

    // neu login roi ko vao dc trang nay nua
    if (  isset($_SESSION['admin_name']))
    {
        header("Location: ".baseServerName().'/admin');exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        
        $email    = Input::get("email");
        $password = Input::get("password");
        // kiểm tra lỗi
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
        
            $check = DB::fetchOne('users', ' email = "'. $email .'" AND password = "'.md5($password).'" AND (level = 1 OR level = 2) AND status = 1 LIMIT 1');

            if(!empty($check))
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = " Xin chào " .$check['name'] . " đã đăng nhập vào hệ thống thành công ";
                $_SESSION['admin_name'] = $check['name'];
                $_SESSION['admin_level'] = $check['level'];
                $_SESSION['admin_avatar'] = $check['avatar'];
                header("Location: ".baseServerName().'/admin');exit();
            } else {
                // gán session thông báo thất bại
                $_SESSION['error'] = "Thông tin tài khoản hoặc mật khẩu không chính xác";
                header("Location: ".baseServerName().'/authenticate/login.php');exit();
            }
            
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Đăng nhập hệ thống website </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/public/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/admin/css/ionicons.min.css">
    <link rel="stylesheet" href="/public/admin/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/public/admin/css/_all-skins.min.css">
    <link rel="stylesheet" href="/public/admin/css/custome.css">
    <link rel="stylesheet" href="/public/app/css/base.css">

    <!-- Google Font -->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg" style="color: red;">Đăng nhập để bắt đầu phiên làm việc</p>
        <form action="" method="post">
            <input type="hidden" name="_token" value="WkxU2rRfT9DZyMi1u9iOvmSTCdSEgpJ7eaiSDlYq">
            <div class="form-group has-feedback">
                <!--admin@gmail.com || admin12345-->
                <input type="email" class="form-control" name="email" placeholder="" autocomplete="off" value="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                <?php if(isset($errors['email'])) :?>
                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                <?php endif ;?>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" autocomplete="off" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if(isset($errors['password'])) :?>
                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                <?php endif ;?>
            
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
       
        <!-- /.social-auth-links -->
<!--        <a href="" class="pull-left"> Quên mật khẩu </a>-->
<!--        <a href="" class="text-center pull-right"> Đăng ký mới </a>-->
        <div class="clearfix"></div>
    </div>
    <!-- /.login-box-body -->
</div>
<script src="/public/admin/js/jquery.min.js"></script>
<script src="/public/admin/js/bootstrap.min.js"></script>
<script src="/public/app/js/notify.js"></script>
<script src="/public/admin/js/app.js"></script>
<?php
    if( isset($_SESSION['success']))
    {
        $string = $_SESSION['success'];
        unset($_SESSION['success']);
        echo "<script>$.notify('$string','success');</script>";
    }

    if( isset($_SESSION['error']))
    {
        $string = $_SESSION['error'];
        unset($_SESSION['error']);
        echo "<script>$.notify('$string','error');</script>";
    }
?>

