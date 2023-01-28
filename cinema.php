<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <div class="top-panel">
        <a href="index.php"><img src="img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="img/logout.png">Log out</a>
    </div>
    <div class="bottom-panel"></div>
    
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit();
    }
    ?>
</body>

</html>