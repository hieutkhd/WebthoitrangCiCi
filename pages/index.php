<?php
    require_once __DIR__. '/../autoload.php';
    
    // danh sach sp thuoc danh muc hot 
    $cateHot = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_hot = 1 ORDER BY id DESC  ");
    $productCateHot = [];
    if( $cateHot )
    {
        foreach ($cateHot as $key => $value) {
            $listCateId = [$value['id']]; 

            if (intval($value['cpr_parent_id']) == 0) {
                $subCate = DB::query("category_products","*"," AND cpr_parent_id = " . $value['id']);
                foreach ($subCate as $key => $sub) {
                    array_push($listCateId, $sub['id']);
                }
            }

            $product = DB::query('products', '*' , ' AND prd_active = 1 AND prd_category_product_id IN ('. implode(',', $listCateId) .') LIMIT 8');
            if (!empty($product)) {
                $productCateHot[] = [
                    'name'    => $value['cpr_name'],
                    'product' => $product
                ];
            }
        }
        
    }

    // sản phẩm bán chạy
    $sql = "SELECT * FROM products WHERE prd_active = 1  ORDER BY prd_pay DESC LIMIT 8";
    $productBestSelling  = DB::fetchsql($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>THỜI TRANG UY TÍN, CHẤT LƯỢNG HÀNG ĐẦU TẠI VIỆT NAM </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style type="text/css">
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
                        <?php require_once __DIR__.'/../layouts/inc_left.php';?>
                        <?php require_once __DIR__.'/../layouts/inc_left_product.php';?>
                    </div>
                    <div class="col-md-9 bor">
                        <!-- SLIDE -->
                        <section id="slide" class="text-center" >
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="/public/frontend/images/slide/banner-thoi-trang-dep.jpg" alt="Los Angeles">
                                    </div>
                                    <div class="item">
                                        <img src="/public/frontend/images/slide/9557036_orig.jpg" alt="Chicago">
                                    </div>
                                    <div class="item">
                                        <img src="/public/frontend/images/slide/b__trai_master.jpg" alt="New York">
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </section>
                        <!-- END SLIDE -->
                        <section class="box-main1" style="margin-bottom:50px;">
                            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Danh sách sản phẩm mới  </a> </h3>
                            <div class="showitem clearfix">
                                <?php foreach($productNew as $item) :?>
                                    <div class="col-md-3 item-product bor clearfix">
                                        <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>" title="<?= $item['prd_name'] ?>">
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
                                            <p><a  class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                        </div>
                                    </div>
                                <?php endforeach ; ?>

                            </div>
                        </section>

                        <section class="box-main1" style="margin-bottom:50px;">
                            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Sản phẩm bán chạy  </a> </h3>
                            <div class="showitem clearfix">
                                <?php foreach($productBestSelling as $item) :?>
                                    <div class="col-md-3 item-product bor clearfix">
                                        <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>" title="<?= $item['prd_name'] ?>">
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
                                            <p><a  class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                        </div>
                                    </div>
                                <?php endforeach ; ?>

                            </div>
                        </section>

                        <section class="box-main1" style="margin-bottom:50px;">
                            <?php  foreach($productCateHot as $product) :?>
                                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"><?= $product['name'] ?>  </a> </h3>
                                <div class="showitem clearfix">
                                    <?php foreach($product['product'] as $item) :?>
                                        <div class="col-md-3 item-product bor clearfix">
                                            <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>" title="<?= $item['prd_name'] ?>">
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
                                                <p><a  class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                            </div>
                                        </div>
                                    <?php endforeach ; ?>
                                </div>
                            <?php endforeach ; ?>
                        </section>
                        <?php require_once __DIR__.'/../layouts/inc_cookei.php'; ?>
                    </div>

                </div>

                <div class="container" style="margin-top: 50px;">
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/free-shipping.png"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/guaranteed.png"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/deal.png"></a>
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>