<?php
    include "connection.php";
    error_reporting(0);
    $cid = $_GET['cid'];
    $pid = $_GET['pid'];

    $sql = "delete from cart where cid = $cid and pid = $pid";

    if($conn->query($sql)){
        echo "<meta http-equiv = 'refresh' content = '0; url = cart.php?cid=$cid'>";
    }
    else{
        echo "<script>alert('Server Error')</script>";
        echo "<meta http-equiv = 'refresh' content = '0; url = cart.php?cid=$cid'>";
    }


?>