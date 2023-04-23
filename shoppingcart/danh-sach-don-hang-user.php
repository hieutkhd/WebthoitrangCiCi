<?php
    require_once __DIR__ . '/../autoload.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM transactions  WHERE tst_user_id  = ". $id . " ORDER BY id DESC";
    $transactions = Pagination::pagination('transactions',$sql,'page',9);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Danh sách đơn hàng đã đặt</title>
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
        <div class="col-md-9 bor" style="padding: 0px;">
            <!-- SLIDE -->
            <section>
                <div class="panel-heading heading">Danh sách đơn hàng đã đặt</div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Thông tin</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết đơn hàng</th>
                            </tr>
                            <?php foreach ($transactions as $key => $item) :?>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <p><?= $item['tst_name'] ?></p>
                                        <p><?= $item['tst_email'] ?></p>
                                        <p><?= $item['tst_phone'] ?></p>
                                    </td>
                                    <td style="vertical-align: middle;"><?= formatPrice($item['tst_total']) ?> đ</td>
                                    <td style="vertical-align: middle;">
                                        <?= $item['tst_payment_method'] ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="" class="custome-btn label <?= $item['tst_status'] == 1 ? 'label-info' : 'label-default' ?>"><span> <?= $item['tst_status'] == 1 ? ' Đã thanh toán ' : ' Chưa thanh toán ' ?></span></a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="javascript:;void(0)" class="custome-btn btn-info btn-xs item-order" data-id="<?= $item['id' ] ?>" style="margin-right: 10px;"> Xem chi tiết </a>
                                    </td>
                                </tr>
                            <?php endforeach ; ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <div class="modal fade" id="modal-vieworder">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Chi tiết đơn hàng </h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover" id="vieworder-content">
                                <tbody>
                                <tr class="bg-tr">
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th> Hình ảnh </th>
                                    <th class="text-center">Giá </th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                </tr>
                                </tbody>
                                <tbody id="order-content">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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