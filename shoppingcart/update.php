<?php 
	require_once __DIR__. '/../autoload.php';
	
	// B1 =. Lay id cua sp can them vao gio hang

    if( isset($_GET['qty']))
    {
        $qty = $_GET['qty'];
    }

    if( isset($_GET['idProduct']))
    {
        $id = $_GET['idProduct'];
    }
    $product = DB::fetchOne("products",(int)$id);
    
    if( $product['prd_number'] < $qty )
    {
        echo 0;die;
    }
    
	// B2 
    // Ktra xem da ton tai session['cart'] 


	if(isset($_SESSION['cart']))
    {
        /// da ton tai 
        if(isset($_SESSION['cart'][$id]))
        {
            if( $product['prd_number'] < $qty )
            {
                echo 0;die;
            }
            $_SESSION['cart'][$id]['qty'] = $qty;
            echo 1;die;
        }
    }