<?php
session_start();
if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = false;
} else {
    if (!$_SESSION['logged']) {
        $_SESSION['logged'] = false;
    } else {
        $_SESSION['logged'] = true;
    }
}
unset($_SESSION['isfilmselected']);
unset($_SESSION['film']);
unset($_SESSION['deleteseanceinfo']);
?>
<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>
<body>
    <div class="top-panel">
        <?php
        if ($_SESSION["login"] == "admin") {
            echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
        }
        ?>
        <a href="index.php"><img src="img/cinema.jpg">Cinema</a>
        <?php
        if ($_SESSION["logged"] == true) {
            echo '<a href="logout.php" class="logout"><img src="img/logout.png">Log out</a>';
        }
        ?>
    </div>
    <div class="bottom-panel">
        <div class="index">
        <?php
            if ($_SESSION["logged"] == false) {
                echo '<a href="login.php">Sign in</a>';
                echo 'OR';
                echo '<a href="register.php">Sign up</a>';
            } else {
                echo '<a href="cinema.php" class="gotofilms">Go to films</a>';
            }
        ?>        
        </div>
    </div>
    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </div>
    <?php
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    ?>
</body>