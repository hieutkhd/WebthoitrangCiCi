<?php
$modules = '';
$title_global = '';
require_once __DIR__ .'/../../autoload.php';

$id = (int)Input::get('id');
$transaction = DB::fetchOne('transactions', $id);


if (empty($transaction)) {
    $_SESSION['error'] = ' Không tồn tại dữ liệu giao dịch ';
    header("Location: ".baseServerName().'/admin/modules/transactions');exit();
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
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"></a></li>
                <li class="active">Thêm mới</li>
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
                            <form class="form-horizontal" action="status.php" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Trạng thái </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="status">
                                                <option value=""> - Chọn trạng thái - </option>
                                                <?php foreach ($status as $key => $item) : ?>
                                                    <option value="<?= $key ?>" <?php echo $transaction['tst_status'] == $key ? 'selected' : '' ?>> <?= $item ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-xs">Cập nhật  </button>
                                    <a href="/index.php" class="btn btn-danger btn-xs"> Quay lại </a>
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
