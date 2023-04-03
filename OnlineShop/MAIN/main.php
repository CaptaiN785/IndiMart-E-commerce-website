<?php
    include "connection.php";
    error_reporting(0);
    if($_GET['cid']){
        $cid = $_GET['cid'];
    }else{
        $cid  = -1;
    }
?>
<html>
    <head>
        <title>Bazar.com</title>
        <link rel = "stylesheet" href = "main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type = "text/javascript" src = "main.js"></script>
    </head>
    <body>
        <div class = "header">
            <input type="checkbox" id = "TRY" style = "display:none;">
            <label for = "TRY" id = "optionIcon"><i class = "fa fa-bars"></i></label>
            <a href = "main.php?cid=<?php echo $cid ?>">IndiMart</a>
            <div class = "search-bar">
                <form action = "?cid=<?php echo $cid ?>" method="post">
                <input type = "text" name = "searchText" id = "searchText" placeholder="&#9998; Search..">
                <button type = "submit"><i class = "fa fa-search"></i></button>
                </form>
            </div>
            <div class = "header-link">
                <?php
                    $count = mysqli_fetch_assoc($conn->query("select count(*) as num from cart where cid = $cid"));
                    if($cid == -1){
                        echo "<a href = 'login.php'>Login/Sign Up</a>";
                        echo "<a href = 'login.php'>My orders</a>";
                        echo "<a href = 'login.php'><i class='fa fa-shopping-cart'></i></a>";
                    }else{
                        echo "<a href = 'profile.php?cid=$cid'>Profile</a>";
                        echo "<a href = 'myOrder.php'>My orders</a>";
                        echo "<a href = 'cart.php?cid=$cid'><i class='fa fa-shopping-cart'>
                        ";
                        if($count['num'] > 0){
                            echo "<sup><label id = 'noOfItem'>$count[num]</label></sup>";
                        }
                        echo "
                        </i></a>";
                        echo "<a href = 'login.php'><i class='fa fa-sign-out'></i></a>";
                    }
                ?>
                
            </div>
        </div>  
        <!--  Now content and sidebar part  -->
        <div class = "parent" id = "parent">
            <div class = "sideBar" id = "sideBar">
                <div class = "category">
                    <form action = "?cid=<?php echo $cid ?>" method="post">
                    <h3>Shop by Category</h3><hr>
                    <input type = "submit" name = "laptop" value = "Laptop">
                    <input type = "submit" name = "mobile" value = "Mobile">
                    <input type = "submit" name = "cloth" value = "Cloths">
                    <input type = "submit" name = "headphone" value = "Headphones">
                    <input type = "submit" name = "tv" value = "TV">
                    <input type = "submit" name = "electronics" value = "Electronics">
                    </form>
                </div>
                <!-- Review for the website -->
                <div class = "review">
                    <form>
                    <h3>Review my website</h3><hr>
                    <textarea name = "review" placeholder="Write Your review here"></textarea>
                    <input type = "submit" name = "submit-review" value = "submit">
                    </form>
                </div>
                <!-- Licence part -->
                <p>Licenced to : Bazar.com<br>
                version : 1.0<br>
                Developer : Mukesh Kumar Thakur<br>
                <i class = "fa fa-copyright"> Copyright 2021</i>
                </p>
            </div>
            <!-- Content part -->
            <div class = "content" id = "content"><!-- whole content -->
                <div class = "offer" id = "offer" style = "display:none;">
                    <div class = "title">
                        <h3>Biggest Offer Products</h3><hr>
                    </div>
                    <div class = "item">
                        <?php
                            $res = $conn->query("select * from offer where lastDate >= now() and visible = 1 and availablity > 0");
                            if($res){
                                if(mysqli_num_rows($res) > 0){
                                    while($offer = mysqli_fetch_assoc($res)){
                                        date_default_timezone_set('Asia/Kolkata');
                                        if($offer['availablity'] > 0 && new DateTime($offer['lastDate']) >= new DateTime() && $offer['visible'] == 1){
                                            $sp = $offer['price'] - ($offer['discount']*$offer['price'])/100;
                                            $sp = ceil($sp);
                                            $save = $offer['price'] - $sp;
                                            echo "
                                            <div class = 'product'>
                                            <a href = 'viewProduct.php?oid=$offer[OID]&cid=$cid' target = '_blank'>
                                            <div class = 'image'>
                                                <div class = 'discount'>
                                                    $offer[discount]%off
                                                </div>
                                                ";?>
                                                <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($offer['image']);  ?>" style = 'width:100%;height:100%;'>
                                            <?php echo "
                                            </div>
                                            <h3>$offer[name]</h3>
                                            <p><font size = '3'>Price : ₹$sp <del> ₹$offer[price] </del> save ₹$save<br>Upto : $offer[lastDate]</font></p>
                                            </a>
                                                <div class = 'operation'>
                                                    <a href = 'buyNow.php?oid=$offer[OID]&cid=$cid&type=offer' style = 'background-color: rgb(162, 245, 157);'>Buy Now</a>
                                                </div>
                                            </div>
                                            ";
                                        }else{
                                            echo "<script>alert('No offer Found')</script>";
                                        }
                                    }
                                }
                            }else{
                                echo "
                                    <script>alert('Server Error')</script>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class = "goods" id = "goods" style = "display:none;">
                    <div class = "title">
                        <h3>Best deals for you</h3><hr>
                    </div>
                    <div class = "item">
                        <?php
                            $rs = $conn->query("select * from product where hide = 1 and availablity > 0 order by discount desc");
                            if($rs){
                                if(mysqli_num_rows($rs) > 0){
                                    while($row = mysqli_fetch_assoc($rs)){
                                        $sp = $row['price'] - ($row['discount']*$row['price'])/100;
                                        $sp = ceil($sp);
                                        $save = $row['price'] - $sp;
                                        echo "
                                        <div class = 'product'>
                                        <a href = 'viewProduct.php?pid=$row[PID]&cid=$cid' target = '_blank'>
                                        <div class = 'image'>
                                            ";
                                            if($row['discount'] > 0){
                                                echo "
                                                <div class = 'discount'>
                                                    $row[discount]%off
                                                </div>
                                                ";
                                            }
                                            echo "
                                            ";?>
                                            <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']);  ?>" style = 'width:100%;height:100%;'>
                                        <?php echo "
                                        </div>
                                        <h3>$row[name]</h3>
                                        <p><font size = '3'>Price : ₹$sp <del> ₹$row[price] </del> save ₹$save<br>
                                        ";
                                            if($row['availablity'] > 10){
                                                echo "<font color = 'green'>Available in stock</font>";
                                            }else{
                                                echo "<font color = 'red'>Hurry! only $row[availablity] left</font>";
                                            }
                                        echo "
                                        </font></p>
                                        </a>
                                            <div class = 'operation'>
                                                <a href = 'buyNow.php?pid=$row[PID]&cid=$cid&type=product' style = 'background-color: rgb(162, 245, 157);'>Buy Now</a>
                                                <a href = 'addToCart.php?pid=$row[PID]&cid=$cid'>Add to Cart</a>
                                            </div>
                                        </div>
                                        ";
                                    }
                                }
                            }else{
                                echo "
                                    <script>alert('Server Error')</script>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class = "search-items" id = "search-items">
                    <?php
                        $string = "select * from product where hide = 1 ";
                        // First see the how many category are there
                        if($textArray = $_POST['searchText']){
                            $st = "";
                            $string = $string." and ( ";
                            for($i = 0; $i < strlen($textArray); $i++){
                                $st = $st.$textArray[$i];
                                if($textArray[$i] == " " || $i == strlen($textArray) - 1){
                                    $string = $string."name like '%$st%' or description like '%$st%' ";
                                    if($i != strlen($textArray) - 1){
                                        $string = $string." or ";
                                    }
                                    $st = "";
                                }
                            }
                            $string = $string." )";
                        }else
                        if(isset($_POST['laptop'])){
                            $string = $string."and category = 'laptop' ";
                        }else
                        if(isset($_POST['mobile'])){
                            $string = $string."and category = 'mobile' ";
                        }else
                        if(isset($_POST['cloth'])){
                            $string = $string."and category = 'cloth' ";
                        }else
                        if(isset($_POST['headphone'])){
                            $string = $string."and category = 'headphone' ";
                        }else
                        if(isset($_POST['tv'])){
                            $string = $string."and category = 'tv' ";
                        }else
                        if(isset($_POST['electronics'])){
                            $string = $string."and category = 'electronics' ";
                        }else{
                            echo "
                            <script>
                            document.getElementById('offer').style.display = 'block';
                            document.getElementById('goods').style.display = 'block';
                            document.getElementById('search-items').style.display = 'none';
                            </script>
                            ";
                        }
                        
                        $result = $conn->query($string);
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                while($item = mysqli_fetch_assoc($result)){
                                    $price = $item['price'];
                                    $sp = $item['price'] - ($item['discount']*$price)/100;
                                    $sp = ceil($sp);
                                    $save = $price - $sp;
                                    echo "
                                        <a href = 'viewProduct.php?pid=$item[PID]&cid=$cid'>
                                        <div class = 'cont'>
                                        <div class='photo'>
                                    ";?>
                                    <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($item['image']); ?>" style = "width:100%;height:100%;">
                                    <?php echo "
                                        </div>
                                        <p>
                                            <span>$item[name]</span><br>
                                            Price : ₹$sp @ $item[discount]% save <del>$save</del><br>
                                            ";
                                            if($item['availablity'] >= 10){
                                                echo "<span><font size = '3' color = 'green'>Available in stocks</font></span>";
                                            }else{
                                                echo "<span><font size = '3' color = 'red'>Only $item[availablity] left in stocks</font></span>";
                                            }
                                            echo "
                                            </p>
                                            </div>
                                        </a>
                                        <hr>
                                    ";
                                }
                            }else{
                                echo "
                                    <div class = 'no-match-found'>
                                        <h1>No match found</h1>
                                        <h2>Sorry, We will get this product soon </h2>
                                    </div>
                                ";
                            }
                        }else{
                            echo "<script>alert('Unable to process request')</script>";
                        }
                    ?>                 
                </div>
            </div>
        </div>
    </body>
</html>