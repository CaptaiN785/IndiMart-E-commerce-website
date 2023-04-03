<!DOCTYPE html>
<?php
    include "connection.php";
    error_reporting(0);
    $cid = $_GET['cid'];
    function func(){
        
    }
?>
<html>
    <head>
        <title>Your Cart</title>
        <link rel = "stylesheet" href = "cart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "head">
            <h1>IndiMart</h1>
            <a href = 'login.php'><i class='fa fa-sign-out'></i></a>
        </div>
        <div class = "main">
            <?php
                $total_cost = 0;
                $total_saving = 0;
                $str = "select distinct p.name,p.image, p.price,p.pid, p.discount, c.quantity from product p, cart c where c.cid = $cid and c.pid = p.pid;";
                $rs = $conn->query($str);
                if(mysqli_num_rows($rs) > 0){
                    echo "<div class = 'content'>";              
                        echo "<a href = 'main.php?cid=$cid'><i class = 'fa fa-angle-left'> Back   </i></a><hr>";
                        while($off = mysqli_fetch_assoc($rs)){
                            $price = $off['price'];
                            $sp = $price - ($off['discount'] * $price)/100;
                            $sp = floor($sp);
                            $total_cost = $total_cost + $sp;
                            $total_saving = $total_saving + ($price - $sp);
                            echo "
                            <div class = 'items'>
                                <div class = 'image'>
                                <a href = 'viewProduct.php?pid=$off[pid]&cid=$cid'>
                            ";
                            ?>
                                <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($off['image']); ?>" style="width:100%;height:100%;">
                            <?php
                            echo "</a>
                            </div>
                            <p>
                                <label>$off[name]</label><br>Price : $sp @ $off[discount]%<br>
                                Quantity : <button onclick='minus($off[pid])'>-</button>
                                <input type = 'number' id = '$off[pid]' name = '$off[pid]' readonly value = '1'>
                                <button onclick='plus($off[pid])'>+</button>
                                <a href = delete.php?cid=$cid&pid=$off[pid] class = 'delete'>Delete</a>
                            </p>
                            </div>
                            ";
                        }
                    ?>
                        <hr>
                        <div class = "order-place">
                            <p>
                                Total cost : <i>₹<?php echo $total_cost; ?></i><br>
                                Total saving : <i>₹<?php echo $total_saving ?></i>
                                </p>
                                <button type = "submit" onclick="func(<?php echo $cid ?>)">Place Order <i class = "fa fa-angle-right"></i></button>
                            </div>
                        </div>
                    <?php
                }else{
                    echo "<label id = 'no'>No items found</label>";
                }
            ?>
        </div>
        <script>
            function plus(id){
                document.getElementById(id).value++;
            }
            function minus(id){
                var qnt= document.getElementById(id);
                if(qnt.value != 1){
                    qnt.value--;
                }
            }
        </script>
    </body>
</html>