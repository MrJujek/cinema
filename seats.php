<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <?php
    session_start();
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit();
        }
    ?>

    <header>
        <?php
            if ($_SESSION["login"] == "admin") {
                echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
            }
        ?>
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </header>

    <main>
        <div id="filmTitle"></div>
        <div id="seats"></div>

        <div id="book">Book</div>
        <div class="seatsGoBack">
            OR
            <a href="cinema.php">Go back to films</a>
        </div>    
    </main>

    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2022</span>
    </footer>

    <script>
        function giveGet() {
            return <?php echo json_encode($_GET); ?>;
        }

        function getIdOfFilm() {
            return <?php
                session_start();
                $json = $_SESSION['id'];
                $jsonstring = json_encode($json);
                echo $jsonstring;
            ?>
        }
    </script>

    <script src="./js/seats.js"></script>

</body>

</html>