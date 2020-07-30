<?php session_start(); 
require_once ("../app/database/connect.php");



if (isset($_POST['add-post-btn'])) {
    $title=$_POST['title'];
    $body=htmlentities( $_POST['body']);
    $image=$_FILES['image']['name'];
    $image=time().'_'.$image;
    $topic_id=$_POST['topic_id'];
    if (isset($_POST['published'])) {
        $published=1;
    } else {
        $published=0;
    }
    $user_id=$_SESSION['id'];
   
if ($title==="") {
    header("Location:../admin/posts/posts-create.php?create=error1&body=$body");
        exit();
} else {
    
    if ($body==="") {
        header("Location:../admin/posts/posts-create.php?create=error2&title=$title");
            exit();
    }else {
        if ($image==="") {
            header("Location:../admin/posts/posts-create.php?create=error3&title=$title&body=$body");
            exit();
        } else {
            if ($topic_id==="") {
                header("Location:../admin/posts/posts-create.php?create=error4&title=$title&body=$body&image=$image");
            exit();
            } else {
                if (!isset($_SESSION['id'])) {
                    header("Location:../index.php?create=Morate_biti_Admin");
            exit();
                } else {
                    /// Check if title already exist
                    $sql="SELECT * FROM posts WHERE title = ?";
                    $query=$conn->prepare($sql);
                    $query->bind_param("s", $title);
                    $query->execute();
                    $result=$query->get_result()->fetch_assoc();
                    if (empty(!$result)) {
                        header("Location:../admin/posts/posts-create.php?create=error5&title=$title&body=$body");
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
                           header("Location:../admin/posts/posts-create.php?extension=error&title=$title&body=$body");
                            exit();
                        } else {
                            if (($_FILES["image"]["size"] > 2000000)) {
                                header("Location:../admin/posts/posts-create.php?size=error&title=$title&body=$body");
                                exit();
                            } else {
                                $target = "../img/posts/".$image;
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)){
                                    echo "USPESNO DODATA SLIKA";
                                }else{
                                    header("Location:../admin/posts/posts-create.php?upload=error&title=$title&body=$body");
                                    exit();
                                }
                            }   
                        };
                        /// INSERT NEW POST IN DB
                        $sql = "INSERT INTO posts (user_id,topic_id,title,image,body,published) VALUES (?,?,?,?,?,?)";
                        $query=$conn->prepare($sql);
                        $query->bind_param("iisssi", $user_id,$topic_id,$title,$image,$body,$published);
                        $query->execute();
                    // Check if data inserted
                    if($conn->affected_rows){
                       header("Location:../admin/posts/posts-index.php?create=success");
                        exit();
                    }
                    // else data not inserted
                    else{
                        header("Location:../admin/posts/posts-create.php?create=error6&title=$title&body=$body");
                    }
                    }
                    
                }
                
            }
            
        }      
    }
}
};
?>
   

