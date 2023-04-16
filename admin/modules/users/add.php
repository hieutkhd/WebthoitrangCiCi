<?php
    $modules = 'users';
    $title_global = ' Thêm mới thành viên ';
    require_once __DIR__ .'/../../autoload.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("name");
        $email    = Input::get("email");
        $phone    = Input::get("phone");
        $address    = Input::get("address");
        $password = Input::get("password");
        $level      = Input::get("level");
        // kiểm tra lỗi
        if($name == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // kiểm tra lỗi
        if($email == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        } else {
            // check xem email da trung chua
            $emailCheck = DB::fetchOne('users',' email = "'.$email.'"');

            if(count($emailCheck)) {
                // email trung gan vao error
                $errors['email'] = ' Email đã tồn tại ! ';
            }
        }
        // kiểm tra lỗi
        if($phone == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['phone'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // kiểm tra lỗi
        if($address == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['address'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // kiểm tra lỗi
        if($password == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }

        // nếu mảng errors trống => Ko có lỗi  tiến hành insert 
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'name'     => $name ,
                'email'    => $email,
                'phone'    => $phone,
                'address'    => $address,
                'password' => md5($password),
                'level' => $level,
            ];
            //tiến hành insert 
            $id_insert = DB::insert('users',$data);

            if($id_insert > 0) {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = "Thêm mới thành công ";
                header("Location: ".baseServerName().'/admin/modules/users');exit();
            } else {
                // gán session thông báo thất bại
                $_SESSION['error'] = "Thêm mới thất bại  ";
                header("Location: ".baseServerName().'/admin/modules/users');exit();
            }
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
        <style type="text/css">

        </style>
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
                        <?= isset($title_global) ? $title_global : 'Trang admin ' ?> 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Trang chủ </a></li>
                        <li><a href="#"> Thành viên </a></li>
                        <li class="active"> Thêm mới </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-9 col-sm-offset-2">
                                <!-- Horizontal Form -->
                                <p><span class="color-red">(*)</span> Những trường này bắt buộc phải nhập  | </p>
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">
                                        
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Họ và tên <span class="color-red">(*)</span> </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"  placeholder="VD Nguyễn Văn A" autocomplete="off" value="<?= isset($name) ? $name : '' ?>">
                                                    <?php if(isset($errors['name'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>

                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Email <span class="color-red">(*)</span> </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="email" id="name" value="<?= isset($email) ? $email : '' ?>" autocomplete="off" placeholder=" VD nguyenvana@gmail.com ">
                                                    <?php if(isset($errors['email'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Số điện thoại <span class="color-red">(*)</span> </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="phone"  placeholder="VD 0928817***" autocomplete="off" value="<?= isset($phone) ? $phone : '' ?>">
                                                    <?php if(isset($errors['phone'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['phone'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Địa chỉ <span class="color-red">(*)</span> </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="address"  placeholder="" autocomplete="off" value="<?= isset($address) ? $address : '' ?>">
                                                    <?php if(isset($errors['address'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['address'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Password <span class="color-red">(*)</span> </label>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control" name="password"  value="<?= isset($password) ? $password : '' ?>" autocomplete="off" placeholder=" VD nguyenvana1234 ">
                                                    <?php if(isset($errors['password'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Vai trò  </label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="level">
                                                        <option <?= isset($level) && $level == 0 ? 'selected="selected"' : '' ?> value="0">Người dùng</option>
                                                        <option <?= isset($level) && $level == 1 ? 'selected="selected"' : '' ?> value="1">Nhân viên</option>
                                                        <option <?= isset($level) && $level == 2 ? 'selected="selected"' : '' ?> value="2">Quản trị viên</option>
                                                    </select>
                                                    <?php if(isset($errors['level'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['level'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary btn-xs">Thêm mới  </button>
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