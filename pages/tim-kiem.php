<?php

    /**
     * gọi file autoload
     */
    require_once __DIR__. '/../autoload.php';
    

    $sql = "SELECT * FROM products WHERE 1";

    $keyword = '';
    if(isset($_GET['keyword']) && $_GET['keyword'] != NULL)
    {
        $keyword = $_GET['keyword'];
        $sql .= " AND prd_name LIKE  '%$keyword%' ";
    }
    $kqtk =  DB::fetchsql($sql);
?>
<?php if(isset($kqtk)  && count($kqtk) > 0):?>
     <ul id="retunrsearch">
        <?php foreach($kqtk as $item) :?>
            <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>" >
                <li class="item-product-search">
                    <img src="/public/uploads/products/<?php echo $item['prd_thunbar'] ?>" alt="" class="pull-left" width="50px" height="50px">
                    <div class="pull-right" style="width: 75%">
                        <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>" title=""><?php echo ColorFind($keyword,$item["prd_name"]); ?></a>
                        <br>
                         <?php if($item['prd_sale']) :?>
                            Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                            Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                        <?php else :?>
                            Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                        <?php endif ;?>
                        <?php if ($item['prd_view'] > 0) : ?>
                            <span class="view"><i class="fa fa-eye"></i> <?php echo $item['prd_view'] ?>
                        <?php endif ;?>
                        <?php if ($item['prd_like'] > 0) : ?>
                            <i class="fa fa-heart-o"></i> <?php echo $item['prd_like'] ?></span>
                        <?php endif ;?>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </a>
        <?php endforeach ; ?>
    </ul>
<?php else : ?>
    <ul id="retunrsearch">
        <li style="color:red;padding: 10px 3px;"> Không có kết quả tìm kiếm </li>
    </ul>
<?php endif ; ?>


