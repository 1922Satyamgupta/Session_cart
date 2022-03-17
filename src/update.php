<?php 
    if(isset($_POST["submit"])){
        $id=$_POST["Prodid"];
        $qty=$_POST["qty-".$id];
        header("Location:addToCart.php?id=$id&qty=$qty&action=update");
    }
?>