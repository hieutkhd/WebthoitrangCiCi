<?php
    require_once __DIR__. '/../autoload.php';
    $navActive = 'gioi-thieu';
    // danh sach sp thuoc danh muc hot 
    $cateHot = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_hot = 1 ORDER BY ID DESC  ");
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("name");
        $email    = Input::get("email");
        $phone    = Input::get("phone");
        $address  = Input::get("address");
        $password = Input::get("password");
        // kiểm tra lỗi
        if($name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($phone == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['phone'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($address == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['address'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        else
        {
            // check xem email da trung chua
            $emailCheck = DB::fetchOne('users',' email = "'.$email.'"');
            if($emailCheck !== NULL)
            {
                // email trung gan vao error
                $errors['email'] = ' Email đã tồn tại ! ';
            }
        }
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'name'     => $name ,
                'email'    => $email,
                'address'  => $address,
                'phone'    => $phone,
                'password' => md5($password),
                'status'   => 1
            ];
            //tiến hành insert 
            $id_insert = DB::insert('users',$data);

            if($id_insert > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = "Thêm mới thành công ";
                $_SESSION['username'] = $name;
                $_SESSION['id'] = $id_insert;
                header("Location: ".baseServerName().'/pages');exit();
            }
            
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Đăng ký thành viên  </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
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
                        <!-- SLIDE -->
                        <section style="padding: 20px;">
                             <div class="panel panel-primary">
                                  <div class="panel-heading"> Đăng ký thành viên </div>
                                  <div class="panel-body">
                                      <form class="form-horizontal" action="" method="POST">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Họ và Tên <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?= isset($name) ? $name : '' ?>" placeholder=" Họ và tên : Nguyễn Văn A" name="name">
                                                <?php if(isset($errors['name'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
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
                                            <label class="control-label col-sm-2" for="email"> Số điện thoại <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" value="<?= isset($phone) ? $phone : '' ?>" placeholder=" 0986.222.333 " name="phone">
                                                <?php if(isset($errors['phone'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['phone'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Địa chỉ  <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?= isset($address) ? $address : '' ?>" placeholder="" name="address">
                                                <?php if(isset($errors['address'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['address'] ?></span>
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
                                                <button type="submit" class="btn btn-primary btn-xs"> Đăng ký </button>
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