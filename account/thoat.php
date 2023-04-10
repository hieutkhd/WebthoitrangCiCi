<?php
    require_once __DIR__. '/../autoload.php';
    
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    unset($_SESSION['avatar']);
    unset($_SESSION['phone']);
    unset($_SESSION['address']);
    unset($_SESSION['email']);
    unset($_SESSION['cart']);
    $_SESSION['success'] = ' Đăng xuất thành công ! Cảm ơn bạn đã quan tâm tới website ';
    header("Location: ".baseServerName().'/pages');exit();
    
