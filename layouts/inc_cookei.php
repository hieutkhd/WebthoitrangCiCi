<section class="box-main1" style="margin-bottom:50px;">
    <?php if(isset($_COOKIE['productId']) && !empty($productDataCookei)) : ?>
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Sản phẩm vừa xem  </a> </h3>
        <div class="showitem clearfix">
            <?php foreach($productDataCookei as $item) :?>
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
                        <p><a href="javascript:;void(0)" class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                        <p><a href="javascript:;void(0)" class="add_to_cart" data-id-product=<?= $item['id'] ?>> <i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>
            <?php endforeach ; ?>
        </div>
    <?php endif; ?>
</section>