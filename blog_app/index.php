<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/14e951c16b.js" crossorigin="anonymous"></script>
    <!--Google fonts / Roboto-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- SLICK-CAROUSEL CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!--Main CSS-->
    <link rel="stylesheet" href="css/main.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">
   <!-- FAVICON -->
   <link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="css/favicon/favicon-16x16.png" />
    <link rel="manifest" href="css/favicon/site.webmanifest" />
    <title>ŠKOLA BOKSA SKADARLIJA</title>
</head>

<body>
    <!--Require SELECT ALLPOSTS-->
    <?php require_once( "app/includes/select-posts.php"); ?>
    <!--Require HEADER-->
    <?php require_once( "app/includes/header.php"); ?>
    <!-- Page Wrapper-->
    <div class="page-wrapper">
        <!-- Post Slider-->
        <?php 
          if (isset($_SESSION['message'])) {
              echo ('<p class="msg success" >'.$_SESSION['message'].'</p>');
              unset($_SESSION['message']); 
          }elseif(isset($_GET['create'])){
            $errors=$_GET['create'];
            echo ('<p class="msg error" >'.$errors.'</p>');
          }elseif(isset($_GET['dashboard'])){
            echo ('<p class="msg error">Morate korstiti dashboard</p>');
          }
         ?><br>
        <div class="post-slider">
            <h1 class="slider-title">Najzanimljiviji Postovi</h1>
            <i class="fa fa-chevron-left prev"></i>
            <i class="fa fa-chevron-right next"></i>
            <div class="post-wrapper">
                <!--POST-->
                <?php 
                 $postTitle= "Novi Postovi";
                if (isset($_POST['search-term']) && ($_POST['search-term'])!=="") {
                    $search= strip_tags($_POST['search-term']);
                    $postTitle= "Rezultat pretrage '".$search. "'";
                    $somePosts=somePost($search);
                    if ($somePosts===[]) {
                        $postTitle= "Nema rezultata pretrage po '".$search. "'";
                        } 
                }
                if(isset($_GET['topic_id'])){
                    $topic_id=$_GET['topic_id'];
                    $somePosts=selectCategory($topic_id);
                   $postTitle= 'Svi postovi po kategoriji " '.$somePosts[0]["name"]. ' "';
                }
               
                 ?>
                <?php foreach ($allPosts as $key => $post): ?>
                <div class="post">
                    <img src="img/posts/<?php echo ($post['image']);?>" alt="" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id']?>"><?php echo ($post['title']);?></a></h4>
                        <i class="far fa-user"><?php echo " ". ($post['username']);?></i> &nbsp;
                        <i class="far fa-calendar"><?php echo " ". date('F j, Y',strtotime($post['created_at']));?></i>
                    </div>
                </div>
                <?php endforeach; ?>  
                <!--//POST-->
            </div>
        </div>
        <!-- //Post Slider-->

        <!-- Content-->
        <div class="content clearfix">
            <!-- Main Content-->
            <div class="main-content">
                <h1 class="resent-post-title"><?php echo $postTitle; ?></h1>
                <!--Post-->
                <?php foreach ($somePosts as $key => $post): ?>
                <div class="post clearfix">
                    <img src="img/posts/<?php echo ($post['image']);?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h1><a href="single.php?id=<?php echo $post['id']?>"><?php echo ($post['title']);?></a></h1>
                        <i class="far fa-user"><?php echo " ". ($post['username']);?></i> &nbsp;
                        <i class="far calendar"><?php echo " ". date('F j, Y',strtotime($post['created_at']));?></i>
                        <p class="preview-text"><?php echo html_entity_decode(substr($post['body'], 0, 170). '...'); ?></p>
                        <a href="single.php?id=<?php echo $post['id']?>" class="btn read-more">Procitaj vise</a>
                    </div>
                </div>
                <?php endforeach; ?>  
                <!--//Post-->
            </div>
            <!-- //Main Content-->
            <div class="sidebar">
                <div class="section search">
                    <h2 class="section-title">Pretrazi</h2>
                    <form action="index.php" method="POST">
                        <input type="text" name="search-term" class="text-input" placeholder="Pretrazi...">
                    </form>
                </div>
                <div class="section topics">
                    <h2 class="section-title">Kategorije</h2>
                    <ul>
                    <?php require_once ('app/database/connect.php') ?>
                    <?php 
                                $table='topics';
                                $topics=selectAll($table);
                        ?>
                    <?php foreach ($topics as $key => $topic): ?>
                        <li><a href="index.php?topic_id=<?php echo $topic['id'];?>"><?php echo $topic['name'] ?></a></li>
                    <?php endforeach; ?>
                    
                    </ul>
                </div>
            </div>
        </div>
        <!-- //Content-->

    </div>
    <!-- //Page Wrapper-->


   <!--Require FOOTER-->
   <?php require_once( "app/includes/footer.php"); ?>


    <!--JQueru JS-->
    <script src="js/jquery.js"></script>
    <!-- SLICK-CAROUSEL JS-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!--Main JS JS-->
    <script src="js/main.js"></script>
</body>

</html>