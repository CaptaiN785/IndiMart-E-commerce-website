<?php
    include("connection.php");
    // error_reporting(0);
    $name   = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email  = $_POST['email'];
    $dob    = $_POST['dob'];
    $personalAddress = $_POST['personalAddress'];
    $shopName = $_POST['shopName'];
    $gst = $_POST['gst'];
    $shopCategory = $_POST['shopCategory'];
    $yoe = $_POST['yoe'];
    $shopAddress = $_POST['shopAddress'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $accno = $_POST['accno'];
    $ifsc = $_POST['ifsc'];
    $upi = $_POST['upi'];
    $password = $_POST['password'];
    $profilePhoto = addslashes(file_get_contents($_FILES["profileImage"]["tmp_name"]));
    $shopPhoto = addslashes(file_get_contents($_FILES["shopImage"]["tmp_name"]));

    $stmt = "insert into users (joiningDate, name, mobile, email, dob, personalAddress, shopName, gstNo,".
            "shopCategory, yoe, shopAddress, aadhar, pan, accno, ifsc, upi, profilePhoto, shopPhoto, password)".
            "values (now(), '$name', '$mobile' ,'$email', '$dob', '$personalAddress', '$shopName', '$gst', '$shopCategory',".
            "'$yoe', '$shopAddress', '$aadhar', '$pan', '$accno', '$ifsc', '$upi', '$profilePhoto', '$shopPhoto', '$password')";
    $rs = $conn->query($stmt);
    if($rs){
        echo "
            <script>alert('User Registered'); </script>
        ";
    }else{
        echo "
            <script>alert('Unable to register user' + $stmt); </script>
        ";
    }
    echo "<meta http-equiv = 'refresh' content = '0, url = http://localhost/OnlineShop/userRegistration.html'>";
?>