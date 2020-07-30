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
    <title>Admin - Manage Users</title>
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
                <li><a href="users-index.php">Manage Users</a></li>
                <li><a href="../topics/topics-index.php">Manage Topics</a></li>
            </ul>
        </div>
        <!--//Left Sidebar-->

        <!--Admin Content-->
        <div class="admin-content">
        <?php 
          $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
          if (strpos($fullUrl,"login=successfully")==true) {
              $errors="Uspesno dodat novi korisnik";
              echo ('<p class="msg success" >'.$errors.'</p>');  
          } elseif(strpos($fullUrl,"delete=true")==true){
            $errors="Uspesno izbrisana korisnik";
              echo ('<p class="msg success" >'.$errors.'</p>'); 
          }
         ?><br>
            <div class="button-group">
                <a href="users-create.php" class="btn btn-big">Add User</a>
                <a href="users-index.php" class="btn btn-big">Manage Users</a>
            </div>
            <div class="content">
                <h2 class="page-title">Manage Users</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                    <?php require_once ('../../app/database/connect.php') ?>
                         <!-- DELETE USER-->
                         <?php if (isset($_GET['del_id'])) {
                            $id=$_GET['del_id'];
                            $sql="DELETE FROM users WHERE id = '$id'";
                            $query=$conn->prepare($sql);
                            $query->execute();
                            header("Location:users-index.php?delete=true"); 
                            } ?>
                            <!-- Display Users from DB -->
                        <?php 
                                $table='users';
                                $users=selectAll($table);
                        ?>
                        <?php foreach ($users as $key => $user): ?>
                                <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php if($user['admin']){
                                    echo 'Admin';
                                }else{
                                    echo 'Subscriber';
                                }; ?></td>
                                <td><a href="users-index.php?del_id=<?php echo $user['id'];?>" class="delete">delete</a></td>
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