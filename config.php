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
define("DATABASE","db_basephp");


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
