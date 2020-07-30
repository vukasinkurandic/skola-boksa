<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/14e951c16b.js" crossorigin="anonymous"></script>
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
    <!--Main CSS-->
    <link rel="stylesheet" href="../../css/main.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!--Admin CSS-->
    <link rel="stylesheet" href="../../css/admin.css">
     <!-- FAVICON -->
     <link rel="apple-touch-icon" sizes="180x180" href="../../css/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../../css/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../../css/favicon/favicon-16x16.png" />
    <link rel="manifest" href="css/favicon/site.webmanifest" />
    <title>Admin - Manage Posts</title>
</head>

<body>
    <!--Require HEADER-->
    <?php require_once( "../../app/includes/header-admin.php"); ?>
    <!--Admin Page Wrapper-->
    <div class="admin-wrapper">
        <!--Left Sidebar-->
        <div class="left-sidebar">
            <ul>
                <li><a href="posts-index.php">Manage Posts</a></li>
                <li><a href="../users/users-index.php">Manage Users</a></li>
                <li><a href="../topics/topics-index.php">Manage Topics</a></li>
            </ul>
        </div>
        <!--//Left Sidebar-->
        <!--Admin Content-->
        <div class="admin-content">
            <?php 
             $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
             if (strpos($fullUrl,"create=success")==true) {
                 $errors="Uspesno dodat novi Članak";
                 echo ('<p class="msg success" >'.$errors.'</p>');  
             }elseif(strpos($fullUrl,"delete=true")==true){
                $errors="Uspesno izbrisan Članak";
                echo ('<p class="msg success" >'.$errors.'</p>');  
             }elseif(strpos($fullUrl,"published=success")==true){
                $errors="Uspesno ste objavili Članak";
                echo ('<p class="msg success" >'.$errors.'</p>'); 
            }elseif(strpos($fullUrl,"published=error")==true){
                $errors="Neuspesno ste objavili Članak";
                echo ('<p class="msg error" >'.$errors.'</p>'); 
            }elseif(strpos($fullUrl,"unpub=success")==true){
                $errors="Uspesno ste oDjavili Članak";
                echo ('<p class="msg success" >'.$errors.'</p>'); 
            }elseif(strpos($fullUrl,"unpub=error")==true){
                $errors="Neuspesno ste odjavili Članak";
                echo ('<p class="msg error" >'.$errors.'</p>'); 
            }elseif(strpos($fullUrl,"edit=success")==true){
                $errors="Uspesno ste izmenili Članak";
                echo ('<p class="msg success">'.$errors.'</p>'); 
            }
            ?><br>
            <div class="button-group">
                <a href="posts-create.php" class="btn btn-big">Add Posts</a>
                <a href="posts-index.php" class="btn btn-big">Manage Posts</a>
            </div>
            <div class="content">
                <h2 class="page-title">Manage Posts</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                    <?php require_once ('../../app/database/connect.php') ?>
                        <!-- DELETE POST-->
                         <?php if (isset($_GET['del_id'])) {
                            $id=$_GET['del_id'];
                            $sql="DELETE FROM posts WHERE id = '$id'";
                            $query=$conn->prepare($sql);
                            $query->execute();
                            header("Location:posts-index.php?delete=true"); 
                            } ?>
                        <!-- PUBLISHED POST POST-->
                        <?php if (isset($_GET['publised_id'])) {
                            $id=$_GET['publised_id'];
                            $sql="SELECT published FROM posts WHERE id='$id'";
                            $query=$conn->prepare($sql);
                            $query->execute();
                            $post=$query->get_result()->fetch_assoc();
                            if ($post['published']) {
                               $sql = "UPDATE posts SET published=0 WHERE id='$id'";
                               $insert_query = $conn->query($sql);
                                     // Check if data inserted
                                    if($insert_query === true){
                                     header("Location:posts-index.php?unpub=success");
                                     exit();
                                        }
                                     // else data not inserted
                                     else{
                                        header("Location:posts-index.php?unpub=error");
                                         }
                                 } else {
                                  $sql = "UPDATE posts SET published=1 WHERE id='$id'";
                                $insert_query = $conn->query($sql);
                                     // Check if data inserted
                                     if($insert_query === true){
                                        header("Location:posts-index.php?published=success");
                                        exit();
                                           }
                                        // else data not inserted
                                        else{
                                            header("Location:posts-index.php?published=error");
                                            }
                            } 
                            } ?>

                            <!-- Display topic from DB -->
                        <?php 
                                $table='posts';
                                $sql="SELECT p.title,u.username,p.id,p.published FROM posts p JOIN users u ON p.user_id = u.id";
                                $query=$conn->prepare($sql);
                                $query->execute();
                                $posts=$query->get_result()->fetch_all(MYSQLI_ASSOC);      
                            ?>
                        
                            <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['username']; ?></td>
                                <td><a href="posts-edit.php?id=<?php echo $post['id'];?>" class="edit">edit</a></td>
                                <td><a href="posts-index.php?del_id=<?php echo $post['id'];?>" class="delete">delete</a></td>
                                <td><a href="posts-index.php?publised_id=<?php echo $post['id'];?>" class="publish" <?php if($post['published']) echo'style="color:#303030;"'; ?>><?php if ($post['published']) {echo 'unpublish';}
                                 else{echo 'publish';}
                                ?>
                                </a></td>
                                </tr>
                            <?php endforeach; ?>  
                    </tbody>
                </table>
            </div>
        </div>
        <!--//Admin Content-->
    </div>
    <!-- //Page Wrapper-->
    <!--JQueru JS-->
    <script src="../../js/jquery.js"></script>
</body>
</html>