<?php
    session_start();
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
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>
    <div class="bottom-panel">
        Add new film

        <div class="addnewfilm">
            <form method="POST">
                <label for="filmname">Input file name:</label>
                <input type="text" name="filmname" id="filmname"></input>

                <label for="selectimage">Choose film image:</label>
                <select name="selectimage" id="selectimage">
                <?php
                    $images = scandir('./img/films');
                    for ($i = 2; $i < count($images); $i++) {
                        echo '<option value="'.$images[$i].'">'.$images[$i].'</option>';
                    }
                ?>
                </select>

                <input type="submit" value="Add film"></input>
            </form>

            <?php
                include "./database/DatabaseData.php";
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_errno) die('Brak połączenia z MySQL');

                if (isset($_POST['filmname'], $_POST['selectimage'])) {
                    $filmname = $_POST['filmname'];
                    $selectimage = $_POST['selectimage'];

                    $sql = "INSERT INTO films (id_film, title, img) VALUES ('0','$filmname','$selectimage')";
                    $res = $conn->query($sql);
                    if ($res==null){
                        header("Location: addnewfilm.php");
                    } else {
                        echo "Film added";
                    }
                    $conn->close();
                } else {
                    echo "Fill all fields";
                }
            ?>
        </div>
    </div>
    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </div>
    
    <?php
    session_start();
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
    <?php
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    ?>
</body>

</html>