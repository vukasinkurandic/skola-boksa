<?php 
session_start();
require_once ("../app/database/connect.php");

if (isset($_POST['edit-btn'])) {
    $id=$_POST['id'];
    $name=$_POST['name'];
    $description=$_POST['description'];
   
    if ($name ==="" || $description==="" ){
       header("Location:../admin/topics/topics-edit.php?edit=error1&name=$name&id=$id");
        exit();
    }else{
        //// UPDATE TOPICS   
       $sql = "UPDATE topics SET name= ?, descriptin =? WHERE id = ?";
       $query=$conn->prepare($sql);
       $query->bind_param("ssi", $name, $description, $id);
       $query->execute();
       header("Location:../admin/topics/topics-index.php?update=success"); 
    }
}        
?>