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
    <title>Admin - Add Post</title>
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
   
          if (strpos($fullUrl,"edit=error1")==true) {
              $errors="Sva polja su obavezana...";
              echo ('<p class="msg error" >'.$errors.'</p>');
          } 
         ?><br>
            <div class="button-group">
                <a href="topics-create.php" class="btn btn-big">Add Topic</a>
                <a href="topics-index.php" class="btn btn-big">Manage Topics</a>
            </div>
            <div class="content">
                <h2 class="page-title">Edit Topic</h2>
                <form action="../../php/edit_topics-engine.php" method="post">
                <div>
                       
                        <?php 
                            if (isset($_GET['id'])) {
                            $id=$_GET['id'];
                            echo '<input type="hidden" name="id" value="'.$id.'" readonly>';
                         };
                ?>
                    </div>

                    <div>
                        <label for="name">Name</label>
                        <?php 
                            if (isset($_GET['name'])) {
                            $name=$_GET['name'];
                            echo '<input type="text" name="name" class="text-input" value="'.$name.'">';
                         }else {
                            echo '<input type="text" name="name" class="text-input">';
                };
                ?>
                    </div>
                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" id="body"></textarea>
                    </div>

                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-big">Update Topic</button>
                    </div>
                </form>
            </div>


        </div>
        <!--//Admin Content-->


    </div>
    <!-- //Page Wrapper-->


    <!--JQueru JS-->
    <script src="../../js/jquery.js"></script>

    <!--CKE editor 5-->
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>

    <!--Admin JS-->
    <script src="../../js/admin.js"></script>
</body>

</html>