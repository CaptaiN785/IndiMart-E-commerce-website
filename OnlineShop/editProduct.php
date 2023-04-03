<?php
    include_once "connection.php";
    error_reporting(0);

    $id = $_GET['id'];
    $pid = $_GET['pid'];
    $t = $_GET['t'];
    echo $t;
    if(isset($_POST['back'])){
        $id = $_GET['id'];
        $pid = $_GET['pid'];
        if($t == 0){
            echo "<meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id';";
        }
        if($t == 1){
            echo "<meta http-equiv = 'refresh' content = '0; url = dashboard.php?id=$id';";
        }
    }
    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $pid = $_GET['pid'];
        $name = $_POST['name'];
        $cat = $_POST['category'];
        $subCat = $_POST['subCategory'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $avail = $_POST['availablity'];
        $desc = $_POST['description'];
        
        
        $str = "update product set name = '$name', category = '$cat', subCategory = '$subCat', price = $price, discount = $discount, ".
        "availablity = $avail, description = '$desc'";
        if($_FILES["pImage"]["name"]){
            $image = addslashes(file_get_contents($_FILES["pImage"]["tmp_name"]));
            $str = $str.", image = '$image'";
        }
        $str = $str." where PID = $pid and sellerId = $id";
        
        $insert = $conn->query($str);
        if($insert){
            echo "
            <script>alert('Product updated successfully') </script>
            ";
            if($t == 0){
                echo "<meta http-equiv = 'refresh' content = '0; url = viewProduct.php?id=$id';";
            }else{
                echo "<meta http-equiv = 'refresh' content = '0; url = dashboard.php?id=$id';";
            }
        }else{
            echo "
            <script>alert('Server Error')</script>
            ";
        }
        
    }

    
    $sql = "select * from product where PID = $pid and sellerId = $id";
    $rs = $conn->query($sql);
    if($rs){
        if(mysqli_num_rows($rs) > 0){
            $row = mysqli_fetch_assoc($rs);
        }else{
            echo "
            <script>alert('No Record Found')</script>
        ";
        }
    }else{
        echo "
            <script>alert('Server Error')</script>
        ";
    }

?>
<html>
    <head>
        <title>Edit Product</title>
        <link rel = "stylesheet" href = "editProduct.css">
    </head>
    <body>
        <h1></h1>
        <div class = "tab">
            <h2>Edit Details</h2><hr>
            <form autocomplete="off" action = "?<?php echo 'id='.$id.'&pid='.$pid.'&t='.$t ?>" method = "post" enctype="multipart/form-data">
            <div class = "Image">
                <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']); ?>" id = "image" style= "width:100%;height:100%;display:block;">
                <input type = "file" id = "pImage" name = "pImage" style ="display:none;" onchange="previewImage()">
                <label for = "pImage">Change</label>
            </div>
            <table>
            <tr>
                <td>Name </td><td><input type = "text" name = "name" required value = "<?php echo $row['name'] ?>"></td>
            </tr>
            <tr>
                <td>Category </td><td> <input type="text" name = "category" required value = "<?php echo $row['category'] ?>"> </td>                
            </tr>
            <tr>
                <td>Sub-Category </td><td><input type = "text" name = "subCategory" required value = "<?php echo $row['subCategory'] ?>"></td>
            </tr>
            <tr>
                <td>Price </td><td> <input type = "number" name = "price" requireed value = "<?php echo $row['price'] ?>"></td>
            </tr>
            <tr>
                <td>Discount </td><td> <input type = "number" name = "discount" required value = "<?php echo $row['discount'] ?>"></td>
            </tr>
            <tr>
                <td>Availablity </td><td> <input type = "number" name = "availablity" required value = "<?php echo $row['availablity'] ?>"></td>
            </tr>
            <tr>
                <td>Description </td><td> <textarea name = "description" ><?php echo $row['description'] ?></textarea></td>
            </tr>
            </table>
            <h2>
                <input type = "submit" name = "back" value = "Back">
                <input type = "submit" name = "update" value = "Update">
            </h2>
            </form>
        </div>
        <script>
            function previewImage(){
                var file = document.getElementById("pImage").files;
                if(file.length>0){
                    var fileReader = new FileReader();
                    fileReader.onload = function(event){
                        document.getElementById("image").setAttribute("src", event.target.result);
                    };
                    fileReader.readAsDataURL(file[0]);;
                }
            }
        </script>
    </body>

</html>