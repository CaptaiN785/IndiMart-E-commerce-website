<?php
    include "connection.php";
    error_reporting(0);
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $cat = $_POST['category'];
        $subCat = $_POST['subCategory'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $avail = $_POST['availablity'];
        $desc = $_POST['description'];
        $view = 0;
        $hide = 1;
        $sid = $_GET['id'];
        $image = addslashes(file_get_contents($_FILES["pImage"]["tmp_name"]));

        $sql = "insert into product(addedOn, name, category, subCategory, price, discount, description, availablity, viewed, hide, sellerId, image)".
            "values (now(), '$name', '$cat', '$subCat', $price, $discount, '$desc', $avail, $view, $hide, $sid, '$image')";
        
        $rs = $conn->query($sql);

        if(!$rs){
            echo "
                <script>alert('Server Error')</script>
            ";
        }else{
            echo "
                <script>alert('Product Added Successfully')</script>
            ";
        }
    }
?>

<html>
    <head>
        <title>Add Product</title>
        <link rel = "stylesheet" href = "layout.css">
        <link rel = "stylesheet" href = "addProduct.css">
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
                <form autocomplete="off" action="?id=<?php echo $_GET['id'] ?>" enctype="multipart/form-data" method = "post">
                <div class = "product">
                    <h2>Add Product Details</h2><hr><br>
                    <div class = "image">
                        <input required type = "file" name = "pImage" style = "display: none;" id = "pImage" accept = "Images/*" onchange= "previewImage()">
                        <label for = "pImage" id = "sLabel">Select Image</label>
                        <h3 id = "ImgText">Select Product Image of size (N x N) Pixels</h3>
                        <img id = "prImage" style = "width:100%; height:100%; display: none;">
                    </div>
                    <table>
                        <tr>
                            <td>Name </td>
                            <td><input autocomplete="off" type = "text"  name = "name" required placeholder="Product Name"> </td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><input type = "text" name = "category" required placeholder="Category"></td>
                        </tr>
                        <tr>
                            <td>Sub-category</td>
                            <td><input type = "text" name = "subCategory" required placeholder="Sub-cateogry"></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type = "number" name = "price" required placeholder="In rupees"></td>
                        </tr>
                        <tr><td>Discount</td>
                            <td><input type = "number" name = "discount" required placeholder="In %age"></td>
                        </tr>
                        <tr>
                            <td>Availablity</td>
                            <td><input type = "number" name = "availablity" required placeholder="No of Items available"></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>
                                <textarea name = "description" placeholder="About Product"></textarea>
                            </td>
                        </tr>
                    </table>
                    <div class = "btn">
                        <input type = "reset" Value = "Reset">
                        <input type = "submit" value = "Submit" name = "submit" >
                    </div>
                </div>
            </form>
            </div>
        </div>
        <script>
            function logout(){
                window.location.href = "login.php";
            }
            function previewImage(){
                var file = document.getElementById("pImage").files;
                document.getElementById("ImgText").style.display = "none";
                if(file.length>0){
                    var fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("prImage").setAttribute("src", event.target.result);
                    };
                    fileReader.readAsDataURL(file[0]);
                    document.getElementById("prImage").style.display = "flex";
                    document.getElementById("sLabel").innerHTML = "Change";
                }

            }
        </script>
    </body>
</html>