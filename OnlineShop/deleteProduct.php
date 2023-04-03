<?php
    include "connection.php";
    error_reporting(0);

    $id = $_GET['id'];
    $pid = $_GET['pid'];

    $sql = "delete from product where pid = $pid and sellerId = $id";
    $rs = $conn->query($sql);
    if($rs){
        echo "
            <script>alert('Product deleted successfully')</script>
            <meta http-equiv='refresh' content = '0; url = http://localhost/onlineShop/viewProduct.php?id=$id'>
        ";
    }else{
        echo "
            <script>alert('Server Error!')</script>
            <meta http-equiv = 'refresh' content = '0; url = 'http://localhost/onlineShop/viewProduct.php?id=$id'>
        ";
    }



?>