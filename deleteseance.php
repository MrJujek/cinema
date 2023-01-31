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
        Delete seance

        <div class="deleteseance">
            <form method="POST" action="deleteseance.php">
            <?php
                if (!isset($_SESSION['isfilmselected'])) {
                    $_SESSION['isfilmselected'] = false;
                    $_SESSION['showseances'] = false;
                } else {
                    $_SESSION['showseances'] = false;
                }

                if ($_SESSION['isfilmselected'] == false) {
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    echo '<label for="selectfilm">Select film:</label>';
                    echo '<select name="selectfilm" id="selectfilm">';
                    
                    $sql = "SELECT title FROM `films`";
                    $res = $conn->query($sql);
                    $response = array();
                    while ($row = mysqli_fetch_assoc($res)) {
                        $response[] = $row;
                    }
                    var_dump($response);  
                    for ($i = 0; $i < count($response); $i++) {
                        $film = $response[$i]['title'];
                        echo '<option value="'.$film.'">'.$film.'</option>';
                    }
                    $conn->close();  
                    
                    echo "</select>";
                }
            ?>
            <?php
                if ($_SESSION['isfilmselected'] == true) {
                    echo '<input type="submit" value="Next"></input>';
                } else {
                    echo $_POST['selectfilm'];
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    echo '<label for="selectseance">Select seance:</label>';
                    echo '<select name="selectseance" id="selectseance">';
                    
                    $sql = "SELECT * FROM `seanse` where id_film = (SELECT id_film FROM `films` WHERE title = '".$_POST['selectfilm']."')";
                    $res = $conn->query($sql);
                    $response = array();
                    while ($row = mysqli_fetch_assoc($res)) {
                        $response[] = $row;
                    }
                    var_dump($response);  
                    for ($i = 0; $i < count($response); $i++) {
                        $date = $response[$i]['date'];
                        $hour = $response[$i]['hour'];
                        echo '<option value="'.$date.'|'.$hour.'">'.$date.' '.$hour.'</option>';
                    }
                    $conn->close();  
                    
                    echo "</select>";

                    echo '<input type="submit" value="Delete seance"></input>';
                }
            ?>
            </form>
            <script>
                function unsetDeleteseancesSessions () {
                    <?php 
                        unset($_SESSION['isfilmselected']);
                        unset($_SESSION['showseances']);    
                    ?>
                }
            </script>
            <?php
                var_dump($_POST);
                if (isset($_POST['selectfilm'])) {
                    $_SESSION['isfilmselected'] = true;
                    echo "OR";
                    echo '<a href="deleteseance.php" onclick=unsetDeleteseancesSessions()>Choose other film</a>';
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