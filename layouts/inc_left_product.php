<?php if (count($productView) > 0) :?>
<div class="box-left box-menu">
    <h3 class="box-title title-new" style="position: relative; font-family: sans-serif; ">
        <i class="fa fa-warning"></i>  Xu hướng tìm kiếm
        <img src="/public/images/new_neeraj.gif">
    </h3>
    <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
    <ul>
        <?php foreach($productView as $item) :?>
            <li class="clearfix">
                <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                    <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                    <div class="info pull-right">
                        <p class="name"> <?= $item['prd_name'] ?> </p >
                        <?php if($item['prd_sale']) :?>
                            Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                            Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                        <?php else :?>
                            Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                        <?php endif ;?>
                        <span class="view">
                            <?php if ($item['prd_view'] > 0) : ?>
                                <i class="fa fa-eye"></i> <?php echo $item['prd_view'] ?>
                            <?php endif ;?>
                            <?php if ($item['prd_like'] > 0) : ?>
                                <i class="fa fa-heart-o"></i> <?php echo $item['prd_like'] ?>
                            <?php endif ;?>
                        </span>
                    </div>
                </a>
            </li>
        <?php endforeach ; ?>
    </ul>
    <!-- </marquee> -->
</div>
<?php endif; ?>

<div class="box-left box-menu">
    <h3 class="box-title title-new" style="position: relative;">
        <i class="fa fa-warning"></i>  Sản phẩm mới
        <img src="/public/images/new_neeraj.gif">
    </h3>
    <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
    <ul>
        <?php foreach($productNew as $item) :?>
            <li class="clearfix">
                <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                    <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                    <div class="info pull-right">
                        <p class="name"> <?= $item['prd_name'] ?> </p >
                        <?php if($item['prd_sale']) :?>
                            Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                            Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                        <?php else :?>
                            Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                        <?php endif ;?>
                        <span class="view">
                            <?php if ($item['prd_view'] > 0) : ?>
                                <i class="fa fa-eye"></i> <?php echo $item['prd_view'] ?>
                            <?php endif ;?>
                            <?php if ($item['prd_like'] > 0) : ?>
                                <i class="fa fa-heart-o"></i> <?php echo $item['prd_like'] ?>
                            <?php endif ;?>
                        </span>
                    </div>
                </a>
            </li>
        <?php endforeach ; ?>
    </ul>
    <!-- </marquee> -->
</div>

<div class="box-left box-menu">
    <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm HOT 
      <img src="/public/images/new_neeraj.gif">
     </h3>
    <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
    <ul>
        <?php foreach($productHot as $item) :?>
            <li class="clearfix">
                <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                    <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                    <div class="info pull-right">
                        <p class="name"> <?= $item['prd_name'] ?> </p >
                        <?php if($item['prd_sale']) :?>
                            Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                            Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                        <?php else :?>
                            Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                        <?php endif ;?>
                        <span class="view">
                            <?php if ($item['prd_view'] > 0) : ?>
                                <i class="fa fa-eye"></i> <?php echo $item['prd_view'] ?>
                            <?php endif ;?>
                            <?php if ($item['prd_like'] > 0) : ?>
                                <i class="fa fa-heart-o"></i> <?php echo $item['prd_like'] ?>
                            <?php endif ;?>
                        </span>
                    </div>
                </a>
            </li>
        <?php endforeach ; ?>
    </ul>
    <!-- </marquee> -->
</div>