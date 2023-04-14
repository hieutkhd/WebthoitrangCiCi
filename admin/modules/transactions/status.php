<?php
    /**
     * gọi file autoload
     */
    
    require_once __DIR__ .'/../../autoload.php';

    /**
     *  lấy id url
     */
    $id = (int)Input::get('id');

    /**
     * lấy id cần  sửa 
     * kiểm tra xem có tồn tại trong csdl không 
     */
    
    $transaction = DB::fetchOne('transactions', $id);

    /**
     * nếu trống thì id không tồn tại
     */

    if ( empty($transaction))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".baseServerName().'/admin/modules/transactions');exit();
    }
  
    $time_pay = date('Y-m-d');  
    $hot = $transaction['tst_status'] == 1 ? 0 : 1;
    $update = DB::update("transactions",array('tst_status' => $hot,'tst_date_payment' => $time_pay) ,array("id" =>  $id));
    if ( $update && $update > 0 )
    {
        $orders = DB::query('orders','*',' and od_transaction_id = '. $id);
        if ( $orders )
        {
            foreach ($orders as $key => $item) {
                $product = DB::fetchOne('products',(int)$item['od_product_id']);
                if( $product )
                {
                    $pay    = ($hot  == 1) ? intval($product['prd_pay']) + intval($item['od_qty']) : intval($product['prd_pay']) - intval($item['od_qty']);
                    $totalProduct    = ($hot  == 0) ? $product['prd_number'] + intval($item['od_qty']) : $product['prd_number'] - intval($item['od_qty']);
                    $id_update = DB::update('products',array('prd_pay' => $pay, 'prd_number' => $totalProduct) , ' id = ' . (int)$item['od_product_id']);
                }
            }
        }
        $_SESSION['success'] = ' Cập nhật thành công ';
    }else 
    {
        $_SESSION['error'] = ' Cập nhật thất bại  ';
    }
    
    header("Location: ".baseServerName().'/admin/modules/transactions');exit();
 ?>