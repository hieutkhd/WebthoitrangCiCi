<?php

    require_once __DIR__. '/../autoload.php';

    // kiểm tra có tồn tại sản phẩm
    if( isset($_GET['idProduct']))
    {
        $id = $_GET['idProduct'];
    }
    // kiểm đã đăng nhập thông tin người dùng
    if ( ! isset($_SESSION['username'])) {
        $data = ['status' => 0];
        die(json_encode($data));
    }

    if (isset($id)) {

        $productLike = DB::fetchOne('product_like',' user_id = '. $_SESSION['id'] .' and  product_id = '. $id . '  limit 1');
        if (empty($productLike)) {
            $data = ['user_id' => $_SESSION['id'], 'product_id' => $id];
            DB::insert('product_like',$data);

            $product = DB::fetchOne('products', intval($id));
            $like = $product['prd_like'] + 1;

            $dataProduct= ['prd_like' => $like];
            DB::update('products', $dataProduct, ' id = '.$id);

            $data = ['status' => 1];
            die(json_encode($data));
        } else {
            $data = ['status' => 2];
            die(json_encode($data));
        }
    }