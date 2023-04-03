<?php 
    $id = $_GET['id'];
    include "connection.php";
    error_reporting(0);
    if(isset($_POST['hide'])){
        $conn->query("update offer set visible = 0 where sellerId = $id and ");
    }
?>
<html>
    <title>Offer Products</title>
    <link rel = "stylesheet" href = "offer.css">
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <head>
        <body class = "body">
            <h1>Offered Products</h1>
            <a href = "makeOffer.php?id=<?php echo $id ?>"><i class = "fa fa-angle-left"></i>  Back</a>
            <div class = "container">
                <form>
                        <?php
                            $sql = "select * from offer where sellerId = $id";
                            $rs = $conn->query($sql); 
                            if($rs){
                                if(mysqli_num_rows($rs) > 0){
                                    while($row = mysqli_fetch_assoc($rs)){
                                        echo "<div class = 'mat'>
                                        <div class = 'PHOTO'> ";
                                        ?>
                                        <img src = "data:image/jpg;charset=utf-8;base64,<?php echo base64_encode($row['image']); ?>" class = 'imageID'>
                                        <?php
                                        echo "
                                        </div>
                                        <label class = 'PNAME'>$row[name]<br>
                                            <label>ID : $row[OID]</label><br>
                                            <label>Price : ₹$row[price] @ $row[discount]% discount</label><br>
                                            <label>From : $row[startDate] To : $row[lastDate]</label><br>
                                            <label>Status : 
                                            ";
                                                if($row['visible'] == 1){
                                                    echo "Visible";
                                                }else{
                                                    echo "Not Visible";
                                                }
                                            echo"</label><br><br>
                                            <label>Description : $row[about] </label>
                                        </label>
                                        <div class = 'BTN'>
                                        ";
                                        if($row['visible'] == 1){
                                            echo "<a href = 'offerVisible.php?id=$id&oid=$row[OID]' >Hide</a>";
                                        }else{
                                            echo "<a id = 'show' href = 'offerVisible.php?id=$id&oid=$row[OID]' style = 'background-color:green;'>Show</a>";
                                        }
                                        echo "</div>
                                        </div>
                                        ";
                                    }
                                }else{
                                    echo "
                                        <script>alert('No offer Product found!')</script>
                                    ";
                                }
                            }else{
                                echo "
                                    <script>alert('Server Error !') </script>
                                ";
                            }
                        ?>
                </form>
            </div>
        </body>
    </head>
</html>