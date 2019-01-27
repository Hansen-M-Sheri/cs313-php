<?php
session_start();
/**
 * Created by PhpStorm.
 * User: sherihansen
 * Date: 1/26/19
 * Time: 1:25 PM
 *
 * SESSIONS
 *  Start a session as soon as item is added to cart.  Session will store
 * entire cart.  The format for cart is Array{ id=> itemDetails,
 * id2=>itemDetails2.... etc).
 */
if(session_id() == '') {
    session_start();

    //if post is set create the cart and store in sessions
    if(isset($_POST['id'])){
        //create cartArray & store array of items inside of it w/ id being key
        $id = $_POST['id'];
        $cartArray = array(
            $id => array(
                'title'     =>  $_POST['title'],
                'subtitle'  =>  $_POST['subtitle'],
                'price'     =>  $_POST['price'],
                'qty'       =>  $_POST['qty']
            )

        );
        $_SESSION['cart'] = $cartArray;
        echo "Session['cart'] = ";
        echo print_r($cartArray);
        echo "Session_id = ".session_id();
    }
}
else {

    //get cart from sessions
    $cart = $_Session['cart'];
    echo "Stored sessions: ";
    echo print_r($cart);
    //if flag = add
    $isRemove = $_POST['isRemove'];
    $id       = $_POST['id'];
    if(isRemove == false){
        //remove id from cartItems
        unset($_SESSION[$id]);
    }
    else{
        //if id does exists - increase qty
        if($cart[$id] == $id){
            $cart[$id]['qty'] += 1;
        }
        else{
            //if id doesn't exist - push to cart array
            $cart[$id] =  array(
                'title'     =>  $_POST['title'],
                'subtitle'  =>  $_POST['subtitle'],
                'price'     =>  $_POST['price'],
                'qty'       =>  $_POST['qty']
            );
        }

    }
    echo "Updated sessions to store: ";
    echo print_r($cart);
    //update cart with new info
    $_SESSION['cart'] = $cart;
}
//update session data
echo var_dump($_SESSION['cart']);

?>