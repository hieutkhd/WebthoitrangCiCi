<?php
$modules = 'posts';
$title_global = 'Cập nhật bài viết';
require_once __DIR__ .'/../../autoload.php';
$id = Input::get('id');
$post = DB::fetchOne('posts', intval($id));
if( ! $post )
{
    $_SESSION['error'] = "  Không tồn tại dữ liệu ";
    header("Location: ".baseServerName().'/admin/modules/posts');exit();
}

// kiem tra neu submit
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $name            = Input::get("p_title");
    $description     = Input::get("p_description");
    $content         = Input::get('p_content');
    // bat loi
    $errors['name']          = $name == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
    $errors['p_description'] = $description == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
    $errors['content']       = $content == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
    if ( isset ($_FILES['p_thunbar']) && $_FILES['p_thunbar']['name'] != NULL )
    {
        $file_name = $_FILES['p_thunbar']['name'];
        $file_tmp  = $_FILES['p_thunbar']['tmp_name'];
        $file_type = $_FILES['p_thunbar']['type'];
        $file_erro = $_FILES['p_thunbar']['error'];
        if ($file_erro == 0)
        {
            $hinhanh = $file_name;
            $_SESSION['p_thunbar'] = $hinhanh;
            move_uploaded_file($file_tmp,UPLOADS.'/posts/'.$hinhanh);
        }else
        {
            $hinhanh = $post['p_thunbar'];
        }
    }else
    {
        $hinhanh = $post['p_thunbar'];
    }

    //  chuyen doi mang chi muc - loai bo key trung nhau
    if( isset ($errors ))
    {
        $errors = (array_unique(array_values($errors)));
    }

    // neu bien errors  thi ko co loi tien hanh insert
    if ( count($errors) == 1)
    {
        // gán vào 1 mảng giá trị để insertt
        $data =
            [
                'p_title'                   => $name ,
                'p_slug'                    => str_slug($name),
                'p_descriptions'             => $description,
                'p_thunbar'                 => $hinhanh,
                'p_content'                 => $content,
                'p_admin_id'                   => 1
            ];

        //tiến hành insert
        $id_update = DB::update('posts',$data , ' id = '.$id);

        if($id_update > 0)
        {
            // insert thanh cong
            // gán session thông báo thành công
            //chuyển về trang index trong thư mục category_products
            $_SESSION['success'] = "Thêm mới thành công ";
            header("Location: ".baseServerName().'/admin/modules/posts');exit();
        }
        else
        {
            // gán session thông báo thất bại
            // giữ nguyên trang để nhập lai
            $_SESSION['error'] = "Chỉnh sửa thất bại ";
            header("Location: ".baseServerName().'/admin/modules/posts');exit();
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
    <script type="text/javascript" src="/public/admin/ckeditor/ckeditor.js"></script>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <?php require_once __DIR__ .'/../../layouts/inc_header.php'; ?>
    <!-- ======================HEADER========================= -->
    <?php require_once __DIR__ .'/../../layouts/inc_sidebar.php'; ?>
    <!-- =======================SIDEBAR======================== -->
    <!-- ======================= CONTENT======================== -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <?= isset($title_global) ? $title_global : '' ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Sản phẩm </a></li>
                <li class="active">Chỉnh sửa</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <div class="box box-primary">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Thunbar   </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="p_thunbar" id="imgInp">
                                            <?php if( isset( $errors['p_thunbar']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['p_thunbar'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                            <img onerror="this.src ='/public/uploads/posts/<?= isset($post['p_thunbar']) ? $post['p_thunbar'] : 'default-image.jpg' ?>'" src="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Tiêu đề </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="p_title" value="<?= $post['p_title'] ?>"  placeholder=" Tên sản phẩm không quá 200 từ" autocomplete="off">
                                            <?php if( isset( $errors['name']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Description </label>
                                        <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                            <textarea name="p_description"  cols="10" rows="5" class="form-control" placeholder=" Mô tả ngắn về nội dung bài viết , không quá 250 ký tự"><?= $post['p_descriptions'] ?></textarea>
                                            <?php if( isset( $errors['p_description']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['p_description'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin:5px 0">
                                <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;"> Nội dung </label>
                                <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                    <textarea name="p_content" id="my-editor" cols="10" rows="10" class="form-control" placeholder=" Mời bạn nhập nội dung bài viết "><?= $post['p_content'] ?></textarea>
                                    <?php if( isset( $errors['content']) ): ?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['content'] ?></span>
                                    <?php endif ; ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <!-- /.box-body -->
                            <div class="" style="position: fixed;right: 15px;top: 50%;transform: translateY(-50%);">
                                <button type="submit" class="btn btn-primary btn-xs" style="width: 75px"> Cập nhật </button><br>
                                <a href="index.php" class="btn btn-danger btn-xs" style="width: 75px"> Huỷ bỏ </a>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
    </div>
    <!-- =======================END CONTENT======================== -->
    <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
</div>
<?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
<script type="text/javascript">
    CKEDITOR.replace( 'my-editor', {
        height:'400px'
    });
</script>