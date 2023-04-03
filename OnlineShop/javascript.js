function logout(){
    var val = confirm("Are You sure ?");
    if(val){
        window.location.href = "login.php";
    }
}