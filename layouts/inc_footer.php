<div class="container-pluid">
                <section id="footer">
                    <div class="container">
                        <div class="col-md-3" id="shareicon">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8" id="title-block">
                            <div class="pull-left">
                                
                            </div>
                            <div class="pull-right">
                                
                            </div>
                        </div>
                       
                    </div>
                </section>
                <section id="footer-button">
                    <div class="container-pluid">
                        <div class="container">
                            <div class="col-md-3" id="ft-about">
                                
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco </p>
                            </div>
                            <div class="col-md-3 box-footer" >
                                <h3 class="tittle-footer"> Danh mục sản phẩm </h3>
                                <ul>
                                    <?php foreach($categoHot as $item) :?>
                                        <li>
                                            <i class="fa fa-angle-double-right"></i>
                                            <a href="/pages/danh-muc-san-pham.php?id=<?= $item['id'] ?>"><i></i> <?= $item['cpr_name'] ?></a>
                                        </li>
                                    <?php endforeach ; ?>
                                </ul>
                            </div>
                            <div class="col-md-3 box-footer">
                                <h3 class="tittle-footer">my accout</h3>
                               <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="/pages/gioi-thieu.php"><i></i> Giới thiệu</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Liên hệ </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i>  Contact </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> My Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3" id="footer-support">
                                <h3 class="tittle-footer"> Liên hệ</h3>
                                <ul>
                                    <li>
                                        
                                        <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i>230 Nguyễn Ngọc Nại, Thanh Xuân, Hà Nội</p>
                                        <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 0332823156</p>
                                        <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i> bachnt21097@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="ft-bottom">
                    <p class="text-center">Copyright © 2019 . Design by  ... !!! </p>
                </section>
            </div>
        </div>      
    </div>
            </div>      
        </div>
    <script  src="/public/frontend/js/slick.min.js"></script>
    <script  src="/public/app/js/notify.js"></script>
    </body>
    <style type="text/css">
        #left_ads_float{bottom:24px;left: 10px;position:fixed;top: 200px; }
        #right_ads_float{bottom:24px;right: 10px;position:fixed;top: 200px;}
    </style>
    <div id='left_ads_float' class="fix-ads">
        <div>
            <a><img border='0' height='500px' src='/public/images/fptarena1.png' width='100px'/></a>
        </div>
    </div>
    <div id='right_ads_float' class="fix-ads">
        <div>
            <a><img border='0' height='500px;' src='/public/images/fptarena1.png'' width='100px'/></a>
        </div>
    </div>
        
</html>

<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>
<?php
    if( isset($_SESSION['success']))
    {
        $string = $_SESSION['success'];
        unset($_SESSION['success']);
        echo "<script>$.notify('$string','success');</script>";
    }

    if( isset($_SESSION['error']))
    {
        $string = $_SESSION['error'];
        unset($_SESSION['error']);
        echo "<script>$.notify('$string','error');</script>";
    }
?>

<script>
window.onscroll = function() {myFunction()};

    var header = document.getElementById("menunav");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        header.classList.add("sticky");
        $(".fix-ads").css("top","70px")
      } else {
        header.classList.remove("sticky");
        $(".fix-ads").css("top","200px")
      }
    }
    function notificationCart() {
        alert('Bạn không có sản phẩm nào trong giỏ hàng');
        return false;
    }
</script>


<script type="text/javascript">
    $(function(){
        $('#sort_product').change(function () {
            var url = $(this).val();
            window.location.href = url;
        })
    })
</script>