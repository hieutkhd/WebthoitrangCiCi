<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    try{
        $iddelete = DB::delete('colors',$id);
        // 
        ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' Xoá Thất Bại  ';
        header("Location: ".baseServerName().'/admin/modules/color');exit();
    }catch (\Exception $e)
    {
        dd(" Lỗi Xoá Danh Mục  " . $e->getMessage());
    }
