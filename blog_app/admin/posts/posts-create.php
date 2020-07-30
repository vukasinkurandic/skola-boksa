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
                <li><a href="posts-index.php">Manage Posts</a></li>
                <li><a href="../users/users-index.php">Manage Users</a></li>
                <li><a href="../topics/topics-index.php">Manage Topics</a></li>
            </ul>
        </div>
        <!--//Left Sidebar-->

        <!--Admin Content-->
        <div class="admin-content">
            <div class="button-group">
                <?php 
                $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
                if (strpos($fullUrl,"create=error1")==true) {
                    $errors="Unesite Naslov";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                    
                } 
                elseif (strpos($fullUrl,"create=error2")==true) {
                    $errors="Unesite Tekst";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                   
                } 
                elseif (strpos($fullUrl,"create=error3")==true) {
                    $errors="Izaberite Sliku";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                    
                }
                elseif (strpos($fullUrl,"create=error4")==true) {
                    $errors="Izaberite Kategoriju";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                   
                } 
                elseif (strpos($fullUrl,"create=error5")==true) {
                    $errors="Već postoji članak sa istim naslovom";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                    
                } 
                elseif (strpos($fullUrl,"create=error6")==true) {
                    $errors="Došlo je do greške pokusajte ponovo";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                    
                }
                elseif (strpos($fullUrl,"extension=error")==true) {
                    $errors="Slika mora imati ekstenziju jpg,jpeg ili png";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                }
                elseif (strpos($fullUrl,"size=error")==true) {
                    $errors="Slika mora biti manja od 2MB";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                } 
                elseif (strpos($fullUrl,"upload=error")==true) {
                    $errors="Upload slike nije uspeo";
                    echo ('<p class="msg error" >'.$errors.'</p>');
                };
                
                ?><br>
                <a href="posts-create.php" class="btn btn-big">Add Posts</a>
                <a href="posts-index.php" class="btn btn-big">Manage Posts</a>
            </div>
            <div class="content">
                <h2 class="page-title">Add Post</h2>
                <form action="../../php/post-engine.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="title">Naslov</label>
                        <?php 
                         if (isset($_GET['title'])) {
                             $title=$_GET['title'];
                                echo ' <input type="text" name="title" class="text-input" value="'.$title.'">';
                         }else {
                                 echo '<input type="text" name="title" class="text-input">';
                                };
                        ?>
                    </div>
                    <div>
                        <label for="body">Tekst</label>
                        <?php 
                         if (isset($_GET['body'])) {
                             $body=$_GET['body'];
                                echo '<textarea name="body" id="body" value="'.$body.'"></textarea>';
                         }else {
                                 echo '<textarea name="body" id="body"></textarea>';
                                };
                        ?>
                    </div>
                    <div>
                        <label for="image">Slika</label>
                        <?php 
                         if (isset($_GET['image'])) {
                             $image=$_GET['image'];
                                echo ' <input type="file" name="image" class="text-input" value="'.$image.'">';
                         }else {
                                 echo '<input type="file" name="image" class="text-input">';
                                };
                        ?>
                    </div>
                    <div>
                        <!-- Display topics in select-->
                    <?php require_once ('../../app/database/connect.php') ?>
                    <?php 
                                $table='topics';
                                $topics=selectAll($table);
                        ?>
                        <label for="topic">Kategorija</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option>
                            <?php foreach ($topics as $key => $topic): ?>
                            <option value="<?php echo $topic['id']?>"><?php echo $topic['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="published">
                                 Publish
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="add-post-btn" class="btn btn-big">Add Post</button>
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