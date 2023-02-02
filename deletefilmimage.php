<?php
    session_start();
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
        Delete film image

        <div class="deletefilmimage">
            <form method="POST">
                <label for="selectimage">Choose image:</label>
                <select name="selectimage" id="selectimage">
                <?php
                    $images = scandir('./img/films');
                    for ($i = 2; $i < count($images); $i++) {
                        echo '<option value="'.$images[$i].'">'.$images[$i].'</option>';
                    }
                ?>
                </select>

                <input type="submit" value="Delete"></input>
            </form>

            <?php
                if (isset($_POST['selectimage'])) {
                    $selectimage = $_POST['selectimage'];

                    if (unlink('img/films/'.$selectimage)) {
                        echo 'The file ' . $selectimage . ' was deleted successfully!';
                    } else {
                        echo 'There was a error deleting the file ' . $selectimage;
                    }
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
</body>

</html>