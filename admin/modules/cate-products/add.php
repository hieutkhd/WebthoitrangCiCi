<?php
    $modules = 'cate-products';
    $title_global = 'Thêm mới danh mục sản phẩm ';
    require_once __DIR__ .'/../../autoload.php';

    $catePro = DB::query('category_products', '*', ' AND cpr_parent_id = 0');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("cpr_name");
        $hot      = Input::get("cpr_hot");
        $active   = Input::get("cpr_active");
        $sort = Input::get("cpr_sort");
        $parent_id = Input::get("cpr_parent_id");
        // kiểm tra lỗi
        if($name == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['cpr_name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // nếu mảng errors trống => Ko có lỗi  tiến hành insert 
        if(empty($errors)) {
            // gán vào 1 mảng giá trị để insertt 
            $data = [
                'cpr_name'     => $name ,
                'cpr_hot'    => $hot,
                'cpr_active'   => $active ,
                'cpr_sort'   => $sort,
                'cpr_parent_id' => $parent_id
            ];

            //tiến hành insert 
            $id_insert = DB::insert('category_products', $data);

            if($id_insert > 0) {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục category_products
                $_SESSION['success'] = "Thêm mới thành công ";
                header("Location: ".baseServerName().'/admin/modules/cate-products');exit();
            } else {
                $_SESSION['error'] = "Thêm mới thất bại  ";
                header("Location: ".baseServerName().'/admin/modules/cate-products');exit();
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
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                        <li><a href="#">Danh Mục Sản phẩm </a></li>
                        <li class="active"> Thêm mới</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body" style="padding: 0px !important;">
                            <div class="col-md-12" style="padding: 0px !important;">
                                <!-- Horizontal Form -->
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label"> Tên danh mục <span class="color-red">(*)</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="cpr_name" id="inputEmail3" placeholder="VD Giầy thể thao nam" autocomplete="off" value="<?= isset($name) ? $name : ''?>">
                                                    <?php if(isset($errors['cpr_name'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['cpr_name'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Danh mục cha <span class="color-red">(*)</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="cpr_parent_id">
                                                        <option value=""> - Chọn danh mục  - </option>
                                                        <?php if(count($catePro) > 0) :?>
                                                            <?php foreach($catePro as $catep) :?>
                                                                <option value="<?= $catep['id'] ?>" <?= isset($cate) && $cate['cpr_parent_id'] == $catep['id'] ? 'selected="selected"' : '' ?> ><?php echo $catep['cpr_name'] ?></option>
                                                            <?php endforeach ;?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if( isset( $errors['cate']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['cate'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label"> Hot </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_hot" id="optionsRadios1" value="1">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_hot" id="optionsRadios2" value="0" checked>
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                                <label for="" class="col-sm-2 control-label"> Trạng thái </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_active" id="optionsRadios2" value="1">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_active" id="optionsRadios1" value="0" checked>
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label"> Thứ tự hiển thị </label>
                                                <div class="col-sm-3">
                                                    <input type="number" name="cpr_sort" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-3">
                                            <button type="submit" class="btn btn-primary btn-xs"> Thêm mới  </button>
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
