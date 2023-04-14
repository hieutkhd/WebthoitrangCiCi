<?php
    $modules = 'products';
    $title_global = 'Danh Sách Sản Phẩm ';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
        WHERE 1
    ";
    $filter = [];
    $keyword = Input::get('keyword');
    if ( $keyword ) {
        $sql .= ' AND prd_name LIKE "%'.$keyword.'%"' ;
        $filter['keyword'] = $keyword;
    }
    if ( Input::get('description') ) {
        $sql .= ' AND prd_description LIKE "%'.Input::get('description').'%"' ;
        $filter['description'] = Input::get('description');
    }
    if ( Input::get('category') ) {
        $sql .= ' AND prd_category_product_id = '.Input::get('category') ;
        $filter['category'] = Input::get('category');
    }
    if ( Input::get('category') ) {
        $sql .= ' AND prd_category_product_id = '.Input::get('category') ;
        $filter['category'] = Input::get('category');
    }
    if ( Input::get('id') ) {
        $sql .= ' AND products.id = '.Input::get('id') ;
        $filter['id'] = Input::get('id');
    }
    if ( Input::get('price') ) {
        $key = Input::get('price');
        if(array_key_exists($key,$arrayPrice))
        {
            if(count($arrayPrice[$key]) == 2)
            {
                $sql .= ' AND prd_price BETWEEN ' .$arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
            }else 
            {
                $sql .= ' AND prd_price > ' .$arrayPrice[$key] . ' ';
            }
            $filter['price'] = $key;
        }
        
    }
    $sql .= ' ORDER BY id DESC';
    // 
    $products = Pagination::pagination('products',$sql,'page',9);
    $category = DB::query('category_products');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
        <!-- <link rel="stylesheet" href="/public/admin/css/bootstrap-tagsinput.css"> -->
        <style>
            
        </style>
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
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Danh sách sản phẩm </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Bộ Lọc Tìm Kiếm </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="">
                                <div class="form-group col-sm-5">
                                    <input type="text" class="form-control" name="keyword" placeholder=" Tên sản phẩm cần tìm " value="<?= Input::get('keyword') ? Input::get('keyword') : '' ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <select name="category" id="" class="form-control">
                                        <option value="">-- Lọc theo danh mục  --</option>
                                        <?php foreach($category as $cate) :?>
                                            <option value="<?= $cate['id'] ?>" <?= Input::get('category') && Input::get('category') == $cate['id'] ? "selected='selected'" : "" ?>> <?= $cate['cpr_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <select name="price" id="" class="form-control">
                                        <option value="">-- Lọc theo giá   --</option>
                                        <option value="1-3" <?= Input::get('price') == "1-3" ? "selected='selected'" : '' ?>> 1 đến 3tr đồng </option>
                                        <option value="3-5" <?= Input::get('price') == "3-5" ? "selected='selected'" : '' ?>> 3 đến 5tr đồng </option>
                                        <option value="5-7" <?= Input::get('price') == "5-7" ? "selected='selected'" : '' ?>> 5 đến 7tr đồng </option>
                                        <option value="7-10" <?= Input::get('price') == "7-10" ? "selected='selected'" : '' ?>> 7 đến 10tr đồng </option>
                                        <option value="10-15" <?= Input::get('price') == "10-15" ? "selected='selected'" : '' ?>> 10 đến 15tr đồng </option>
                                        <option value="15-20" <?= Input::get('price') == "15-20" ? "selected='selected'" : '' ?>> 15 đến 20tr đồng </option>
                                        <option value="20" <?= Input::get('price') == "20" ? "selected='selected'" : '' ?>> trên 20tr  </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <input type="number" name="id" class="form-control" value="<?= Input::get('id') ?>" placeholder="ID sản phẩm">
                                </div>
                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn btn-xs btn-success">
                                    <a  href="index.php" class="btn btn-xs btn-danger"> Làm mới<a/>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <a href="add.php" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                            <span> Kết quả tìm kiếm : </span>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover border">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Thunbar</th>
                                            <th>Info</th>
                                            <th>Hot</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($products as $pro) :?>
                                            <tr class='<?= $pro['prd_number'] <= 5 ? "bg-danger-nhat" : "" ?>'>
                                                <td><?= $pro['id'] ?></td>
                                                <td><?= $pro['prd_name'] ?></td>
                                                <td>
                                                    <img src="/public/uploads/products/<?= $pro['prd_thunbar'] ?>" alt="<?= $pro['prd_name'] ?>" style="width:50px;height:50px;" class="img img-responsive">
                                                </td>
                                                <td>
                                                    Danh Mục : <span class="label label-success"><?= $pro['cpr_name'] ?></span><br>
                                                    Số Lượng : <b><?= $pro['prd_number'] ?></b> | Sale : <b><?= $pro['prd_sale'] ?> (%) </b><br>
                                                    Giá : <b> <?= formatPrice($pro['prd_price']) ?> đ </b> <?= $pro['prd_sale'] != 0 ? " | <b>".formatPrice($pro['prd_price'],$pro['prd_sale'])." đ</b>" : '' ?>
                                                </td>
                                                <td><a href="hot.php?id=<?= $pro['id'] ?>" class="custome-btn label <?= $pro['prd_hot'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $pro['prd_hot'] == 1 ? 'Hot' : 'None' ?></span></a></td>
                                                <td><a href="active.php?id=<?= $pro['id'] ?>" class="custome-btn label <?= $pro['prd_active'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $pro['prd_active'] == 1 ? 'Active' : 'Hide' ?></span></a></td>
                                                <td>
                                                    <a href="update.php?id=<?= $pro['id'] ?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                    <a href="delete.php?id=<?= $pro['id'] ?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="custome-paginate">
                                <div class="pull-right">
                                    <?php echo Pagination::getListpage($filter) ?>
                                </div>
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
