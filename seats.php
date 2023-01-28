<head>
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

    <div class="top-panel">
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>

    <div class="bottom-panel">
        <div id="filmTitle"></div>
        <div id="seats"></div>

        <div id="book">Book</div>
        <div class="seatsGoBack">
            OR
            <a href="cinema.php">Go back to films</a>
        </div>    
    </div>

    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2022</span>
    </div>
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
    <script defer src="./js/seats.js"></script>

</body>
