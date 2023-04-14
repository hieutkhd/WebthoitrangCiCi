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
    
    $product = DB::fetchOne('products',$id);

    /**
     * nếu trống thì id không tồn tại
     */

    if ( empty($product))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".baseServerName().'/admin/modules/products');exit();
    }
  

  
    $hot = $product['prd_hot'] == 1 ? 0 : 1;
    $update = DB::update("products",array('prd_hot' => $hot) ,array("id" => $id));
    $update && $update > 0 ? $_SESSION['success'] = ' Cập nhật thành công  ' : $_SESSION['error'] = ' Cập nhật thất bại  ';
    header("Location: ".baseServerName().'/admin/modules/products');exit();
 ?>