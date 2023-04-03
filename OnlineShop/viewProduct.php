<?php
    $id = $_GET['id'];
?>
<html>
    <head>
        <title>View Product</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" href = "layout.css">
        <link rel = "stylesheet" href = "viewProduct.css">
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
                include "connection.php";
                error_reporting(0);
                $id = $_GET['id'];
                $sql = "select * from product where sellerId = $id order by addedOn desc";
                
                $rs = $conn->query($sql);
                if($rs){
                    if(mysqli_num_rows($rs) > 0){
                        while($row = mysqli_fetch_assoc($rs)){
                            $sp = $row['price'] - ($row['discount']/100)*$row['price'];
                            $sp = ceil($sp);
                            $save = $row['price'] - $sp;
                            echo "
                            <div class = 'items' id = 'items'>
                                <div class = 'Image'>
                                ";
                                ?>
                                    <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']); ?>" style = "width:100%;height:100%;">
                                <?php
                                echo "
                                    </div>
                                    <h3>$row[name]</h3>
                                    <p> 
                                        ID : $row[PID]<br>
                                        Price : ₹$row[price] @ Discount : $row[discount]%<br>
                                        Category : $row[category] and Sub-Category : $row[subCategory]<br>
                                        Added on : $row[addedOn]<br><br>
                                        Description : $row[description]
                                    </p>
                                    <div class = 'operation'>
                                        ";
                                        if($row['hide'] == 1){
                                            echo "<a href = 'visibleProduct.php?id=$id&pid=$row[PID]' style = 'background-color:crimson;'>Hide</a>";
                                        }else{
                                            echo "<a href = 'visibleProduct.php?id=$id&pid=$row[PID]' style = 'background-color:orangered;'>Show</a>";
                                        }
                                        echo "
                                        <a href = 'editProduct.php?id=$id&pid=$row[PID]&t=0' id='edit' onclick = ' return check()'>Edit</a>
                                        <a href = 'deleteProduct.php?id=$id&pid=$row[PID]' onclick = ' return check()'>Delete</a>

                                    </div>
                                </div>
                            ";
                        }
                    }else{
                        echo "
                            <script>alert('No Product found!')</script>
                        ";
                    }
                }else{
                    echo "
                        <script>alert('Server Error !')</script>
                    ";
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