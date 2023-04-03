<?php
    include "connection.php";
    error_reporting(0);
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        $sid = $_GET['id'];
        $mobile = $_POST['mobile'];
        $email  = $_POST['email'];
        $personalAddress = $_POST['personalAddress'];
        $shopName = $_POST['shopName'];
        $shopCategory = $_POST['shopCategory'];
        $shopAddress = $_POST['shopAddress'];
        $accno = $_POST['accno'];
        $ifsc = $_POST['ifsc'];
        $upi = $_POST['upi'];
        
        $sql = "update users set mobile = '$mobile', email = '$email', personalAddress = '$personalAddress', shopName = '$shopName',".
            "shopCategory = '$shopCategory', shopAddress = '$shopAddress', accno = '$accno', ifsc = '$ifsc', upi = '$upi'";

        if($_FILES["profileImage"]["name"]){
            $profilePhoto = addslashes(file_get_contents($_FILES["profileImage"]["tmp_name"]));    
            $sql = $sql.", profilePhoto = '$profilePhoto'";
        }
        if($_FILES["shopImage"]["name"]){
            $shopPhoto = addslashes(file_get_contents($_FILES["shopImage"]["tmp_name"]));
            $sql = $sql.", shopPhoto = '$shopPhoto'";
        }

        $sql = $sql." where id = $sid";

        $update = $conn->query($sql);
        if($update){
            echo "
                <script>alert('Updated Successfully')</script>
            ";
        }else{
            echo "
                <script>alert('Unable to Update Profile')</script>
            ";
        }

    }

    $rs = $conn->query("select * from users where id = '$id'");
    if(!$rs){
        echo "<script>alert('Server Timeout')</script>";
    }
    $row = mysqli_fetch_assoc($rs);
?>

<html>
    <head>
        <title>Profile</title>
        <link rel = "stylesheet" href = "profile.css">
        <link rel = "stylesheet" href = "layout.css">
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
                <div class = "profile">
                    <form method = "post" enctype="multipart/form-data" action = "?id=<?php echo $id ?>">
                    <h2>Personal Details</h2><hr>
                    <div class="Image">
                        <input type = "file" name = "profileImage" id = "pImage" style = "display: none;" accept="Image/*" onchange="previewProfile()" >
                        <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['profilePhoto']);  ?>" id = "pImageImg" style = "display:block;width:100%;height:100%;">
                        <label for ="pImage" id = "pImageLabel" style = "display:none;">Change</label>
                    </div>
                    Name : <input type = "text" readonly value = "<?php echo $row['name']; ?>"><br>
                    Mobile : <input type = "text" id = "mobile" name = "mobile" readonly value = "<?php echo $row['mobile']  ?>" ><br>
                    Email : <input type="email" id = "email" name = "email" readonly value = "<?php echo $row['email'] ?>"><br>
                    DOB : <input type = "text" readonly value = "<?php echo $row['dob']  ?>"> <br>
                    Address : <br><textarea id = "pAddress" name = "personalAddress" rows = "3" readonly ><?php echo $row['personalAddress']  ?></textarea><br>
                    <hr>
                    <h2>Shop Details</h2>
                    <hr>
                    <div class = "Image">
                        <input type = "file" name = "shopImage" id = "sImage" style = "display: none;" accept="Image/*" onchange="previewShop()">
                        <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['shopPhoto']);  ?>"  id = "sImageImg" style = "width:100%;height:100%;">
                        <label for ="sImage" id = "sImageLabel" style = "display:none;">Change</label>
                    </div>
                    Name : <input type = "text" id = "sName" name = "shopName" readonly value = "<?php echo $row['shopName'] ?>"><br>
                    Category : <input type = "text" id = "sCategory" name = "shopCategory" readonly value = "<?php echo $row['shopCategory'] ?>"><br>
                    GST no : <input type = "text" readonly value = "<?php echo $row['gstNo'] ?>"><br>
                    Establishment : <input type = "text" name = "yoe" readonly value = "<?php echo $row['yoe'] ?>"><br>
                    Address : <br><textarea id = "sAddress" name = "shopAddress" readonly rows = "3" ><?php echo $row['shopAddress'] ?></textarea>
                    <hr><h2>Documentation Detail</h2><hr>
                    Aadhar no : <input type="text" readonly value = "<?php echo $row['aadhar'] ?>"><br>
                    PAN no : <input type = "text" readonly value = "<?php echo $row['pan'] ?>"><br>
                    Account no : <input type = "text" id = "accno" name = "accno" readonly value = "<?php echo $row['accno'] ?>"><br>
                    IFSC code : <input type = "text" id = "ifsc" name = "ifsc" readonly value = "<?php echo $row['ifsc'] ?>"><br>
                    UPI ID : <input type = "text" id = "upi" name = "upi" readonly value = "<?php echo $row['upi'] ?>"><br>
                    <div id = "updateDetails">
                        <button type = "button" onclick = "enableInputs()">Update Details</button>
                    </div>
                    <div id = "submitDetails">
                        <button type = "button" onclick = "back()">Back</button>
                        <input type = "submit" name = "submit" value = "Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function enableInputs(){
                document.getElementById("mobile").readOnly = false;
                document.getElementById("email").readOnly = false;
                document.getElementById("pAddress").readOnly = false;
                document.getElementById("sName").readOnly = false;
                document.getElementById("sCategory").readOnly = false;
                document.getElementById("sAddress").readOnly = false;
                document.getElementById("accno").readOnly = false;
                document.getElementById("ifsc").readOnly = false;
                document.getElementById("upi").readOnly = false;

                document.getElementById("pImageLabel").style.display = "flex";
                document.getElementById("sImageLabel").style.display = "flex";
                document.getElementById("updateDetails").style.display = "none";
                document.getElementById("submitDetails").style.display = "block";
            }
            function back(){
                document.getElementById("mobile").readOnly = true;
                document.getElementById("email").readOnly = true;
                document.getElementById("pAddress").readOnly = true;
                document.getElementById("sName").readOnly = true;
                document.getElementById("sCategory").readOnly = true;
                document.getElementById("sAddress").readOnly = true;
                document.getElementById("accno").readOnly = true;
                document.getElementById("ifsc").readOnly = true;
                document.getElementById("upi").readOnly = true;

                document.getElementById("pImageLabel").style.display = "none";
                document.getElementById("sImageLabel").style.display = "none";
                document.getElementById("updateDetails").style.display = "block";
                document.getElementById("submitDetails").style.display = "none";
            }
            function previewProfile(){
                var file = document.getElementById("pImage").files;
                if(file.length>0){
                    var fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("pImageImg").setAttribute("src", event.target.result);
                    };
                    fileReader.readAsDataURL(file[0]);
                    document.getElementById("pImageImg").style.display = "flex";
                    document.getElementById("Pchange").style.display = "flex";
                }
            }
            function previewShop(){
                var file = document.getElementById("sImage").files;
                if(file.length > 0){
                    var fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("sImageImg").setAttribute("src", event.target.result);
                    };
                    fileReader.readAsDataURL(file[0]);
                    document.getElementById("sImageImg").style.display = "flex";
                    document.getElementById("Schange").style.display = "flex";
                }
            }
            </script>
    </body>
</html>