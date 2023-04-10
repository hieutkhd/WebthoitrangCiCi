<?php
    require_once __DIR__. '/../autoload.php';
    $navActive = 'gioi-thieu';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $email    = Input::get("email");
        $password = Input::get("password");
        // kiểm tra lỗi
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // kiểm tra nếu k có lỗi thì sẽ không thực hiện
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt
            $check = DB::fetchOne('users', ' email = "'.$email.'" and password = "'.md5($password).'" and status = 1  LIMIT 1');

            if( $check != NULL)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = "Đăng nhập thành công ";
                $_SESSION['id'] = $check['id'];
                $_SESSION['username'] = $check['name'];
                $_SESSION['avatar'] = $check['avatar'];
                $_SESSION['phone'] = $check['phone'];
                $_SESSION['address'] = $check['address'];
                $_SESSION['email'] = $check['email'];
                header("Location: ".baseServerName().'/pages');exit();
            } else {

                $_SESSION['error'] = "Thông tin tài khoản không chuẩn xác hoặc tài khoản của bạn đã bị khóa.";
                header("Location: ".baseServerName().'/account/dang-nhap.php');exit();
            }
            
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Đăng nhập   </title>
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
                        <?php require_once __DIR__.'/../layouts/inc_left.php' ;?>
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
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
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
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>
                    <div class="col-md-9 bor">
                        <!-- SLIDE -->
                        <section style="padding: 20px;">
                            <div class="panel panel-primary">
                                  <div class="panel-heading"> Đăng nhập  </div>
                                  <div class="panel-body">
                                      <form class="form-horizontal" action="" method="POST">
                                       
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Email <span style="color: red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" value="<?= isset($email) ? $email : '' ?>" placeholder=" user@gmail.com" name="email">
                                                <?php if(isset($errors['email'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Password <span style="color: red" >(*)</span></label>
                                            <div class="col-sm-10">          
                                                <input type="password" class="form-control" id="pwd" placeholder="********" name="password">
                                                <?php if(isset($errors['password'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-xs"> Đăng nhập </button>
                                                <a href="/pages/" class="btn btn-danger btn-xs"> Huỷ bỏ  </a>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                        </section>
                    </div>
                </div>

                <div class="container">
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