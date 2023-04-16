<div class="box-left box-menu" >
    <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
    <ul>
        <?php foreach($categorys as $cate) :?>
            <li class="<?= Input::get('id') == $cate['id'] ? 'active' : '' ?>">
                <a href="/pages/danh-muc-san-pham.php?id=<?= $cate['id'] ?>"> <?= $cate['cpr_name'] ?></a>
            </li>
        <?php endforeach ; ?>
    </ul>
</div>