<?php
    require_once __DIR__. '/../autoload.php';
    $filter = [] ;
    // lấy giá trị biến trên url
    $idcate = Input::get('id');
    $parentId = Input::get('parent_id');
    $sort = Input::get('sort');
    $by = Input::get('by');
    // gán vào mảng tìm kiếm
    $filter['id'] = $idcate;
    $filter['parent_id'] = $idcate;
    $filter['sort'] = $sort;
    $filter['by'] = $by;
    // kiểm tra có tồn tại biến sort không thì gán giá trị mặc định
    $orderBy = isset($sort) && !empty($sort) ? $sort : 'id';
    $bys = isset($by) && !empty($by) ? $by : 'desc';

    // nếu tồn tại id danh mục cha thì lấy dữ liệu theo id danh mục cha nếu không tồn tại lấy giá trị id danh mục mặc định
    if (isset($parentId) && !empty($parentId)) {
        $brands = DB::query("category_products","*"," AND cpr_parent_id = ". $parentId ." ORDER BY ID DESC  ");
        $cateParent = DB::fetchOne('category_products', $parentId);
    } else {
        $brands = DB::query("category_products","*"," AND cpr_parent_id = ". $idcate ." ORDER BY ID DESC  ");
        $cateParent = DB::fetchOne('category_products', $idcate);
    }


    // kiểm tra nếu có dữ lệu thuộc danh mục cha và gán vào câu sql
    if (empty($brands)) {
        $sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
        WHERE 1 and products.prd_category_product_id = " . $idcate;

         //  kiểm tra trên url có lọc theo khoảng giá không thì nó sẽ chạy vào câu điều kiện if 
        if( Input::get('price'))
        {
            $key = Input::get('price');
            if(array_key_exists($key,$arrayPrice))
            {
                if(count($arrayPrice[$key]) == 2)
                {
                    $sql .= ' AND prd_price BETWEEN ' .$arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
                }else 
                {
                    $sql .= ' AND prd_price > ' .$arrayPrice[$key][0] . ' ';
                }
            }else 
            {
                $sql .= ' AND prd_price <=  1000000';
            }
            $filter['price'] = $key;
        }

        $sql .= " ORDER BY ". $orderBy . " " . $bys;

    } else {

        $sub = Input::get('sub');
        if (isset($sub) && $sub == 'supcate') {
                $sql = "SELECT products.* , category_products.cpr_name FROM products 
            LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
            WHERE 1 and products.prd_category_product_id = " . $idcate;

            // kiêm tra sắp xếp theo khoảng giá
            if( Input::get('price'))
            {
                $key = Input::get('price');
                if(array_key_exists($key,$arrayPrice))
                {
                    if(count($arrayPrice[$key]) == 2)
                    {
                        $sql .= ' AND prd_price BETWEEN ' .$arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
                    }else 
                    {
                        $sql .= ' AND prd_price > ' .$arrayPrice[$key][0] . ' ';
                    }
                }else 
                {
                    $sql .= ' AND prd_price <=  1000000';
                }
                $filter['price'] = $key;
            }

            $sql .= " ORDER BY ". $orderBy . " " . $bys;

        } else {

            $strId = [$idcate];
            foreach ($brands as $key  => $brand) {
                array_push($strId, $brand['id']);
            }

            $sql = "SELECT products.* , category_products.cpr_name FROM products 
            LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
            WHERE prd_category_product_id in (" . implode(',', $strId) . ")";

            // kiêm tra sắp xếp theo khoảng giá
            if( Input::get('price'))
            {
                
                $key = Input::get('price');
                if(array_key_exists($key,$arrayPrice))
                {
                    if(count($arrayPrice[$key]) == 2)
                    {
                        $sql .= ' AND prd_price BETWEEN ' .$arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
                    }else 
                    {
                        $sql .= ' AND prd_price > ' .$arrayPrice[$key][0] . ' ';
                    }
                }else 
                {
                    $sql .= ' AND prd_price <=  1000000';
                }
                $filter['price'] = $key;
            }

            $sql .= " ORDER BY ". $orderBy . " " . $bys;
        }
    }

    
    $products = Pagination::pagination('products',$sql,'page',12);
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

                        <?php if (!empty($brands)) : ?>
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-cube"></i>
                                Thể loại
                            </h3>
                            <ul>
                                <?php foreach($brands as $key =>  $cate) :?>
                                    <?php
                                        $sql = "SELECT COUNT(id) as number_product FROM products WHERE prd_category_product_id = " . $cate['id'];
                                        $numberProduct = DB::fetchsql($sql);
                                    ?>
                                    <li class="<?= Input::get('id') == $cate['id'] ? 'active' : '' ?>">
                                        <a href="/pages/danh-muc-san-pham.php?id=<?= $cate['id'] ?>&sub=supcate&parent_id=<?= isset($parentId) && !empty($parentId) ? $parentId : $idcate ?>"> <?= $cate['cpr_name'] . ' ('. $numberProduct[0]['number_product'] .')' ?></a>
                                    </li>
                                <?php endforeach ; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-search"></i> Tìm kiếm theo khoảng giá </h3>
                            <ul>
                                <li class="<?= Input::get('price') == '<1' ? 'active' : '' ?>">
                                    <a href="<?= \vendor\Utils\Url::addParams(['price' => '<1']) ?>"> Bé hơn 1tr đồng   </a>
                                </li>
                                <li class="<?= Input::get('price') == '1-3'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '1-3']) ?>"> 1.000.000đ - 3.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '3-5'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '3-5']) ?>"> 3.000.000đ - 5.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '5-7'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '5-7']) ?>"> 5.000.000đ - 7.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '7-10'  ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '7-10']) ?>"> 7.000.000đ - 10.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '10-15' ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '10-15']) ?>"> 10.000.000đ - 15.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '15-20' ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '15-20']) ?>"> 15.000.000đ - 20.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '20'    ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '20']) ?>"> Trên 20.000.000 đ </a></li>
                            </ul>
                        </div>
                        </ul>
                    </div>
                    <div class="col-md-9 bor">
                                              
                        
                        <section class="box-main1">
                            <h3 class="title-main"><a href="javascript:void(0)"> Danh mục sản phẩm |  Có  <?= Pagination::getTotalQuery() ?> kết quả được tìm thấy </a> </h3>
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
                            <div>
                                <?= Pagination::getListpage($filter) ?>
                            </div>
                        </section>

                    </div>
                </div>

                
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>