function confirmPassword(){
    //alert("hi");
    
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm").value;

    if(password === confirmPassword){
        return true;
    }else{
        alert("Password confirmation went wrong .Please try again");
        return false;
    }
}