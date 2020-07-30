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
    <title>Admin - Manage Topics</title>
</head>

<body>
      <!--Require HEADER-->
      <?php require_once( "../../app/includes/header-admin.php"); ?>
    <!--Admin Page Wrapper-->
    <div class="admin-wrapper">
        <!--Left Sidebar-->
        <div class="left-sidebar">

            <ul>
                <li><a href="../posts/posts-index.php">Manage Posts</a></li>
                <li><a href="../users/users-index.php">Manage Users</a></li>
                <li><a href="topics-index.php">Manage Topics</a></li>
            </ul>
        </div>
        <!--//Left Sidebar-->

        <!--Admin Content-->
        <div class="admin-content">
        <?php 
          $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
          if (strpos($fullUrl,"create=success")==true) {
              $errors="Uspesno dodata tema";
              echo ('<p class="msg success" >'.$errors.'</p>');  
          } elseif(strpos($fullUrl,"delete=true")==true){
            $errors="Uspesno izbrisana tema";
              echo ('<p class="msg success" >'.$errors.'</p>'); 
          }elseif(strpos($fullUrl,"update=success")==true){
            $errors="Uspesno ažurirana tema";
              echo ('<p class="msg success" >'.$errors.'</p>'); 
          }
         ?><br>
            <div class="button-group">
                <a href="topics-create.php" class="btn btn-big">Add Topic</a>
                <a href="topics-index.php" class="btn btn-big">Manage Topics</a>
            </div>
            <div class="content">
                <h2 class="page-title">Manage Topics</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        
                        <?php require_once ('../../app/database/connect.php') ?>
                         <!-- DELETE POST-->
                         <?php if (isset($_GET['del_id'])) {
                            $id=$_GET['del_id'];
                            $sql="DELETE FROM topics WHERE id = '$id'";
                            $query=$conn->prepare($sql);
                            $query->execute();
                            header("Location:topics-index.php?delete=true"); 
                            } ?>
                            <!-- Display topic from DB -->
                        <?php 
                                $table='topics';
                                $topics=selectAll($table);
                        ?>

                            <?php foreach ($topics as $key => $topic): ?>
                                <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $topic['name']; ?></td>
                                <td><a href="topics-edit.php?name=<?php echo $topic['name'];?>&id=<?php echo $topic['id'];?>" class="edit">edit</a></td>
                                <td><a href="topics-index.php?del_id=<?php echo $topic['id'];?>" class="delete">delete</a></td>
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