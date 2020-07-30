 <!--Require SELECT ONEPOSTS-->
 <?php require_once( "app/includes/select-posts.php"); ?>
<?php 
if(!isset($_GET['id'])){
 header("Location:index.php");
}else{
    $post_id=$_GET['id'];
   $selectOne=sellectOne($post_id);
} 

?>
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
    <title><?php echo $selectOne['title']; ?></title>
</head>

<body>

       <!--Require HEADER-->
       <?php require_once( "app/includes/header.php"); ?>
    <!-- Page Wrapper-->
    <div class="page-wrapper">

        <!-- Content-->
        <div class="content clearfix">

            <!-- Main Content-Wrapper-->
            <div class="main-content-wrapper">
                <div class="main-content single">
                    <h1 class="post-title"><?php echo $selectOne['title'] ?> </h1>
                    <div class="post-content">
                      <?php echo html_entity_decode($selectOne['body']) ?> 
                    </div>
                </div>
            </div>
            <!-- //Main Content-->

            <!-- Sidebar       -->
            <div class="sidebar single">
                <script src="https://apps.elfsight.com/p/platform.js" defer></script>
                <div class="elfsight-app-ad507b95-813f-4adc-815f-d3a47ba465fd" style="width: 100%; height: 100%;"></div>

                <div class="section popular">
                    <h2 class="section-title">Popularno</h2>
                    <!--POST--><?php $i=1; ?>
                    <?php foreach ($allPosts as $key => $post): ?>
                        
                    <div class="post clearfix">
                        <img src="img/posts/<?php echo ($post['image']);?>" alt="">
                        <a href="single.php?id=<?php echo $post['id']?>" class="title">
                            <h4><?php echo ($post['title']);?></h4>
                        </a>
                    </div>
                    <?php $i++; if($i>5){break;} ?>
                    <?php endforeach; ?> 
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
            <!-- //Sidebar -->
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