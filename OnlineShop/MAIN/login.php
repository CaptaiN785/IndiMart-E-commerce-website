<?php
    include "connection.php";
    error_reporting(0);
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql = "select * from customer where (email = '$user' or mobile = '$user') or password = '$pass'";
        if(mysqli_num_rows($rs = $conn->query($sql))){
            $row = mysqli_fetch_assoc($rs);
            echo "
            <meta http-equiv = 'refresh' content = '0; url = main.php?cid=$row[cid]'>
            ";
        }else{
            echo "
                <script>alert('Incorrect details')</script>
                <meta http-equiv = 'refresh' content = '0; url = login.php'>
            ";
        }
    }
    if(isset($_POST['register'])){
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $pass = $_POST['pass1'];

        $sql = "insert into customer(joinedOn, email, mobile, password) values (now(), '$email', '$mobile', '$pass')";
        if($conn->query($sql)){
            echo "
                <script>alert('Registered successfully')</script>
            ";
        }else{
            echo "
                <script>alert('Server Error')</script>
            ";
        }

    }


?>
<html>
    <head>
        <title>
            Login/SignUp
        </title>
        <link rel = "stylesheet" href = "login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "parent">
            <div class = "nav" onclick="change()"><span id = "btn">Login</span></div>
            <div class = "login" id = "login">
                <form method = "post" enctype="multipart/form-data" action = "" autocomplete="off">
                    <h2>Login Here</h2>
                    <input type = "text" name = "user" placeholder="Enter your email" required>
                    <input type = "password" name = "password" placeholder="Enter password" required>
                    <input type = "checkbox" name = "remember" id = "remember">
                    <label for = "remember">Remember me</label><br>
                    <input type = "submit" name = "login" value = "Login"><br>

                    <a href = "forgotPassword.php">Forgot password</a>
                </form>
            </div>
            <div class = "register" id = "register">
            <form method = "post" enctype="multipart/form-data" action = "" autocomplete="off">
                <h2>Register Yourself</h2>
                <input type = "email" name = "email" required placeholder="Enter email">
                <input type = "text" name = "mobile" required placeholder="Enter mobile number" maxlength="10">
                <input type = "password" name = "pass1" id = "pass1" required placeholder="Enter password">
                <input type = "text" name = "pass2" id = "pass2" required placeholder="Confirm password"><br>
                <input type = "submit" name = "register" value = "Register" onclick="return check()">
            </form>
            </div>
        </div>
            <script>
            function change(){
                if(document.getElementById("btn").style.marginLeft === "0px"){
                    document.getElementById("btn").style.marginLeft = "112px";
                    document.getElementById("btn").style.backgroundColor = "rgb(150, 100, 252)";
                    document.getElementById("btn").innerHTML = "SignUp";
                    document.getElementById("login").style.marginLeft = "-450px";
                    document.getElementById("register").style.marginLeft = "0px";

                }else{
                    document.getElementById("btn").style.marginLeft = "0px";
                    document.getElementById("btn").style.backgroundColor = "rgb(255, 100, 105)";
                    document.getElementById("btn").innerHTML = "Login";
                    document.getElementById("login").style.marginLeft = "0px";
                    document.getElementById("register").style.marginLeft = "450px";
                }
            }
            function check(){
                var pass1 = document.getElementById("pass1").value;
                var pass2 = document.getElementById("pass2").value;
                if(pass1 == pass2){
                    return true;
                }else{
                    alert("Password didn't match");
                    return false;
                }
            }
        </script>
    </body>
</html>