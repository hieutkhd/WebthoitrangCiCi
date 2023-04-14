<?php
    require_once __DIR__ .'/../../autoload.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $id = Input::get('id');
    $sql = " SELECT orders.*  , products.prd_name as name ,products.prd_thunbar as hinhanh FROM  orders 
        LEFT JOIN products ON products.id = orders.od_product_id
        WHERE 1 AND od_transaction_id = $id 
    ";
    $orders = DB::fetchsql($sql);
    if( ! $orders )
    {
       echo 0 ;die;
    }
    // lấy ra thông tin người đặt hàng theo id đơn hàng
    $transaction = DB::fetchOne('transactions', intval($id));
    $payment = DB::fetchOne('payments', ' p_transaction_id =' . intval($id));

?>
    <div class="row">
        <div class="col-md-6" style="padding: 0px; margin-bottom: 30px;">
            <p><b>Tên khách hàng : <?php echo $transaction['tst_name'] ?></b></p>
            <p><b>Số điện thoại : <?php echo '0' . $transaction['tst_phone'] ?></b></p>
            <p><b>Địa chỉ giao hàng : <?php echo $transaction['tst_address'] ?></b></p>
            <!-- format ngày tháng năm -->
            <p><b>Ngày đặt hàng : <?php echo date('d-m-Y', strtotime($transaction['created_at'])) ?></b></p>
            <!-- format định dạng giờ -->
            <p><b>Giờ đặt hàng : <?php echo date('H:i:s', strtotime($transaction['created_at'])) ?></b></p>
            <?php if (!empty($transaction['tst_messages'])) : ?>
                <p><b>Ghi chú đơn hàng : <?php echo $transaction['tst_messages'] ?></b></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($payment)) : ?>
        <div class="col-md-6" style="margin-bottom: 30px;">
            <p style="text-align: center"><b>Thanh toán online</b></p>
            <p><b>Mã giao dịch : <?= $payment['p_code_vnpay'] ?></b></p>
            <p><b>Ngân hàng : <?= $payment['p_code_bank'] ?></b></p>
            <p><b>Thời gian : <?= $payment['p_time'] ?></b></p>
            <p><b>Trạng thái : <?= intval($payment['p_vnp_response_code']) == 0 ? 'Thành công' : 'Thất bại' ?></b></p>
        </div>
        <?php endif; ?>
    </div>
    <table class="table table-hover" id="vieworder-content">
        <tbody>
        <tr class="bg-tr">
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th> Hình ảnh </th>
            <th class="text-center">Giá </th>
            <th>Số Lượng</th>
            <th>Size</th>
            <th>Color</th>
            <th>Thành Tiền</th>
        </tr>
        </tbody>
        <tbody id="order-content">
            <?php $total = 0 ?>
            <?php foreach ($orders as $key => $item) :?>
                <tr class="delete_tr">
                    <td><?= $item['id'] ?></td>
                    <td> <?= $item['name'] ?></td>
                    <td>
                        <img src="/public/uploads/products/<?= $item['hinhanh'] ?>" alt="" style="width: 50px;height: 50px;">
                    </td>
                    <td>
                        <?= formatPrice($item['od_price']) ?>
                    </td>
                    <td><?= $item['od_qty'] ?></td>
                    <td><?= $item['od_size'] ?></td>
                    <td><?= $item['od_color'] ?></td>
                    <td> <?= formatPrice($item['od_price'] * $item['od_qty']) ?> đ</td>
                </tr>
                <?php
                    $total  =  $total  + ($item['od_price'] * $item['od_qty'])
                ?>
            <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-center">Tổng tiền thanh toán </td>
                    <td colspan="2" class="text-center"><?= formatPrice($total) ?> đ</td>
                </tr>
        </tbody>
    </table>
