<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./img/cinema.jpg">
</head>

<body>
    <?php
        session_start();
    ?>
    
    <header>
        <?php
            if ($_SESSION["login"] == "admin") {
                echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
            }
        ?>
        <a href="index.php"><img src="./img/cinema.jpg" alt="cinema">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png" alt="logout">Log out</a>
    </header>

    <main>
        Films
        <div id="films"></div>
    </main>

    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>

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