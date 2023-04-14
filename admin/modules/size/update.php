<?php
    $modules = 'size';
    $title_global = 'Cập nhật size ';
    require_once __DIR__ .'/../../autoload.php';
    // lấy giá trị id
    $id = Input::get('id');
    // lấy dữ liệu trong database
    $size = DB::fetchOne('sizes', intval($id));
    // kiểm tra nếu không tồn tại
    if( ! $size ) {
        $_SESSION['error'] = "  Không tồn tại dữ liệu ";
        header("Location: ".baseServerName().'/admin/modules/size'); exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name   = Input::get("name");

        // kiểm tra lỗi
        if($name == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        } else {
            // check tên danh mục không được phép trùng nhau
            if( $name != $size['ame']) {
                $checkName = DB::fetchOne("sizes" ," name  = '". $name . "'");
                if( $checked )
                {
                    $errors['name'] = 'Tên size đã tồn tại';
                }
            }
            
        }
        // nếu mảng errors trống => Ko có lỗi  tiến hành update 
        if(empty($errors)) {
            // gán vào 1 mảng giá trị để insertt 
            $data = [
                'name'     => $name ,
            ];
            //tiến hành update 
            $id_update = DB::update('sizes',$data , ' id = '. $id);
            // insert thanh cong
            // gán session thông báo thành công
            //chuyển về trang index trong thư mục category_products
            $_SESSION['success'] = "Cập nhật thành công ";
            header("Location: ".baseServerName().'/admin/modules/size');exit();
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
                        <li><a href="#">Size </a></li>
                        <li class="active"> Chỉnh sửa </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box" style="padding: 0px !important;">
                        <div class="box-body" style="padding: 0px !important;">
                            <div class="col-md-8 col-sm-offset-2">
                                <!-- Horizontal Form -->
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Tên size <span class="color-red">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="VD (M, L, 44, 45)" autocomplete="off" value="<?= $size['name'] ?>">
                                                    <?php if(isset($errors['name'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary btn-xs">Cập nhật  </button>
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
