<header>
    <?php if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../../index.php?dashboard=false');
    exit;
} ?>
    <?php session_start() ?>
        <a class="logo" href="../../index.php">
            <h1 class="logo-text"><span>ŠB Skadarlija</span></h1>
        </a>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
            <li>
                <a href="#">
                <?php if(isset($_SESSION['id'])): ?>
                    <i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?>
                <?php else: ?>
                    <i class="fa fa-user"></i> Admin
                <?php endif; ?>
                    
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="../../logout.php" class="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>