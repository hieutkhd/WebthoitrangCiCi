<div id="header">
    <div id="header-top">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-6" id="header-text" style="margin-top: 10px;">
                    <b style="font-family: sans-serif;">GIÀY THỂ THAO UY TÍN, CHẤT LƯỢNG HÀNG ĐẦU TẠI VIỆT NAM</b>
                </div>
                <div class="col-md-6">
                    <nav id="header-nav-top">
                        <ul class="list-inline pull-right" id="headermenu">
                            <?php if(! isset($_SESSION['username'])) :?>
                                <li><a href="/account/dang-ky.php"><i class="fa fa-sign-in"></i> Đăng ký </a></li>
                                <li><a href="/account/dang-nhap.php"><i class="fa fa-lock"></i> Đăng Nhập </a></li>
                                <li><a href="../pages/product_user_like_all.php"><i class="fa fa-head"></i>Sản phẩm yêu thích</a></li>
                            <?php else : ?>
                            <li><a href="../account/user.php"><i class="fa fa-user"></i> <?= $_SESSION['username'] ?></a></li>
                            <li><a href="../pages/product_user_like.php">Sản phẩm đã thích</a></li>
                            <li><a href="/account/thoat.php"><i class="fa fa-share-square-o"></i> Thoát </a></li>
                            <?php endif ;?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="header-main">
            <style type="text/css">
                #suggesstion-box {
                    position: absolute;
                    z-index: 9999999;
                    background: white;
                    border: 1px solid #dedede;
                    width: 77.5%;
                    border-top: 0;
                    height: 400px;
                    overflow-y: auto;
                    display: none;
                }
                #suggesstion-box li { padding: 5px 10px ;border-bottom: 1px solid #dedede }
            </style>
            <script type="text/javascript">
                $(document).ready(function(){

                    $("#header-search").on('keyup keypress blur change', function(){
                        $.ajax({
                        type: "get",
                        url: "/pages/tim-kiem.php",
                        data:'keyword='+$(this).val(),
                        beforeSend: function(){
                            $("#header-search").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function(data){
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html('').append(data);
                            $("#header-search").css("background","#FFF");
                        }
                        });
                    });
                    $('#header-search').blur(function(){
                        $("#suggesstion-box").css("display","none");
                    })
                });
                //To select country name
                function selectCountry(val) {
                    $("#header-search").val(val);
                    $("#suggesstion-box").hide();
                }
            </script>
            <div class="col-md-4">
                <a href="/">
                    <img src="/public/frontend/images/logo-default.png" class="logo-website">
                </a>
            </div>
            <div class="col-md-5">
                <form class="form-inline" id="formtim" action="/pages/tim-kiem-san-pham.php">
                    <div class="form-group">
                        <input type="text" name="keyword" id="header-search" placeholder="Tên sản phẩm " class="form-control">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <div id="suggesstion-box"></div>
            </div>
            <div class="col-md-3" id="header-right">
                <div class="pull-right">
                    <div class="pull-left">
                        <i class="glyphicon glyphicon-phone-alt"></i>
                    </div>
                    <div class="pull-right">
                        <p id="hotline">HOTLINE: 0332823156</p>
                        <p></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>