<?php 
namespace AppView\Utils;
class Session
{
    // kiểm tra có session hay k
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }
    // lấy giá trị session
    public static function get($name)
    {
        return $_SESSION[$name];
    }
    // xóa session
    public static function delete($name)
    {
        if(self::exists($name))
        {
            unset($_SESSION[$name]);
        }
    }
    // thêm giá trị vào session
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    //kiểm tra có session hay không nếu không có nó sẽ khởi tạo luôn biến session
    public static function flash($name, $string=null)
    {
        if(self::exists($name))
        {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else
        {
            self::put($name, $string);
        }
        return '';
    }

}