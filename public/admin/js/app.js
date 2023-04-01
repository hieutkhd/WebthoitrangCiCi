var xulyadmin =
{
    // khởi tạo base url
    configSelecter :{
        base_Url: location.origin, // duong dan url 
    },
    init : function () {
        let _this = this;
        _this.previewImg();
        _this.viewOrder(); // chi tiet don hang 
    },
    // hiển thị ảnh khi thêm
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
    //hiển thị danh sách sản phẩm đã đặt
    viewOrder()
    {
        let _this = this;
        $('.item-order').click(function() {
            $id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/admin/modules/transactions/view.php',
                data: { id : $id},
                success: function( msg ) {
                    $("#modal-vieworder").modal({
                        show : true,
                        backdrop : 'static'
                    });
                    $(".admin-order").html('').append(msg);
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });

            // $("#modal-vieworder").html('').append(html);
            
        });
    },
}


$(function () {
    xulyadmin.init();
})