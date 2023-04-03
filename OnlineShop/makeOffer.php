<?php
    $id = $_GET['id'];
    include "connection.php";
    error_reporting(0);
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $about = $_POST['about'];
        $avail = $_POST['availablity'];
        $image = addslashes(file_get_contents($_FILES["pImage"]["tmp_name"]));
        $lastDate = $date." ".$time.":00";

        $sql = "insert into offer(sellerId, name, price, discount, startDate, lastDate, about, image, visible, availablity)".
            " value ($id, '$name', $price, $discount, now(), '$lastDate', '$about', '$image', 1, $avail)";
        
        $rs = $conn->query($sql);
        if($rs){
            echo "
                <script>alert('Offer is online')</script>
            ";
        }else{
            echo "
                <script>alert('Server Problem')</script>
            ";
        }


    }


?>
<html>
    <head>
        <title>Offers</title>
        <link rel = "stylesheet" href = "layout.css">
        <link rel = "stylesheet" href = "offer.css">
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
                <h2>Offer Details</h2><hr>
                <form autocomplete = "off" enctype = "multipart/form-data" method = "post" action ="?id=<?php echo $id?>">
                    <div class = "Image">
                        <img id = "image" style ="display:block;width:100%; height:100%;">
                        <input type = "file" name = "pImage" style = "display:none;" id = "pImage" onchange="previewImage()">
                        <label for = "pImage" id = "label"><br><br><br>Select image</label>
                        <label id = "nLabel">Select Product Image</label>
                    </div>
                    <input type = "text" name = "name" required placeholder="Enter product name"><br>
                    <input type = "number" name ="price" required placeholder = "Price"><br>
                    <input type = "number" name = "discount" required placeholder = "Discount more than 30%"><br>
                    <input type = "number" name ="availablity" required placeholder = "No of Products available"><br>
                    Upto Date : <input type = "date" name = "date" required placeholder = "hello"><br>
                    Upto Time : <input type = "time" name = "time" required ><br>
                    <textarea name = "about" placeholder="About Product"></textarea>
                    <div class = "btn">
                        <input type="submit" name ="submit" Value = "Submit">
                    </div>
                </form>
            </div>
        </div>
        <script>
            function previewImage(){
                var file = document.getElementById("pImage").files;
                if(file.length > 0){
                    var fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("image").setAttribute("src", event.target.result);
                    }
                    fileReader.readAsDataURL(file[0]);
                    document.getElementById("image").style.display = "block";
                    document.getElementById("nLabel").style.display = "none";
                }
            }
        </script>
    </body>
</html>