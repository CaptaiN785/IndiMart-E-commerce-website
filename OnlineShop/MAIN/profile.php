<?php
    $cid = $_GET['cid'];
    include "connection.php";
    error_reporting(0);
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $str = "update customer set name = '$name', email = '$email', mobile = '$mobile', address = '$address' ";
        if($_FILES["pImage"]["name"]){
            $image = addslashes(file_get_contents($_FILES["pImage"]["tmp_name"]));
            $str = $str.", image = '$image' ";
        }
        $str = $str."where cid = $cid";
        if($conn->query($str)){
            echo "
                <script> alert('Profile Updated successfully')</script>
            ";
        }else{
            echo "<script>alert('Unable to update profile')</script>";

        }
    }
    $sql = "select * from customer where cid = $cid";
    $row = mysqli_fetch_assoc($conn->query($sql));
?>
<html>
    <head>
        <title>Profile</title>
        <link rel = "stylesheet" href = "profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "head">
            <h1>IndiMart</h1>
        </div>
        <form autocomplete="off" action="" method = "post" enctype="multipart/form-data">
        <div class = "main">
            <div class = "btn">
                <button type = "button"><a href = "main.php?cid=<?php echo $cid ?>"><  Back</a></button>
                <button type = "submit" name = "update">Update profile</button>
            </div>
            <div class = "image-frame">
                <div class = "image">
                    <input type = "file" id = "pImage" name = "pImage" style = "display:none;" onchange="preview()">
                    <label for = "pImage"><i class = "fa fa-camera"></i></label>
                    <?php
                        if($row['image']){
                            ?>
                            <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']);  ?>" id = "photo" style = "width:100%; height:100%;">
                            <?php
                        }else{
                            ?>
                            <img src = "images/avatar.png" id = "photo" style = "width:100%; height:100%;"><?php
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class = "info">
                Name : <input type = "text" name = "name" id = "name" required placeholder="Enter name" readonly value = "<?php echo $row['name'] ?>">
                <i class = "fa fa-edit" onclick = "enable('name')"></i><br>
                Email : <input type = "email" name = "email" id = "email" required placeholder = "Email" readonly value = "<?php echo $row['email'] ?>">
                <i class = "fa fa-edit" onclick = "enable('email')"></i><br>
                Mobile : <input type = "text" name = "mobile" id = "mobile" required placeholder="Mobile number" readonly value = "<?php echo $row['mobile'] ?>">
                <i class = "fa fa-edit" onclick = "enable('mobile')"></i><br>
                Joined On : <input type = "text" readonly value = "<?php echo $row['joinedOn'] ?>"><br>
                Address : <textarea name = "address" id = "address" placeholder="Address" readonly><?php echo $row['address'] ?></textarea>
                <i class = "fa fa-edit" onclick = "enable('address')"></i>
            </div>
            <hr>
        </div>
        </form>
        <script>
            function preview(){
                var image = document.getElementById("pImage").files;
                if(image.length > 0){
                    fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("photo").setAttribute("src", event.target.result);
                    }
                    fileReader.readAsDataURL(image[0]);
                }
            }
            function enable(val){
                document.getElementById(val).readOnly = false;
                document.getElementById(val).style.borderWidth = "0px 0px 2px 0px";

            }
        </script>
    </body>
</html>