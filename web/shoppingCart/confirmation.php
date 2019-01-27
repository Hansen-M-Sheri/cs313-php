<?php
include "cart_ajax.php";

if(isset($_POST['streetAddress'])){
    $streetAddress = htmlspecialchars($_POST['streetAddress']);
    $city = htmlspecialchars(['$city']);
    $state = $_POST['$state'];
    $zip = htmlspecialchars($_POST['$zip']);
    $country = $_POST['$country'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation.php</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="script.js"></script>
</head>
<body>

<!-- Nav bar-->
<nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="browseItems.php"><i class="fas fa-book"></i></a>
</nav>
<div class="content" >
    <table class="table">
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
        <?php
        $totalPrice = 0;
        foreach($_SESSION['cart'] as $item){
            $totalPrice += $item['price'];
            //unset($_SESSION['cart']
            ?>

            <tr>
                <td>
                    <span id="title"><?php echo $item['title'] ?></span>
                </td>

                <td>
                    <span id="qty"><?php echo $item['qty'] ?></span>
                </td>
                <td>
                    <span id="price"><?php echo $item['price'] ?></span>
                </td>

            </tr>

        <?php } //end $item ?>
            <!--<tr>
                <td></td>
                <td>
                    <span id="total">Total</span>
                </td>
                <td><span id="totalPrice"><?php echo "$".$totalPrice ?></span></td>
            </tr>-->
    <tr>
        <td>
            <span><?php echo $streetAddress ?></span>
        </td>
    </tr>
        <tr>
            <td>
                <span><?php echo $city ?></span>
            </td>
            <td>
                <span><?php echo $state ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <span><?php echo $zip ?></span>
            </td>
            <td>
                <span><?php echo $country ?></span>
            </td>
        </tr>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>