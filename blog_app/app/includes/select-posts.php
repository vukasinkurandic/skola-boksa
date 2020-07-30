<?php 
require_once ('app/database/connect.php');
$sql="SELECT p.* , u.username FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE published=1;";
$query=$conn->prepare($sql);
$query->execute();
$allPosts=$query->get_result()->fetch_all(MYSQLI_ASSOC);


$sql="SELECT p.* , u.username FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE published=1 ORDER BY created_at desc LIMIT 5;";
$query=$conn->prepare($sql);
$query->execute();
$somePosts=$query->get_result()->fetch_all(MYSQLI_ASSOC);

function somePost($search){
    global $conn;
    $sql="SELECT p.* , u.username FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE published=1 AND p.title LIKE ? OR p.body LIKE ? ";
    $query=$conn->prepare($sql);
    $query->bind_param("ss", $search, $search);
    $search='%'.$search.'%';
    $query->execute();
    $somePosts=$query->get_result()->fetch_all(MYSQLI_ASSOC);
    return $somePosts;
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

function selectCategory($id){
    global $conn;
    $sql="SELECT `posts`.*, `topics`.`name`, `users`.`username`
    FROM `posts` 
        LEFT JOIN `topics` ON `posts`.`topic_id` = `topics`.`id` 
        LEFT JOIN `users` ON `posts`.`user_id` = `users`.`id` WHERE published=1 AND `topics`.`id`=?";
    $query=$conn->prepare($sql);
    $query->bind_param("i", $id);
    $query->execute();
    $selectCategory=$query->get_result()->fetch_all(MYSQLI_ASSOC);  
    return $selectCategory;
}


?>