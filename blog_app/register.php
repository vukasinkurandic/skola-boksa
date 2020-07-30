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
    <title>ŠKOLA BOKSA SKADARLIJA</title>
</head>

<body>
        <!--Require HEADER-->
        <?php require_once( "app/includes/header.php"); ?>
    <div class="auth-content">
        <form action="php/register-engine.php" method="post">
            <h2 class="form-title">Register</h2>

    <div>
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
    
    ?>
    </div> 
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
                <label>Password</label>
                <input type="password" name="password" class="text-input">
            </div>
            <div>
                <label>Password Confirmation</label>
                <input type="password" name="passwordConf" class="text-input">
            </div>
            <div>
                <button type="submit" name="register-btn" class="btn btn-big">Register</button>
            </div>
            <p>Or <a href="login.php">Log In</a></p>
        </form>
    </div>
  
    <!--JQueru JS-->
    <script src="js/jquery.js"></script>


</body>

</html>