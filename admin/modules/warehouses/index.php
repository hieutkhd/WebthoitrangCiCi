<?php
    $modules = 'warehouses';
    $title_global = '  Danh sách các sản phẩm trong kho  ';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id WHERE 1 ORDER BY id DESC
    ";
    $filter = [];
    $products = Pagination::pagination('products',$sql,'page',9);

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
                        <li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                        <li><a href="#"> Kho </a></li>
                        <li class="active"> Danh sách</li>
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
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th>Thông tin</th>
                                    </tr>
                                    <?php foreach($products as $pro) :?>
                                        <tr class='<?= $pro['prd_number'] <= 5 ? "bg-danger-nhat" : "" ?>'>
                                            <td><?= $pro['id'] ?></td>
                                            <td><?= $pro['prd_name'] ?></td>
                                            <td>
                                                <img src="/public/uploads/products/<?= $pro['prd_thunbar'] ?>" alt="<?= $pro['prd_name'] ?>" style="width:50px;height:50px;" class="img img-responsive">
                                            </td>
                                            <td>
                                                Danh Mục : <span class="label label-success"><?= $pro['cpr_name'] ?></span><br>
                                                Số Lượng : <b><?= $pro['prd_number'] ?></b> | Sale : <b><?= $pro['prd_sale'] ?> (%) </b><br>
                                                Giá : <b> <?= formatPrice($pro['prd_price']) ?> đ </b> <?= $pro['prd_sale'] != 0 ? " | <b>".formatPrice($pro['prd_price'],$pro['prd_sale'])." đ</b>" : '' ?>
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
                                    <?php echo Pagination::getListpage($filter) ?>
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
