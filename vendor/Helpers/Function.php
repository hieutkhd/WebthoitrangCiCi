<?php 
if ( ! function_exists( 'dd' ))
{
    /**
     * @param $data
     */
    function dd( $data ) {
        echo '<pre class="sf-dump" style=" color: #222; overflow: auto;">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);
        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';
        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }
}

if( ! function_exists('str_slug'))
{
    // convert duong dan than thien
    function str_slug($str,$default = '-') {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/',$default, $str);
        return $str;
    }
}

if ( ! function_exists('formatPrice'))
{
    // dinh dang lai gia tien
    function formatPrice($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return number_format($price, 0,',','.') ;
    }

}
if ( ! function_exists('money'))
{
    // dinh dang lai gia tien
    function money($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return $price;
    }
}

if( ! function_exists( 'baseServerName'))
{
    // duong dan url ban dau
    function baseServerName()
    {
        return 'http://'.$_SERVER["SERVER_NAME"];
    }
}
if ( ! function_exists('redirectUrl'))
{
    function redirectUrl($url = '')
    {
        header("location: ".baseServerName()."{$url}");exit();
    }
}
if ( ! function_exists( 'curPageURL' ))
{
    /**
     * @return string
     * lay duong dan url hien tai
     * VD
     */
    function curPageURL() {
        $pageURL = "http";
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

function ColorFind($string,$fild)
{
    if($string != '')
    {
        return str_replace($string,"<span style='color:red;font-size:14px'>".$string."</span>",$fild);
    }
    else
    {
        return $fild;
    }
}

function sendMail($title, $content, $nTo, $mTo,$diachicc='')
{
    $nFrom = 'NIKE';//mail duoc gui tu dau, thuong de ten cong ty ban
    $mFrom = 'Bachnt21097@gmail.com';  //dia chi email cua ban
    $mPass = '01632823156';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP();
    $mail->CharSet   = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $diachicc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('', '');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}

