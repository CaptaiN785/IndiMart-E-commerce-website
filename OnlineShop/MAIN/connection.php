<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "OnlineShop";

    $conn = mysqli_connect($host, $username, $password, $db);
    if($conn->connect_error){
        die("Unable to Connect");
    }
    echo "
        <script>//alert('Connected'); </script>
    ";
    
?>