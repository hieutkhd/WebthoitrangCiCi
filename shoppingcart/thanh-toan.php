<?php
    require_once __DIR__. '/../autoload.php';
    // yêu cầu đăng nhập để đặt hàng
    if( !isset($_SESSION['id']))
    {
        $_SESSION['error'] = "Bạn cần đăng nhập để đặt hàng";
        header("Location: ".baseServerName().'/shoppingcart/danh-sach-gio-hang.php');exit();
    }
    // kiểm tra xem giỏ hàng có tồn tại không 
    if( ! isset($_SESSION['cart']) ||  count($_SESSION['cart']) == 0 )
    {
        redirectUrl('/pages');
    }

    //  gán danh sách giỏ hàng vào 1 mảng 
    $cartProduct = $_SESSION['cart'];
    $sum = 0 ;

    // xac nhan thanh toan
    // xu ly thanh toan 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       $name    = Input::get('name');
       $email   = Input::get('email');
       $phone   = Input::get('phone');
       $address = Input::get('address');
       $method = Input::get('submit');
       $code_order = randString(8);

        $data = [
            'tst_email'   => $email,
            'tst_name'    => $name,
            'tst_phone'   => $phone,
            'tst_address' => $address,
            'tst_total'   => $_SESSION['total'],
            'tst_user_id' => $_SESSION['id'],
            'tst_code_order' => $code_order,
            'tst_date_payment' => date('Y-m-d H:i'),
            'tst_status' => 0
        ];

        if ($method == 1) {
            $data['tst_payment_method'] = 'Trực tiếp';
        } else {
            $data['tst_payment_method'] = 'Online';
        }

        if ($method == 1) {

            $idTransaction = DB::insert('transactions',$data);
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
            unset($_SESSION['cart']);
            $_SESSION['thongbao'] = 'Cám ơn bạn đã đặt hàng. Đơn hàng của bạn đã được chúng tôi tiếp nhận và xử lý';
            redirectUrl('/shoppingcart/thong-bao.php');
        } else {

            $_SESSION['data_transaction'] = $data;
            $_SESSION['code_order'] = $code_order;
            $total = $_SESSION['total'];

            $vnp_TxnRef = $code_order; //Mã giao dịch thanh toán tham chiếu của merchant
            $vnp_Amount = $total; // Số tiền thanh toán
            $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=>$expire
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";

            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            header('Location: ' . $vnp_Url);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Thanh toán đơn hàng  </title>
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
                        <div class="col-sm-4">
                        <form action="" method="POST">
                            <div class="panel panel-primary">
                            
                                <div class="panel-heading"> Thông tin thanh toán </div>
                                <div class="panel-body">
                                    
                                        <div class="form-group">
                                            <label for="email"> Họ Và Tền <span style="color:red">(*)</span></label>
                                            <input type="text" required="" class="form-control" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" placeholder=" Họ tên đầy đủ " name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <span style="color:red">(*)</span></label>
                                            <input type="email" required="" class="form-control" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" placeholder="Email cá nhân" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Địa chỉ  <span style="color:red">(*)</span></label>
                                            <input type="text"  required="" class="form-control" placeholder="Địa chỉ nhận hàng" value="<?= isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Số điện thoại  <span style="color:red">(*)</span></label>
                                            <input type="number" required="" class="form-control" value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>" placeholder="Số điện thoại liên hệ " name="phone">
                                        </div>
                                        
                                    
                                </div>
                                <div class="panel-footer">
                                    <div class="pull-right">
                                        <button type="submit" name="submit" value="1" class="btn btn-xs btn-success"> Đặt hàng </button>
                                        <button type="submit" name="submit" value="2" class="btn btn-xs btn-success"> Đặt hàng và thanh toán </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"> Mời bạn đọc danh sách các điều khoản  </div>
                                <div class="panel-body">
                                
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                                <div class="panel-body">
                                    <?php foreach($cartProduct as $item) :?>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="/public/uploads/products/<?= $item['img'] ?>" class="media-object" style="width:60px">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?= $item['name'] ?></h4>
                                                <p>Số Lượng : <span><?= $item['qty'] ?></span></p>
                                                <p> Giá : <span><?= formatPrice($item['price']* $item['qty']) ?>đ</span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php $sum += $item['price']* $item['qty']; ?>
                                    <?php endforeach ; ?>
                                    <?= $_SESSION['total'] = $sum ?>
                                    <p> Thành tiền : <span class="label label-success"><?= formatPrice($sum) ?> đ</span></p>
                                </div>
                                
                            </div>
                        </div>
                           
                       
                        </section>
                        
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>