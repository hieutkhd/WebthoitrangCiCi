<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="/admin"><i class="fa fa-dashboard"></i> <span>Trang chủ</span></a>
            </li>
            <?php if ($_SESSION['admin_level'] == 2) : ?>
            <li class="<?= isset($modules) && $modules == 'users' ? 'active' : ''?>">
                <a href="/admin/modules/users/"><i class="fa fa-user"></i> <span>Thành viên</span></a>
            </li>
            <?php endif; ?>
            <li class="header"> Bài viết </li>
<!--            <li class="--><?//= isset($modules) && $modules == 'cate-posts' ? 'active' : ''?><!--">-->
<!--                <a href="/admin/modules/cate-posts"><i class="fa fa-list"></i> <span>Danh mục</span></a>-->
<!--            </li>-->
            <li class="<?= isset($modules) && $modules == 'posts' ? 'active' : ''?>">
                <a href="/admin/modules/posts"><i class="fa fa-book"></i> <span>Bài viết</span></a>
            </li>
            <li class="header"> Sản phẩm  </li>
            <li class="<?= isset($modules) && $modules == 'cate-products' ? 'active' : ''?>">
                <a href="/admin/modules/cate-products"><i class="fa fa-list"></i> <span>Danh mục</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'size' ? 'active' : ''?>">
                <a href="/admin/modules/size"><i class="fa fa-list"></i> <span>Kích thước</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'color' ? 'active' : ''?>">
                <a href="/admin/modules/color"><i class="fa fa-list"></i> <span>Màu</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'products' ? 'active' : ''?>">
                <a href="/admin/modules/products"><i class="fa fa-book"></i> <span>Sản phẩm</span></a>
            </li>
            <?php if ($_SESSION['admin_level'] == 2) : ?>
            <li class="<?= isset($modules) && $modules == 'transactions' ? 'active' : ''?>">
                <a href="/admin/modules/transactions"><i class="fa fa-book"></i> <span> Đơn hàng </span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'warehouses' ? 'active' : ''?>">
                <a href="/admin/modules/warehouses"><i class="fa fa-book"></i> <span> Quản lý kho </span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'user-contact' ? 'active' : ''?>">
                <a href="/admin/modules/contact"><i class="fa fa-book"></i> <span>Danh sách liên hệ</span></a>
            </li>
            <?php endif; ?>
<!--            <li class="">-->
<!--                <a href="/admin/modules/modules"><i class="fa fa-book"></i> <span>Modules</span></a>-->
<!--            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>