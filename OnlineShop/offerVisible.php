<?php
    include "connection.php";
    error_reporting(0);

    $id = $_GET['id'];
    $oid = $_GET['oid'];

    $rs = $conn->query("select visible from offer where sellerId = $id and OID = $oid");
    if($rs){
        $row = mysqli_fetch_assoc($rs);
        if($row['visible'] == 1){
            $v1 = $conn->query("update offer set visible = 0 where sellerId = $id and OID = $oid");
            if($v1){
                echo "
                <script>alert('Product Updated')</script>
                <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
                ";
            }else{
                echo "
                <script>alert('Server Error')</script>
                <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
                ";
            }
        }else
        if($row['visible'] == 0){
            $v1 = $conn->query("update offer set visible = 1 where sellerId = $id and OID = $oid");
            if($v1){
                echo "
                <script>alert('Product Updated')</script>
                <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
                ";
            }else{
                echo "
                <script>alert('Server Error')</script>
                <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
                ";
            }

        }else{
            echo "
            <script>alert('Unknown Visiblity')</script>
            <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
        ";
        }
    }else{
        echo "
            <script>alert('Server Failed')</script>
            <meta http-equiv = 'refresh' content = '0; url = offeredProduct.php?id=$id'>;
        ";
    }

?>