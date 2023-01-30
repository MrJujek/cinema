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
            <form method="POST">
                <?php
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    if (!$_SESSION["delete1"]) {
                        if (isset($_POST['selectfilm'])) {
                            $_SESSION["delete1"] = true;
                        }
                    } else if (!$_SESSION["delete2"]) {
                        $_SESSION["delete2"] = true;
                    }

                    if ($_SESSION["delete1"]) {
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

                        if (!$_SESSION["delete2"]) {
                            echo '<input type="submit" value="Next"></input>';
                        }
                    }
                    if ($_SESSION["delete2"]) {
                        echo '<label for="selecttime">Select time:</label>';
                        echo '<select name="selecttime" id="selecttime">';

                        // $selectedfilm = '3';
                        // $sql = "SELECT * FROM `seanse` where id_film = '$selectedfilm'";
                        // $res = $conn->query($sql); 
                        
                        echo "</select>";
                        echo '<input type="submit" value="Next"></input>';
                    }
                ?>  
            </form>

            <?php
                include "./database/DatabaseData.php";
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_errno) die('Brak połączenia z MySQL');

                if (isset($_POST['choosedate'], $_POST['choosetime'], $_POST['selectfilm'])) {
                    $sql = "SELECT id_film FROM `films` WHERE title = '".$_POST['selectfilm']."'";
                    $res = $conn->query($sql);
                    $response = array();
                    while ($row = mysqli_fetch_assoc($res)) {
                        $response[] = $row;
                    }
                    $id_film = $response[0]['id_film']; 

                    $date = $_POST['choosedate'];
                    $time = $_POST['choosetime'];
                    $film = $_POST['selectfilm'];

                    $sql = "INSERT INTO seanse (id, id_film, date, hour) VALUES ('0','$id_film','$date','$time:00')";
                    $res = $conn->query($sql);
                    if ($res==null){
                        header("Location: addnewseance.php");
                    } else {
                        echo "Seance added";
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