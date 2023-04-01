<?php 
namespace AppView\Utils;
class Cookie
{
    // kiểm tra thông cookie có tồn tại hay không
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }
    // lấy giá trị lưu trong biến cookie
    public static function get($name)
    {
        return $_COOKIE[$name];
    }
    // thêm giá trị vào cookie
    public static function put($name, $value, $expiry)
    {
        if(setcookie($name, $value, time() + $expiry, '/'))
        {
            return true;
        }
        return false;
    }
    // xóa cookie
    public static function delete($name)
    {
        self::put($name, '', time() - 1);
    }
} 