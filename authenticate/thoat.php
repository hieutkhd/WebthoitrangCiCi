<?php
    require_once __DIR__. '/../autoload.php';
    
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_level']);
    unset($_SESSION['admin_avatar']);
    $_SESSION['success'] = ' Đăng xuất thành công ! Cảm ơn bạn đã quan tâm tới website ';
    header("Location: ".baseServerName().'/authenticate/login.php');exit();
    
