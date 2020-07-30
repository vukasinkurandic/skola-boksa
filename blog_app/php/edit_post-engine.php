<?php session_start(); 
require_once ("../app/database/connect.php");

if (isset($_POST['add-post-btn'])) {
    $id=$_POST['id'];
    $title=$_POST['title'];
    $body=$_POST['body'];
    $image=$_FILES['image']['name'];
    $image=time().'_'.$image;
    $topic_id=$_POST['topic_id'];
    $user_id=$_SESSION['id'];
    if (isset($_POST['published'])) {
        $published=1;
    } else {
        $published=0;
    }
if ($title==="") {
    header("Location:../admin/posts/posts-edit.php?create=error1&body=$body&id=$id");
        exit();
} else {
    
    if ($body==="") {
        header("Location:../admin/posts/posts-edit.php?create=error2&title=$title&id=$id");
            exit();
    }else {
        if ($image==="") {
            header("Location:../admin/posts/posts-edit.php?create=error3&title=$title&body=$body&id=$id");
            exit();
        } else {
            if ($topic_id==="") {
                header("Location:../admin/posts/posts-edit.php?create=error4&title=$title&body=$body&image=$image&id=$id");
            exit();
            } else {
                if (!isset($_SESSION['id'])) {
                    header("Location:../index.php?create=Morate_biti_Admin");
            exit();
                } else {
                         /// UPLOAD IMAGE AND VALIDATE IMAGE
                         $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                         $allowed_image_extension = array(
                             "png",
                             "jpg",
                             "jpeg",
                              "PNG",
                              "JPG",
                              "JPEG"
                         );
                         if (!in_array($file_extension, $allowed_image_extension)) {
                            header("Location:../admin/posts/posts-edit.php?extension=error&title=$title&body=$body&id=$id");
                             exit();
                         } else {
                             if (($_FILES["image"]["size"] > 2000000)) {
                                 header("Location:../admin/posts/posts-edit.php?size=error&title=$title&body=$body&id=$id");
                                 exit();
                             } else {
                                 $target = "../img/posts/".$image;
                                 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)){
                                     echo "USPESNO DODATA SLIKA";
                                 }else{
                                     header("Location:../admin/posts/posts-edit.php?upload=error&title=$title&body=$body&id=$id");
                                     exit();
                                 }
                             }                         
                         };
                        /// UPDATE NEW POST
                        $sql = "UPDATE posts SET title=?,body=?,image=?,topic_id=?,user_id=?,published=? WHERE id=?";
                        $query=$conn->prepare($sql);
                        $query->bind_param("sssiiii", $title,$body,$image,$topic_id,$user_id,$published,$id);
                        $query->execute();
                    
                    // Check if data UPDATE
                    if($conn->affected_rows){
                       header("Location:../admin/posts/posts-index.php?edit=success");
                        exit();
                    }
                    // else data not UPDATE
                    else{
                        header("Location:../admin/posts/posts-edit.php?create=error6&title=$title&body=$body&id=$id");
                    }  
                } 
            }
        }      
    }
}
};
?>
   

