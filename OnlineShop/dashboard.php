<?php
    include "connection.php";
    error_reporting(0);
    $id = $_GET['id'];
?>
<html>
    <head>
        <title>Dashboard</title>
        <link rel = "stylesheet" href = "layout.css">
        <link rel = "stylesheet" href = "dashboard.css">
        <script type = "text/javascript" src = "javascript.js"></script>
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "header">
            <label>IndiMart</label>
            <button type = "button" onclick = "logout()">Logout</button>
        </div>
        <div class = "parent">
            <div class = "navigation">
                <input type = "checkbox" style = "display:none;" id = "optbtn" checked>
                <label for = "optbtn"><img src = "Images/optionIcon.png" width="30" height = "30" style="display:none;">
                    <div class = "navItems">
                        <ul style="list-style-type: none;">
                        <a href = "dashboard.php?id=<?php echo $id ?>"><li>Dashboard</li></a>
                            <a href = "profile.php?id=<?php echo $id ?>"><li>Profile</li></a>
                            <a href = "addProduct.php?id=<?php echo $id ?>"><li>Add Product</li></a>
                            <a href = "viewProduct.php?id=<?php echo $id ?>"><li>View Product</li></a>
                            <a href =  "makeOffer.php?id=<?php echo $id ?>"><li>Make Offer</li></a>
                            <a href =  "offeredProduct.php?id=<?php echo $id ?>"><li>Offered Products</li></a>
                            <a href =  "analytics.php?id=<?php echo $id ?>"><li>Analytics</li></a>
                            <a href =  "viewTransaction.php?id=<?php echo $id ?>"><li>View transation</li></a>
                        </ul>
                        <p>
                            Licenced to : Bazar.com<br>
                            version : 1.0<br>
                            Developer : Mukesh Kumar Thakur
                        </p>
                    </div>
                </label>
                
            </div>
            
            <div class = "main">
                <?php
                // Now most viewed product
                    $MV = mysqli_fetch_assoc($conn->query("select name,image,PID from product where sellerId = $id order by viewed desc"));
                    if($MV){
                        echo "
                            <div class = 'most-viewed'>
                            <h3>Most viewed Product</h3><hr>
                            ";?>
                            <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($MV['image']); ?>" style = "margin:20px;width:max-content;height:150px;">
                            <?php
                            echo "
                            <h3 style = 'color:red;'>PID : $MV[PID]</h3>
                            <h3 style = 'color:blue;'>$MV[name]</h3>
                            </div>
                        ";
                    }
                // Products which have availablity less than or = 5
                    $rs = $conn->query("select * from product where sellerId = $id and availablity <= 5");
                    if($rs){
                        if(mysqli_num_rows($rs) > 0){
                            echo "<div class = 'less-product'>";
                            echo "<h3>Product on extinct</h3><hr>";
                            while($row = mysqli_fetch_assoc($rs)){
                                echo "<div class = 'items'>
                                    <p><span>$row[name]</span><br>Available : $row[availablity]</p>
                                    <a href = 'editProduct.php?id=$id&pid=$row[PID]&t=1' onclick = ' return check()'>Update</a>
                                </div>
                                ";
                            }
                            echo "</div>";
                        }
                    }else{
                        die("Server Error");
                    }
                ?>
            </div>
        </div>
        <script>
            function check(){
                return confirm("Are You sure ?");
            }
        </script>
    </body>
</html>