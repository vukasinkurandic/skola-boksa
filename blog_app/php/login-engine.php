<?php 
session_start();
require_once ("../app/database/connect.php");

if (isset($_POST['login-btn'])) {
$email=$_POST['email'];
$password=$_POST['password'];
$heshpassword=password_hash($password,PASSWORD_DEFAULT);

 ///Checking the User name 
 if ($email==="" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location:../login.php?login=error2");
     
 } else {
     ///Checking the Password 
     if ($password ==="") {
        header("Location:../login.php?login=error3&email=$email");
     } else {
        $sql = "SELECT email FROM users WHERE email = ?";
        $query=$conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();
        $result=$query->get_result()->fetch_assoc();
         if (!$conn->affected_rows) {
            header("Location:../login.php?login=error9&email=$email");
            exit();
         } else {
            $sql = "SELECT * FROM users WHERE email = ?";
            $query=$conn->prepare($sql);
            $query->bind_param("s", $email);
            $query->execute();
            $result=$query->get_result()->fetch_assoc();
            $user_id= $result['id'];
            $username=$result['username'];
            $admin=$result['admin'];
            if (password_verify($password,$result['password'])){
                // Log In (SESSION)
                $_SESSION['id']=$user_id;
                $_SESSION['username']=$username;
                $_SESSION['admin']=$admin;
                $_SESSION['message']='Uspešno ste ulogovani';
                $_SESSION['type']='succes';
               $_SESSION["start"] = time(); 
            header("Location:../index.php");
              
            }else{
                header("Location:../login.php?login=error8&email=$email");
            }
         }
      }  
    } 

};



?>