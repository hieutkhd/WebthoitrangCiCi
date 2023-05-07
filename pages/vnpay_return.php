<?php
require_once __DIR__. '/../autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="/pages/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="/pages/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/pages/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>
<body>
<?php
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}
if (intval($inputData['vnp_TransactionStatus']) !== 0) {
    $url = baseServerName();
    header('Location: ' . $url);
    return false;
}
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

$code_order = $_SESSION['code_order'];
$dataTransaction = isset($_SESSION['data_transaction']) ? $_SESSION['data_transaction'] : [];
$cartProduct = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$txnRef = $_GET['vnp_TxnRef'];
$amount = $_GET['vnp_Amount'] / 100;
$orderInfo = $_GET['vnp_OrderInfo'];
$responseCode = $_GET['vnp_ResponseCode'];
$transactionNo = $_GET['vnp_TransactionNo'];
$bankCode = $_GET['vnp_BankCode'];
$payDate = $_GET['vnp_PayDate'];



if (!empty($dataTransaction)) {

    $idTransaction = DB::insert('transactions', $dataTransaction);

    foreach($cartProduct as $key => $val)
    {
        $order = [
            'od_transaction_id' => $idTransaction,
            'od_product_id'     => $key,
            'od_price'          => $val['price'],
            'od_qty'            => $val['qty'],
        ];

        if (!empty($val['size'])) {
            $order['od_size'] = $val['size'];
        }
        if (!empty($val['color'])) {
            $order['od_color'] = $val['color'];
        }
        $idOrder = DB::insert('orders',$order);

        $product = DB::fetchOne('products', intval($key));
        $qty = intval($product['prd_number']) - intval($val['qty']);
        DB::update('products', ['prd_number' => $qty], ' id = '. intval($key));
    }

    $payments = [
        'p_transaction_id' => $idTransaction,
        'p_money' => $amount,
        'p_note' => $orderInfo,
        'p_vnp_response_code' => $responseCode,
        'p_code_vnpay' => $transactionNo,
        'p_code_bank' => $bankCode,
        'p_time' => $payDate,
    ];

    DB::insert('payments', $payments);

    if (intval($responseCode) == 0) {
        DB::update('transactions', ['tst_status' => 1], ' id = '.$idTransaction);
    }
    unset($_SESSION['transaction_id']);
    unset($_SESSION['data_transaction']);
    unset($_SESSION['cart']);
}


?>
<!--Begin display -->
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">VNPAY RESPONSE</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label >Mã đơn hàng:</label>

            <label><?php echo $txnRef ?></label>
        </div>
        <div class="form-group">

            <label >Số tiền:</label>
            <label><?php echo number_format($amount) ?> vnđ</label>
        </div>
        <div class="form-group">
            <label >Nội dung thanh toán:</label>
            <label><?php echo $orderInfo ?></label>
        </div>
        <div class="form-group">
            <label >Mã phản hồi (vnp_ResponseCode):</label>
            <label><?php echo $responseCode ?></label>
        </div>
        <div class="form-group">
            <label >Mã GD Tại VNPAY:</label>
            <label><?php echo $transactionNo ?></label>
        </div>
        <div class="form-group">
            <label >Mã Ngân hàng:</label>
            <label><?php echo $bankCode ?></label>
        </div>
        <div class="form-group">
            <label >Thời gian thanh toán:</label>
            <label><?php echo $payDate ?></label>
        </div>
        <div class="form-group">
            <label >Kết quả:</label>
            <label>
                <?php
                if ($secureHash == $vnp_SecureHash) {
                    if ($_GET['vnp_ResponseCode'] == '00') {
                        echo "<span style='color:blue'>GD Thanh cong</span>";
                    } else {
                        echo "<span style='color:red'>GD Khong thanh cong</span>";
                    }
                } else {
                    echo "<span style='color:red'>Chu ky khong hop le</span>";
                }
                ?>

            </label>
            <label>
            </label>
            <br>
            <a href="<?= baseServerName() ?>">
                <button>Quay lại</button>
            </a>
        </div>
    </div>
    <p>
        &nbsp;
    </p>
    <footer class="footer">
        <p>&copy; VNPAY <?php echo date('Y')?></p>
    </footer>
</div>
</body>
</html>
