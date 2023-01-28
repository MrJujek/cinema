<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <div class="top-panel">
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>
    <div class="bottom-panel">
        Films
        <div id="films"></div>
    </div>
    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2022</span>
    </div>
    <script src="./js/cinema.js"></script>
    
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        $_SESSION["logged"] = false;
        exit();
    } else {
        $_SESSION["logged"] = true;
    }
    ?>
</body>

</html>