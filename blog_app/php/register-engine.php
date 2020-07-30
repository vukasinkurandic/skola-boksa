<?php 
require_once ("../app/database/connect.php");

if (isset($_POST['register-btn'])) {
$uname=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$repeat_register_psw=$_POST['passwordConf'];
$heshpassword=password_hash($password,PASSWORD_DEFAULT);

///Checking the Email 
if ($email==="" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location:../register.php?register=error1&uname=$uname");
 
} else {
 ///Checking the User name 
 if ($uname ==="" || !preg_match("/^[a-zšđčćžA-ZŠĐČĆŽ ]*$/",$uname)) {
    header("Location:../register.php?register=error2&email=$email");
     
 } else {
     ///Checking the Password 
     if ($password ==="") {
        header("Location:../register.php?register=error3&uname=$uname&email=$email");
     } else {
         ///Checking the Repeat Password 
         if ($repeat_register_psw ==="") {
            header("Location:../register.php?register=error4&uname=$uname&email=$email");
         } else {
             /// Checking if the Password match
             if ($password !== $repeat_register_psw) {
                header("Location:../register.php?register=error5&uname=$uname&email=$email"); 
             } else {
                 //// Checking if USER already exist
                 $sql="SELECT * FROM users WHERE email = ?";
                 $query=$conn->prepare($sql);
                 $query->bind_param("s", $email);
                 $query->execute();
                 $rezultat=$query->get_result()->fetch_all(MYSQLI_ASSOC);
                 //// Checking if EMAIL already exist in DB
                 if (empty(!$rezultat)) {
                    header("Location:../register.php?register=error6&uname=$uname&email=$email");
                 } else {
                     //// INSERT NEW USER
                     $sql = "INSERT INTO users VALUES(null,0,?,?,?,null)";
                     $query=$conn->prepare($sql);
                     $query->bind_param("sss", $uname, $email, $heshpassword);
                     $query->execute();

                     if ($conn->affected_rows) {
                        header("Location:../login.php?login=successfully&email=$email");
                      } else {
                        header("Location:../register.php?register=error7&uname=$uname&email=$email");
                    }
                 }
             }  
         } 
     }  
 } 
}
}else{
    header("Location:../register.php?register=error7");
};



?>