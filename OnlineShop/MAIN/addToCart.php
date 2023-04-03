<?php
    include "connection.php";
    error_reporting(0);
    $cid = $_GET['cid'];

    if($_GET['pid']){
        // Check for already added content
        $pid = $_GET['pid'];
        if(mysqli_num_rows($conn->query("select * from cart where pid = $pid and cid = $cid")) == 0){
            $sql = "insert into cart(cid, pid, addedOn, quantity) value ($cid, $pid, now(), 1)";
            if($conn->query($sql)){
                // Added to cart
            }else{
                echo "<script>alert('Server Error')</script>";
            }
        }else{
            echo "<script>alert('Already added to cart')</script>";
        }
    }
    echo "<meta http-equiv = 'refresh' content = '0; url = main.php?cid=$cid'>";
?>