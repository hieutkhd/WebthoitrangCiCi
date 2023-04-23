<?php
    require_once __DIR__. '/../autoload.php';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Danh sách giỏ hàng  </title>
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
                    <div class="col-md-12">
                        <section class="box-main1" >
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                            <div class="panel-body">
                                <p> <?= isset($_SESSION['thongbao']) ? $_SESSION['thongbao'] : ''?></p>
                            </div>
                            <div class="panel-footer">
                                <div class="pull-right">
                                    <a href="/pages" class="btn btn-xs btn-danger">Tiếp tục mua hàng </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                       
                        </section>
                        
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>