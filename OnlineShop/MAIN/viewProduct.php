<?php
    error_reporting(0);
    $cid = $_GET['cid'];
    $type = 0;
    if($_GET['pid']){
        $id = $_GET['pid'];
        $type = 1;
    }elseif($_GET['oid']){
        $id = $_GET['oid'];
        $type = 0;
    }
    
    
?>
<html>
    <head>
    <title>View Products</title>
        <link rel = "stylesheet" href = "viewProduct.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "head">
            <h1>IndiMart</h1>
            <a href = 'login.php'><i class='fa fa-sign-out'></i></a>
        </div>
        <div class = 'main'>
        <?php
            include "connection.php";
            if($type == 1){
                $sql = "select * from product where PID = $id";
                $rs = mysqli_fetch_assoc($conn->query($sql));
                $price = $rs['price'];
                $sp = $price - ($rs['discount'] * $price)/100;
                $sp = ceil($sp);
                $save = $price - $sp;
                echo "
                    <div class = 'image-frame'>
                ";?>
                <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($rs['image']);  ?>" style = "width:100%;height:max-content;max-height:600px;"><?php
                echo "</div>";
                echo "
                    <div class = 'item'>
                        <h1>$rs[name]</h1>
                        <h3><i>Price : ₹$sp saved <del>₹$save</del></i></h3>
                        <h3>Discount : $rs[discount]%</h3>
                        <h3>Category : $rs[category]</h3>
                        <h3>Sub-Category : $rs[subCategory]</h3>
                        ";
                            if($rs['availablity'] > 10){
                                echo "<h3><font color= 'green'>Available in stocks</font></h3>";
                            }else{
                                echo "<h3><font color= 'red'>Hurry! only $rs[availablity] left</font></h3>";
                            }
                            $seller = mysqli_fetch_assoc($conn->query("select shopName,shopAddress from users where id = $rs[sellerId]"));
                            echo "<h3>Seller : $seller[shopName]</h3>";
                            echo "<p>Seller Address: $seller[shopAddress]</p>";
                        echo "
                            <p>Description : $rs[description]</p>   
                    </div>
                    ";
                echo "<div class = 'btn'>
                    <a href = 'buyNow.php?cid=$cid&pid=$rs[PID]&type=product'>Buy Now</a>
                    <a href = 'addToCart.php?cid=$cid&pid=$rs[PID]'>Add to cart</a>
                </div>
                ";
                $conn->query("update product set viewed = viewed + 1 where PID = $id");
            }else{
                $str = "select * from offer where oid = $id";
                $res = $conn->query($str);
                if($res){
                    $row = mysqli_fetch_assoc($res);
                    $price = $row['price'];
                    $sp = $price - ($row['discount'] * $price)/100;
                    $sp = ceil($sp);
                    $save = $price - $sp;
                    echo "
                        <div class = 'image-frame'>
                    ";?>
                    <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']);  ?>" style = "width:100%;height:max-content;max-height:600px;"><?php
                    echo "</div>";
                    echo "
                    <div class = 'item'>
                        <h1>$row[name]</h1>
                        <h3><i>Price : ₹$sp saved <del>₹$save</del></i></h3>
                        <h3>Discount : $row[discount]%</h3>
                        <h3><font color = 'red'>Last Date : $row[lastDate]</font></h3>
                        ";
                            if($row['availablity'] > 10){
                                echo "<h3><font color= 'green'>Available in stocks</font></h3>";
                            }else{
                                echo "<h3><font color= 'red'>Hurry! only $row[availablity] left</font></h3>";
                            }
                            $seller = mysqli_fetch_assoc($conn->query("select shopName,shopAddress from users where id = $row[sellerId]"));
                            echo "<h3>Seller : $seller[shopName]</h3>";
                            echo "<p>Seller Address: $seller[shopAddress]</p>";
                        echo "
                            <p>Description : $row[about]</p>   
                    </div>
                    ";
                    echo "<div class = 'btn'>
                        <a href = 'buyNow.php?cid=$cid&oid=$row[OID]&type=offer'>Buy Now</a>
                    </div>
                    ";
                }
            }
        ?>
        </div>
    </body>
</html>