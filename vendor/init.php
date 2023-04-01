<?php
    require_once __DIR__."/Helpers/phpmailer_helper.php";
    require_once __DIR__."/Helpers/smtp_helper.php";
	require_once __DIR__."/Helpers/Function.php";
	require_once __DIR__."/Utils/Cookies.php";
	require_once __DIR__."/Utils/Input.php";
    require_once __DIR__."/Utils/Session.php";
    require_once __DIR__."/Utils/Url.php";
	require_once __DIR__."/Models/DB.php";	
    require_once __DIR__."/Models/Pagination.php";


    require_once __DIR__."/Helpers/PHPMailer/src/PHPMailer.php";
    require_once __DIR__."/Helpers/PHPMailer/src/Exception.php";
    require_once __DIR__."/Helpers/PHPMailer/src/OAuth.php";
    require_once __DIR__."/Helpers/PHPMailer/src/POP3.php";
    require_once __DIR__."/Helpers/PHPMailer/src/SMTP.php";

    require_once __DIR__."/Models/SendMail.php";

?>