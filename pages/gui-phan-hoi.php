<?php
    require_once __DIR__. '/../autoload.php';
    $navActive = 'gui-phan-hoi';
    // danh sach sp thuoc danh muc hot 
    $cateHot = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_hot = 1 ORDER BY ID DESC  ");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("name");
        $email    = Input::get("email");
        $content    = Input::get("content");

               // kiểm tra lỗi
        if($name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
       
        if($content == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['content'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'name'     => $name ,
                'email'    => $email,
                'content'  => $content,
            ];
            //tiến hành insert 
            $id_insert = DB::insert('user_contact',$data);

            if($id_insert > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = " Cảm ơn bạn đã quan tâm ! Chúng tối sẽ sớm liên hệ và phản hồi lại thông tin của bạn ";
                header("Location: ".baseServerName().'/pages');exit();
            }
            
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Điền thông tin phản hồi cũng như ý kiến đóng góp  </title>
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
                        <section style="padding: 20px;">
                            <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin-bottom: 20px;"> Gửi phản hồi hay mọi thắc mắc cũng như ý kiến đóng góp   </h2>
                            <div class="panel panel-primary">
                                  <div class="panel-heading"> Điền thông tin đầy đủ  </div>
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
                                            <label class="control-label col-sm-2" for="email"> Nội dung  <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="content" rows="10"><?= isset($content) ? $content : '' ?></textarea>
                                                <?php if(isset($errors['content'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['content'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-xs"> Gửi thông tin  </button>
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