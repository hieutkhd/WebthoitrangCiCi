<?php
require_once __DIR__. '/../autoload.php';
// kiểm tra xem giỏ hàng có tồn tại không
if( ! isset($_SESSION['hear']) ||  count($_SESSION['hear']) == 0 )
{
    redirectUrl('/pages');
}
//  gán danh sách giỏ hàng vào 1 mảng
$product = $_SESSION['hear'];
$product = array_values($product); $product = implode(',',$product);
$sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
         WHERE products.ID IN (".$product.")";
$list  = Pagination::pagination('products',$sql,'page',9);


?>
    <!DOCTYPE html>
    <html>
    <head>
        <title> Danh sách yêu thích </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
    </head>
<body>
<div id="wrapper">
    <!---->
    <!--HEADER-->
<?php require_once __DIR__.'/../layouts/inc_header.php'; ?>
    <!--END HEADER-->


    <!--MENUNAV-->
<?php require_once __DIR__.'/../layouts/inc_menu.php' ;?>
    <!--ENDMENUNAV-->

    <div id="maincontent">
    <div class="container">
        <div class="col-md-12">
            <section class="box-main1" >
                <div class="panel panel-primary">
                    <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Sản Phẩm </th>
                                <th>Hình Ảnh</th>
                                <th> Giá </th>
                                <th> Thao Tác </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $key => $item) :?>
                                <tr class="delete_tr">
                                    <td><?= $key ?></td>
                                    <td><?= $item['prd_name'] ?></td>
                                    <td>
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" alt="" style="width:50px;height:50px;">
                                    </td>
                                    <td><?= formatPrice($item['prd_price']) ?>đ</td>
                                    <td>
                                        <a href="javascript:;void(0)" class="btn btn-xs btn-danger remove-item-cart" data-id-product=<?= $key ?>> Huỷ Bỏ  </a>
                                    </td>
                                </tr>
                            <?php endforeach ; ?>
                            </tbody>
                        </table>
                    </div>
<!--                    <div class="panel-footer">-->
<!--                        <div class="pull-right">-->
<!--                            <a href="" class="btn btn-xs btn-danger">Tiếp tục mua hàng </a>-->
<!--                            <a href="thanh-toan.php" class="btn btn-xs btn-success">Tiến hành thanh toán  </a>-->
<!--                        </div>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
                </div>

            </section>

        </div>
    </div>
<?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>