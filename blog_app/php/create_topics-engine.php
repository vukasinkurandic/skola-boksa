<?php 
session_start();
require_once ("../app/database/connect.php");

if (isset($_POST['create-btn'])) {
    $name=$_POST['name'];
    $description=$_POST['description'];
    if ($name ==="" || $description==="" ){
        header("Location:../admin/topics/topics-create.php?create=error1&name=$name");
        exit();
    }else{
    $sql="SELECT name FROM topics WHERE name = ? ";
    $query=$conn->prepare($sql);
    $query->bind_param("s",$name);
    $query->execute();
    $result=$query->get_result()->fetch_all(MYSQLI_ASSOC);
    if ($conn->affected_rows) {
        header("Location:../admin/topics/topics-create.php?create=error2&name=$name");
        exit();
     } else {
        //// INSERT NEW TOPICS
       $sql = "INSERT INTO topics VALUES(null, ? , ?)";
       $query=$conn->prepare($sql);
       $query->bind_param("ss",$name,$description);
       $query->execute();
       header("Location:../admin/topics/topics-index.php?create=success");
     }
        
    }
}
  
        
?>

