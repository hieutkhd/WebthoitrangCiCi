var frontend = {

    // khởi tạo base url

    configSelecter :{
        base_Url: location.origin, // duong dan url 
    },
    init : function () {
        let _this = this;
        _this.addCart();
        _this.updateCart();
        _this.removeItemCart();
        _this.clickItemResultSearch();
        _this.addFavorite() ; // them san pham yeu thich
        _this.previewImg();
        _this.viewOrder();
    },
    // hàm thêm sản phẩm vào giỏ hàng
    addCart()
    {
        let _this = this;
        $(".add_to_cart").click( function () {
            let $idProduct = $(this).attr("data-id-product");
            let $qty = $("#qty").val() == undefined ? 1 : $("#qty").val();
            let $size =  $("#size").val() == undefined ? '' : $("#size").val();
            let $color =  $("#color").val() == undefined ? '' : $("#color").val();
            if ($("#size").val() !== undefined) {
                if ($size == '') {
                    $.notify('Bạn cần chọn size sản phẩm','error');
                    return false;
                }
            }

            if ($("#color").val() !== undefined) {
                if ($color == '') {
                    $.notify('Bạn cần chọn màu cho sản phẩm sản phẩm','error');
                    return false;
                }
            }
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/add.php',
                async:true,
                dataType:'json',
                data: { idProduct : $idProduct, qty : $qty , size : $size, color : $color},
                success: function( msg ) {
                    console.log(msg)
                    if( msg.status == 1)
                    {
                        var menu_cart = '<span class="">'+ msg.qty +'</span>'
                        $('.cart-items-count').html(menu_cart);
                        $.notify(' Thêm vào giỏ hàng thành công ','success');
                        return false;

                    } else {
                        $.notify('Thêm vào giỏ hàng thất bại. Số lượng sản phẩm không đủ ','error');
                    }

                    return false;
                },
                error : function (erros) {
                    console.log(erros + " LOI AJAX ");
                }
            });
        })
    },
    // xóa sản phẩm trong giỏ hàng
    removeItemCart()
    {
        let _this = this;
        $(".remove-item-cart").click(function(){
            console.log(location.href);
            $this = $(this);
            $key = $(this).attr('data-id-product');
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/remove.php',
                data: { idProduct : $key},
                success: function( msg ) {
                    var url = _this.configSelecter.base_Url + '/shoppingcart/danh-sach-gio-hang.php';
                    if( msg == 1)
                    {
                        $this.parents('.delete_tr').remove();
                        $.notify(' Xoá sản phẩm thành công ','success');
                    }else 
                    {
                        $.notify(' Xoá sản phẩm trong giỏ hàng thất bại ','error'); 
                    }
                    window.location.href = url;
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
            console.log($key);
        })
    
    },
    // cập nhật thông tin giỏ hàng
    updateCart()
    {
        let _this = this;
        $(".update-item-cart").click(function(){
            $this = $(this);
            $key = $(this).attr('data-id-product');
            $qty = $this.parents('.delete_tr').find('#qty').val();
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/update.php',
                data: { idProduct : $key , qty : $qty},
                success: function( msg ) {
                    var url = _this.configSelecter.base_Url + '/shoppingcart/danh-sach-gio-hang.php';

                    if( msg == 1)
                    {
                        $.notify(' Cập nhật thành công ','success');
                    }else 
                    {
                        $.notify(' Cập nhật qty trong giỏ hàng thất bại ','error'); 
                    }

                    window.location.href = url;
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            })
        });
    },
    clickItemResultSearch()
    {
        $(document).on("click",".item-product-search" , function(){
            console.log("OK");  
        })
        $(".item-product-search").on("click",function(){
            
        })
    },
    currency(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    },
    // like sản phẩm
    addFavorite()
    {
        let _this = this;
        $(".addFavorite").click(function () {

            $id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/favorite/add.php',
                async:true,
                dataType:'json',
                data: { idProduct : $id},
                success: function( result ) {
                    if (result.status == 0) {
                        alert('Bạn cần đăng nhập để xử dụng tính năng này');
                    } else if (result.status == 1) {
                        alert('Thêm thành công sản phẩm yêu thích');
                    } else {
                        alert('Bạn đã thích sản phẩm')
                    }
                },
                error : function (error) {
                    console.log(" LOI AJAX " + error);
                }
            })
        })
    },
    //hiển thị ảnh khi update thông tin user
    previewImg()
    {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
    },
    // hiển thị danh sách sản phẩm đã đặt
    viewOrder()
    {
        let _this = this;
        $('.item-order').click(function() {

            var id = $(this).attr('data-id');
            var url = _this.configSelecter.base_Url + '/shoppingcart/view.php';

            $.ajax({
                type: "GET",
                url:  url,
                data: { id : id},
                success: function( msg ) {
                    $("#modal-vieworder").modal({
                        show : true,
                        backdrop : 'static'
                    });
                    $("#order-content").html('').append(msg);
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        });
    },
}

$(function () {
    frontend.init()
})
