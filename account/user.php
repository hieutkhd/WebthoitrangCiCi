<?php
    require_once __DIR__ . '/../autoload.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $name     = Input::get("name");
    $phone    = Input::get("phone");
    $address  = Input::get("address");

    // kiểm tra lỗi
    if($name == '') {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
    }

    if($phone == '') {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['phone'] = ' Mời bạn điền đầy đủ thông tin';
    }
    if($address == '') {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['address'] = ' Mời bạn điền đầy đủ thông tin';
    }

    if ( isset ($_FILES['prd_thunbar']) && $_FILES['prd_thunbar']['name'] != NULL ) {
        $file_name = $_FILES['prd_thunbar']['name'];
        $file_tmp  = $_FILES['prd_thunbar']['tmp_name'];
        $file_type = $_FILES['prd_thunbar']['type'];
        $file_erro = $_FILES['prd_thunbar']['error'];
        if ($file_erro == 0) {
            $avatar = $file_name;
        }
    }

    if(empty($errors)) {
        // gán vào 1 mảng giá trị update
        $data = [
            'name'     => $name ,
            'address'  => $address,
            'phone'    => $phone,
        ];

        if (isset($avatar)) {
            $data['avatar'] = $avatar;
        }

        $id = $_SESSION['id'];

        //tiến hành update thông tin user
        $id_update = DB::update('users', $data, ' id = '. $id);

        if($id_update > 0) {
            // insert thanh cong
            // gán session thông báo thành công
            //chuyển về trang index trong thư mục users
            $_SESSION['success'] = "Chỉnh sửa thông tin thành công";
            $_SESSION['username'] = $name;
            if (isset($avatar)) {
                move_uploaded_file($file_tmp, UPLOADS.'/users/'. $avatar);
                $_SESSION['avatar'] = $avatar;
            }

            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            header("Location: ".baseServerName().'/account/user.php');exit();
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi không thể cập nhật thông tin tài khoản";
            header("Location: ".baseServerName().'/account/user.php');exit();
        }
    }
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Trang cá nhân</title>
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
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"> Ảnh đại diện   </label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control" name="prd_thunbar" id="imgInp">
                                    <?php if( isset( $errors['avatar']) ): ?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['avatar'] ?></span>
                                    <?php endif ; ?>
                                </div>
                                <div class="col-sm-4" style="margin-top: 10px;margin-left: 17%">
                                    <img src="../public/uploads/users/<?= isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'user-default.jpg' ?>" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 200px;border: 1px solid #dedede">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email <span style="color: red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" placeholder=" user@gmail.com" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Họ và Tên <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" placeholder=" Họ và tên : Nguyễn Văn A" name="name">
                                    <?php if(isset($errors['name'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Số điện thoại <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>" placeholder="" name="phone">
                                    <?php if(isset($errors['phone'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['phone'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email"> Địa chỉ  <span style="color:red">(*)</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>" placeholder="" name="address">
                                    <?php if(isset($errors['address'])) :?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['address'] ?></span>
                                    <?php endif ;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-xs"> Gủi thông tin  </button>
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