<?php
    require_once __DIR__. '/../autoload.php';
    $id = Input::get('id');
    // lay chi tiet san pham
    $product = DB::fetchOne('products',' id = '. $id .' and prd_active = 1 ' );
    $view = $product['prd_view'] + 1;
    $dataUpdate = ['prd_view' => $view];

    // kiểm tra nếu có tồn tại list danh sách id sản phẩm lưu trong cookie
    if (isset($_COOKIE['productId'])) {
        $listProductId = json_decode($_COOKIE['productId'], true);
        if (!in_array($id, $listProductId)) {
            array_push($listProductId, $id);
        }
        setcookie('productId', json_encode($listProductId), time() + 60*60*24*10);
    } else {
        // nếu không tồn tại sản phẩm lưu trong cookie
        $productId = [$id];
        setcookie('productId', json_encode($productId), time() + 60*60*24*10);
    }

    DB::update('products',$dataUpdate , ' id = '.$id);
    // lay danh sach sản phẩm kèm theo
    $productCategory = DB::query("products","*"," AND prd_active = 1 AND prd_category_product_id = " . $product['prd_category_product_id'] . " ORDER BY RAND()  LIMIT 8  ");

    // lấy danh sách comment của sản phẩm 
    $comment = DB::query('comments' ,'*',' and cmt_product_id = ' .$id . ' ORDER BY ID DESC lIMIT 3' );
    // xử lý comment sản phẩm 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name    = Input::get('cmt_name');
        $content = Input::get('cmt_content');
        $data = 
        [
            'cmt_name'          => $name ,
            'cmt_avatar'        => isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'user-default.jpg',
            'cmt_content'       => $content,
            'cmt_product_id'    => $id 
        ];
        //tiến hành insert 
        $id_insert = DB::insert('comments',$data);

        if($id_insert > 0)
        {
            // insert thanh cong
            // gán session thông báo thành công
            $_SESSION['success'] = "Thêm mới thành công ";
            header("Location: ".'http://'.$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);exit();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>  Chi tiết sản phẩm  </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
    </head>
    <body>
        <div id="wrapper"
>            <!---->
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
                    <section class="box-main1" >
                        <div class="col-md-6 text-center">
                            <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">
                        </div>
                        <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                           <ul id="right">
                                <li><h3 style="border-bottom: 1px solid #dedede;padding-bottom: 10px;"> Tên sản phẩm :  <?= $product['prd_name'] ?> </h3></li>
                                <li><p> Mô tả : <?= $product['prd_description'] ?> </p></li>
                                <li>
                                    <?php if($product['prd_sale']) :?>
                                        <p>Giá cũ : <strike class="sale"><?= formatPrice($product['prd_price']) ?> đ</strike> <b class="price">Giá mới : <?= formatPrice($product['prd_price'],$product['prd_sale']) ?>đ</b></p>
                                    <?php else :?>
                                        <p><b class="price"> Giá sản phẩm : <?= formatPrice($product['prd_price']) ?> đ</b></p>
                                    <?php endif ;?>
                                </li>
                               <li>Số lượng : <span style="color:red"><?= $product['prd_number'] ?></span></li>
                                <li>Tình trạng : <span style="color:red"><?= $product['prd_number'] > 0 ? " Còn hàng "  : " Hết Hàng "?></span></li>
                               <?php
                                   $size = [];
                                   if(!empty($product['pro_size'])) {
                                       $size = explode(',', $product['pro_size']);
                                   }
                               ?>
                               <?php if(!empty($size)) : ?>
                               <li>
                                   Size :
                                   <select name="size" id="size" style="padding: 5px;border-radius: 2px;box-shadow: none;outline: none;width:100px;">
                                       <option value="">Chọn size</option>
                                       <?php foreach ($size as $key => $item) : ?>
                                           <option value="<?= $item ?>"><?= $item ?></option>
                                       <?php endforeach; ?>
                                   </select>
                               </li>
                               <?php endif; ?>
                               <?php
                                   $colors = [];
                                   if(!empty($product['pro_color'])) {
                                       $colors = explode(',', $product['pro_color']);
                                   }
                               ?>
                               <?php if(!empty($colors)) : ?>
                               <li>
                                   Color :
                                   <select name="color" id="color" style="padding: 5px;border-radius: 2px;box-shadow: none;outline: none;width:100px;">
                                       <option value="">Chọn color</option>
                                       <?php foreach ($colors as $key => $item) : ?>
                                           <option value="<?= $item ?>"><?= $item ?></option>
                                       <?php endforeach; ?>
                                   </select>
                               </li>
                               <?php endif; ?>
                                <li>
                                    <a class="btn btn-default add_to_cart" data-id-product=<?= $product['id'] ?>> <i class="fa fa-shopping-basket"></i>Thêm vào giỏ hàng</a>
                                    <input type="number" name="qty" id="qty" style="padding: 5px;border-radius: 2px;box-shadow: none;outline: none;width:100px;" min="1" max="10" value="1">
                                </li>
                           </ul>
                        </div>
                    </section>
                    <div class="col-md-12" id="tabdetail">
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1"> Xem bình luận </a></li>
                                    <li><a data-toggle="tab" href="#menu2"> Hướng dẫn mua hàng  </a></li>
                                    <li><a data-toggle="tab" href="#menu3"> Hướng dẫn thanh toán </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3>Nội dung</h3>
                                        <div>
                                            <?=  $product['prd_content'] ?>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                                            <div id="form-comment" class="col-sm-12">
                                                <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;"> Gủi bình luận của bạn </h5>
                                                <form method="POST" action="">
                                                    <div class="form-group">
                                                        <label for="usr">Họ Tên <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control" id="usr" name="cmt_name" required value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Nội Dung <span style="color: red">*</span></label>
                                                        <textarea name="cmt_content" id="" cols="30" rows="3" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <input type="submit" class="form-control btn btn-xs btn-success" id="pwd" value="&nbsp;Gửi đi" style="width: 30%;">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-12" id="content-comment">
                                                <div class="col-sm-12" id="content-comment" style="margin-top:10px; padding: 0px">
                                                    <div>
                                                        <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;margin-bottom:20px"> Các bình luận khác </h5>
                                                        <!-- Left-aligned media object -->
                                                        <?php if(count($comment) > 0 ) :?>
                                                            <?php foreach($comment as $cmt) :?>
                                                                <div style="margin-bottom:5px;">
                                                                    <div class="media">
                                                                        <div class="media-left">
                                                                            <img src="../public/uploads/users/<?php echo $cmt['cmt_avatar'] ?>" class="media-object" style="width:60px">
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h6 style="font-size:14px;" class="media-heading"><a href="javascript:;void(0)" style="color:red;font-weight:bold"><?= $cmt['cmt_name'] ?></a></h6>
                                                                            <p> <b>Nội dung</b> : <?= $cmt['cmt_content'] ?>.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php endforeach ; ?>
                                                        <?php else : ?>
                                                            <p class="text-danger"> Chưa có bình luận nào !</p>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3 style="margin-bottom: 20px;border-bottom: 1px solid #dedede;padding-bottom: 20px;"> Hướng dẫn mua hàng  </h3>
                                        <ul>
                                            <!-- <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px;">Thanh toán thực tuyến</h5>
                                                <p ">
                                                    - Phương thức thanh toán trực tiếp: Sau khi nhận được hàng mua, doanh nghiệp thương mại thanh toán ngay tiền cho người bán, có thể bằng tiền mặt, bằng tiền cán bộ tạm ứng, bằng chuyển khoản, có thể thanh toán bằng hàng (hàng đổi hàng)…
                                                </p>
                                            </li> -->
                                            <li style="margin-bottom: 20px;"> 
                                               <!--  <h5 style="padding-bottom: 10px;">Thanh toán chậm trả </h5> -->
                                                <p style="font-family: sans-serif; font-size: 14px">
                                                    Hãy chọn sản phẩm mà bạn muốn và thêm vào giỏ hàng sau đó tiến hành thanh toán. Điền đầy đủ thông tin cá nhân của bạn vào form mẫu rồi sau đó ấn xác nhận và hệ thống sẽ thông báo ra cho bạn có đặt hàng thành công hay không.                                              
                                                    Lưu ý: Kiểm tra lại số lượng mà bạn đã đặt để tránh nhầm lẫn nhé
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="menu3" class="tab-pane fade">
                                        <h3 style="margin-bottom: 20px;border-bottom: 1px solid #dedede;padding-bottom: 20px;"> Cách thức thanh toán </h3>
                                        <ul>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px; font-family: sans-serif;">Thanh toán trực tuyến (Đang cập nhật)</h5>
                                                <p style="font-family: sans-serif; font-size: 14px">
                                                    - Phương thức thanh toán trực tiếp: Sau khi nhận được hàng mua, doanh nghiệp thương mại thanh toán ngay tiền cho người bán, có thể bằng tiền mặt, bằng tiền cán bộ tạm ứng, bằng chuyển khoản.
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px; font-family: sans-serif;">Thanh toán trả sau</h5>
                                                <p style="font-family: sans-serif; font-size: 14px">
                                                    - Sau khi bạn đặt hàng thành công chúng tôi sẽ tiếp nhận và xử lý đơn hàng của bạn. Sản phẩm sẽ được chuyển đến bạn trong khoảng thời gian ngắn nhất sau đó. Bạn có thể kiểm tra hàng trước khi giao tiền.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="showitem clearfix">
                        <div class="col-md-9" style="margin-top: 30px; padding: 0px;">
                            <section class="box-main1" style="margin-bottom:50px;">
                                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Sản phẩm liên quan</a> </h3>
                                <div class="showitem clearfix">
                                    <?php foreach($productCategory as $item) :?>
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
                            </section>
                        </div>
                        <div class="col-md-9" style="margin-top: 30px; padding: 0px;">
                            <?php require_once __DIR__.'/../layouts/inc_cookei.php'; ?>
                        </div>
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>