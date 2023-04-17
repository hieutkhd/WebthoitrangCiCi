<?php
    require_once __DIR__. '/../autoload.php';
    // lấy giá trị biến trên url
    $keyword = Input::get('keyword');
    $sort = Input::get('sort');
    $by = Input::get('by');
    // gán vào mảng tìm kiếm
    $filter['keyword'] = $keyword;
    $filter['sort'] = $sort;
    $filter['by'] = $by;
    // kiểm tra có tồn tại biến sort không thì gán giá trị mặc định
    $orderBy = isset($sort) && !empty($sort) ? $sort : 'id';
    $bys = isset($by) && !empty($by) ? $by : 'desc';
    
    // truy vấn dữ liệu từ database
    if (!empty($keyword)) {
        $sql = 'SELECT * FROM products WHERE prd_name LIKE "%'. $keyword .'%" ORDER BY ' . $orderBy . ' '. $bys;
        $products = Pagination::pagination('products',$sql,'page',12);
    } else {
        $products = [];
    }

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh mục sản phẩm </title>
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
                    <h3 class="title-main" style="text-align: left;"><a href="javascript:void(0)"> Từ khóa tìm kiếm : <?php echo  $keyword ?> |  Có  <?= count($products) ?> kết quả được tìm thấy </a> </h3>
                    <div class="sort_price">
                        <select name="" id="sort_product" class="form-control select_sort">
                            <option value="">Sắp xếp theo</option>
                            <option <?php echo  $by == 'desc' ? "selected='selected'" : '' ?> value="<?php echo $actual_link . '&sort=prd_price&by=desc' ?>">Giá cao đến thấp</option>
                            <option <?php echo  $by == 'asc' ? "selected='selected'" : '' ?> value="<?php echo $actual_link . '&sort=prd_price&by=asc' ?>">Giá thấp đến cao</option>
                        </select>
                    </div>
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
                <div>
                    <?= Pagination::getListpage($filter) ?>
                </div>
            </div>
        </div>
        <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>
