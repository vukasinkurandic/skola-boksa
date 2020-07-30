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
    <title>Admin - Add User</title>
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
            <div class="button-group">
            <?php 
    $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   
    if (strpos($fullUrl,"register=error1")==true) {
        $errors="Email je obavezan...";
        echo ('<p class="msg error" >'.$errors.'</p>');
        
    } 
    elseif (strpos($fullUrl,"register=error2")==true) {
        $errors="Unesite ispravno User name";
        echo ('<p class="msg error" >'.$errors.'</p>');
       
    } 
    elseif (strpos($fullUrl,"register=error3")==true) {
        $errors="Lozinka je obavezna";
        echo ('<p class="msg error" >'.$errors.'</p>');
        
    }
    elseif (strpos($fullUrl,"register=error4")==true) {
        $errors="Ponovljena lozinka je obavezna";
        echo ('<p class="msg error" >'.$errors.'</p>');
       
    } 
    elseif (strpos($fullUrl,"register=error5")==true) {
        $errors="Lozinke nisu iste";
        echo ('<p class="msg error" >'.$errors.'</p>');
        
    } 
    elseif (strpos($fullUrl,"register=error6")==true) {
        $errors="Email već postoji";
        echo ('<p class="msg error" >'.$errors.'</p>');
        
    }
    elseif (strpos($fullUrl,"register=error7")==true) {
        $errors="Neuspešna registracija";
        echo ('<p class="msg error" >'.$errors.'</p>');
       
    }
    
    ?><br>
                <a href="users-create.php" class="btn btn-big">Add User</a>
                <a href="users-index.php" class="btn btn-big">Manage Users</a>
            </div>
            <div class="content">
                <h2 class="page-title">Add User</h2>
                <form action="../../php/user-engine.php" method="post">
                <div>
              
              <label>Username</label>
              <?php 
              if (isset($_GET['uname'])) {
                  $uname=$_GET['uname'];
                  echo ' <input type="text" name="username" class="text-input" value="'.$uname.'">';
              }else {
                  echo '<input type="text" name="username" class="text-input">';
              };
              
              ?>
          </div>
          <div>
              <label>Email</label>
              <?php 
              if (isset($_GET['email'])) {
                  $email=$_GET['email'];
                  echo ' <input type="email" name="email" class="text-input" value="'.$email.'">';
              }else {
                  echo '<input type="email" name="email" class="text-input">';
              };?>
              
          </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" class="text-input">
                    </div>
                    <div>
                        <label for="passwordConf">Password Confirmation</label>
                        <input type="password" name="passwordConf" class="text-input">
                    </div>
                    <div>
                        <label for="topic">Role</label>
                        <select name="role" class="text-input">
                            <option value="0">Subscriber</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" name="user-btn"class="btn btn-big">Add User</button>
                    </div>
                </form>
            </div>


        </div>
        <!--//Admin Content-->


    </div>
    <!-- //Page Wrapper-->


    <!--JQueru JS-->
    <script src="../../js/jquery.js"></script>

</body>

</html>