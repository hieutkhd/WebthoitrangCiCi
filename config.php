<?php 
// duong dan toi module trong admin
define("MODULES", $_SERVER['DOCUMENT_ROOT'] ."/admin/modules/");

// duong dan toi  layouts 
define("MAIN", $_SERVER['DOCUMENT_ROOT'] ."/admin/layouts/main/");

// duong dan upload 
define("UPLOADS", $_SERVER['DOCUMENT_ROOT'] ."/public/uploads/");


// config database
define("LOCALHOST","localhost");
define("USER","root");
define("PASS","");
define("DATABASE","db_thoi_trang");

$vnp_TmnCode = "B6D7F86K"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "YVVVDXXUGTGPFEVRUBWEXKIIYNNFUUTZ"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://".$_SERVER['SERVER_NAME'] . "/pages/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));


$arrayPrice = [
    '1-3' => [
        '1000000',
        '3000000'
    ],
    '3-5' =>[
        '3000000',
        '5000000'
    ],
    '5-7' =>[
        '5000000',
        '7000000'
    ],
    '7-10' => [
        '7000000',
        '10000000'
    ],
    '10-15' => [
        '10000000',
        '15000000'
    ],
    '15-20' => [
        '15000000',
        '20000000'
    ],
    '20' =>
    [
        '20000000'
    ]
];
