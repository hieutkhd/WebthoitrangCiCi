<?php
    session_start();
    @ob_start();
    // khai báo time zone
    date_default_timezone_set('Asia/Ho_Chi_Minh');//change zone as per need
    // goi file Function
    require_once __DIR__ .'/vendor/init.php';

    // goi file Config
    require_once __DIR__ .'/config.php';

    // lay danh muc san pham
    $categorys = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_parent_id = 0  ORDER BY cpr_sort ASC  ");
    $categoHot = DB::query("category_products","*"," AND cpr_active = 1  and cpr_hot = 1 ORDER BY ID DESC LIMIT 5 ");

    // danh sách sản  sản phẩm mới 
    $sqlProductNew = "SELECT * FROM products WHERE prd_active = 1 ORDER BY id DESC LIMIT 8";
    $productNew = DB::fetchsql($sqlProductNew);

    // san pham noi bat 
    $sqlProductHot = "SELECT * FROM products WHERE prd_active = 1 and prd_hot = 1  ORDER BY id DESC LIMIT 8";
    $productHot = DB::fetchsql($sqlProductHot);

    $sqlProductView = "SELECT * FROM products WHERE prd_active = 1  AND prd_view > 0  ORDER BY prd_view DESC LIMIT 8";
    $productView = DB::fetchsql($sqlProductView);

    if (isset($_COOKIE['productId'])) {
        $stringId = str_replace('[', '(', $_COOKIE['productId']);
        $stringId = str_replace(']', ')', $stringId);
        $productDataCookei = DB::query('products', '*', ' AND id IN '. $stringId . " ORDER BY id DESC LIMIT 8");
    }

?>