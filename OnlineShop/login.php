<?php
    include "connection.php";
    error_reporting(0);

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = "select * from users where email = '$email' and password = '$pass'";
        $check = $conn->query($sql);
        if($check){
            if(mysqli_num_rows($check) == 1){
                $row = mysqli_fetch_assoc($check);
                echo "
                    <meta http-equiv = 'refresh' content = '0; url = dashboard.php?id=$row[id]'>
                ";
            }else{
                echo "
                    <script>alert('Invalid email or password')</script>
                ";
            }
        }else{
            echo "
                <script>alert('Server erroe please try again later')</script>
            ";
        }
    }


?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            *{
                margin:0px;
                padding:0px;
            }
            body{
                background-image: url("images/bg.jpg");
                background-size:cover;
                margin:0px;
            }
            .login{
                background-color: rgba(0, 0, 0, 0.15);
                padding:40px;
                border-radius:10px;
                margin:7% auto;
                width:250px;
                height:400px;
                text-align: center;
            }
            .login img{
                margin:0px auto;
                border-radius:50%;
                border:5px solid blue;
                padding:5px;
                margin-bottom:40px;
            }
            .login input{
                width:90%;
                height:30px;
                margin-bottom:20px;
                outline:none;
                border:1px solid blue;
                border-width:0px 0px 2px 0px;
                background: none;
                padding:5px;
                font-family:cambria;
                font-size:20px;
                color:blue;
            }
            .login input::placeholder{
                color:blue;
                opacity:60%;
            }
            i{
                padding:4px;
                color:blue;
                border-bottom:2px solid blue;
            }
            input[type = "submit"]{
                margin-top:30px;
                border:none;
                outline:none;
                background-image: linear-gradient(0deg, rgb(127, 127, 184), rgb(54, 11, 155));
                padding:10px 50px;
                height:40px;
                color:white;
                border-radius:50px;
            }
            input[type = "submit"]:hover{
                background-color: white;
                opacity:50%;
            }
            input[type = "submit"]:active{
                background-color:white;
                opacity:100%;
            }
            .link{
                text-align: right;
                margin-top:10px;
            }
            .link a{
                text-decoration:none;
                font-size:18px;
                color:blue;
            }
            ul{
                list-style-type:none;
            }
            ul li{
                margin:10px 0px;
            }
        </style>
    </head>
    <body>
        <form action = "" method ="POST" enctype ="multipart/form-data">
        <div class = "login">
            <img src = "images/avatar.png" width ="100" height = "100"><br>
            <i class = "fa fa-envelope"></i><input type = "text" name = "email" placeholder="Enter email"><br>
            <i class = "fa fa-lock"></i><input type = "password" name = "password" placeholder="Enter password"><br>
            <input type="submit" name = "login" value = "Login"><br>
            <div class = "link">
                <ul>
                    <li>
                        <a href = "forgotPassword.php" target= "_blank">Forgot password?</a><br>
                    </li>
                    <li>
                        <a href = "userRegistration.html" target="_self">New user register here</a>
                    </li>
                </ul>
            </div>
        </div>
        </form>
    </body>
</html>
