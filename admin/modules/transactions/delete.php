<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    
    try{
        $iddelete = DB::delete('transactions', $id);
        // 
        ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' Xoá Thất Bại  ';
        header("Location: ".baseServerName().'/admin/modules/transactions');exit();
    }catch (\Exception $e)
    {
        dd(" Xoá đơn hàng thất bại  " . $e->getMessage());
    }