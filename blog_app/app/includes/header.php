<header>
    <?php session_start(); ?>
    
    <?php /// DESTROY SESSION AFTER 60 min
    if(isset($_SESSION["start"])){
        if(time()-$_SESSION["start"] >600)   
    { 
        session_unset(); 
        session_destroy(); 
       header("Location:login.php?login=error10"); 
    }
    }
      ?>
        <a class="logo" href="index.php">
            <h1 class="logo-text"><span>ŠB Skadarlija</span></h1>
        </a>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">About</a></li>
            <li><a href="index.php">Services</a></li>
        <?php if(isset($_SESSION['id'])): ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i> 
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <?php if($_SESSION['admin']): ?>
                    <li><a href="admin/posts/posts-index.php">Dashboard</a></li>
                    <?php endif; ?> 
                    
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>

            <li><a href="register.php">Sing Up</a></li>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>    
        </ul>
    </header>