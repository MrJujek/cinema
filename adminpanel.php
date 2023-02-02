<?php
    session_start();
    unset($_SESSION['isfilmselected']);
    unset($_SESSION['film']);
    unset($_SESSION['deleteseanceinfo']);
?>
<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./img/cinema.jpg">
</head>

<body>
    <div class="top-panel">
        <?php
            if ($_SESSION["login"] == "admin") {
                echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
            }
        ?>
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>
    <div class="bottom-panel">
        Options
        <div id="options">
            <a href="addnewseance.php">Add new seance</a>
            <a href="addnewfilm.php">Add new film</a>
            <a href="deleteseance.php">Delete seance</a>
            <a href="deletefilm.php">Delete film</a>
            <a href="addfilmimage.php">Add film image</a>
            <a href="deletefilmimage.php">Delete film image</a>
            <a href="delete_all_reservations.php">Delete reservations</a>
            <a href="cinema.php" class="gotofilms">Check films</a>
        </div>
    </div>
    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </div>
    
    <?php
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            $_SESSION["logged"] = false;
            exit();
        } else {
            if ($_SESSION["login"] != "admin") {
                header("Location: index.php");
                exit();
            } else {
                $_SESSION["logged"] = true;
            }
        }
    ?>
</body>

</html>