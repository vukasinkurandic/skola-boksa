<?php 
require_once ('../../blog_app/app/database/connect.php');

function sellectId(){
    global $conn;
    $sql="SELECT id FROM posts WHERE published=1 LIMIT 12";
    $query=$conn->prepare($sql);
    $query->execute();
    $sellectId=$query->get_result()->fetch_all(MYSQLI_ASSOC);  
    return $sellectId;
}
function sellectOne($id){
    global $conn;
    $sql="SELECT p.* , u.username FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE published=1 AND p.id=?";
    $query=$conn->prepare($sql);
    $query->bind_param("i", $id);
    $query->execute();
    $onePost=$query->get_result()->fetch_assoc();  
    return $onePost;
}   
?>