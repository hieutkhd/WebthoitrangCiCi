<?php
require_once __DIR__. '/../autoload.php';

    $sql = "SELECT products.* FROM product_like INNER jOIN  products ON product_like.product_id = products.id WHERE user_id = " . $_SESSION['id'] . "  ORDER BY id DESC";
    $products = Pagination::pagination('products',$sql,'page',12);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sản phẩm ưa thích </title>
    <meta charset="utf-8">
    <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
    <style>
        .box-menu .active a{ color:red !important }
    </style>
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
            <div class="col-md-3  fixside" >
                <?php require_once __DIR__.'/../layouts/inc_left.php' ;?>
                <?php require_once __DIR__.'/../layouts/inc_left_product.php';?>
            </div>
            <div class="col-md-9 bor">
                <section class="box-main1">
                    <h3 class="title-main" style="text-align: left;"><a href="javascript:void(0)">Sản phẩm đã thích</a> </h3>
                    <div class="showitem clearfix">
                        <?php foreach($products as $item) :?>
                            <div class="col-md-3 item-product bor clearfix">
                                <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                    <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="" width="100%" height="180">
                                </a>
                                <div class="info-item">
                                    <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><p class="custom-name" title="<?= $item['prd_name'] ?>"><?= $item['prd_name'] ?></p></a>
                                    <?php if($item['prd_sale']) :?>
                                        <p><strike class="sale"><?= formatPrice($item['prd_price']) ?> đ</strike> <b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b></p>
                                    <?php else :?>
                                        <p><b class="price"><?= formatPrice($item['prd_price']) ?> đ</b></p>
                                    <?php endif ;?>

                                </div>
                                <div class="hidenitem">
                                    <p><a href="javascript:;void(0)" class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                </div>
                            </div>
                        <?php endforeach ; ?>
                    </div>
                </section>
            </div>
            <div>
                <?= Pagination::getListpage() ?>
            </div>
        </div>
        <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>
