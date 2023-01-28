<?php
session_start();
if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = false;
    $_SESSION['userID'] = "";
}
?>
<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>
<body>
    <div class="top-panel"><a href="index.php"><img src="img/cinema.jpg">Cinema</a></div>
    <div class="bottom-panel">
        <?php
        if ($_SESSION["logged"] == true) {
            echo '<a href="logout.php">Log out</a>';
        }
        ?>

        <?php
        if ($_SESSION["logged"] == false) {
            echo '<a href="login.php">Sign in</a>';
            echo '<a href="register.php">Sign up</a>';
        }
        ?>
    </div>
</body>