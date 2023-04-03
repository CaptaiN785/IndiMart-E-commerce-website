<?php
    include "connection.php";
    error_reporting(0);
    $id = $_GET['id'];
    $pid = $_GET['pid'];

    $rs = $conn->query("select hide from product where sellerId = $id and PID = $pid");
    if($rs){
        $row = mysqli_fetch_assoc($rs);
        if($row['hide'] == 1){
            $v1 = $conn->query("update product set hide = 0 where sellerId = $id and PID = $pid");
            if($v1){
                echo "
                <script>alert('Product Updated')</script>
                <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
                ";
            }else{
                echo "
                <script>alert('Server Error')</script>
                <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
                ";
            }
        }else
        if($row['hide'] == 0){
            $v1 = $conn->query("update product set hide = 1 where sellerId = $id and PID = $pid");
            if($v1){
                echo "
                <script>alert('Product Updated')</script>
                <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
                ";
            }else{
                echo "
                <script>alert('Server Error')</script>
                <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
                ";
            }

        }else{
            echo "
            <script>alert('Unknown Visiblity')</script>
            <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
        ";
        }
    }else{
        echo "
            <script>alert('Server Failed')</script>
            <meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id'>;
        ";
    }

?>