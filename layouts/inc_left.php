<div class="box-left box-menu" >
    <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
    <ul>
        <?php foreach($categorys as $cate) :?>
            <?php
                $brands = DB::query("category_products","*"," AND cpr_parent_id = ". $cate['id'] ." ORDER BY ID DESC  ");

                $strId = [$cate['id']];

                foreach ($brands as $key  => $brand) {
                    array_push($strId, $brand['id']);
                }
                $sql = "SELECT id FROM products WHERE prd_category_product_id IN (" . implode(',', $strId) . ")";
                $checkDataCate = DB::fetchsql($sql)
            ?>
            <?php if (!empty($checkDataCate)): ?>
            <li class="<?= Input::get('id') == $cate['id'] ? 'active' : '' ?>">
                <a href="/pages/danh-muc-san-pham.php?id=<?= $cate['id'] ?>"> <?= $cate['cpr_name'] ?></a>
            </li>
            <?php endif; ?>
        <?php endforeach ; ?>
    </ul>
</div>