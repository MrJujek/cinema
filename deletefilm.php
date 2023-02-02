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
    <div class="top-panel">
        <?php
            session_start();
            if ($_SESSION["login"] == "admin") {
                echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
            }
        ?>
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>
    <div class="bottom-panel">
        Add new seance

        <div class="addnewseance">
            <form method="POST">
                <label for="selectfilm">Select film:</label>
                <select name="selectfilm" id="selectfilm">
                <?php
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

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
                ?>
                </select>

                <input type="submit" value="Delete film"></input>
            </form>

            <?php
                if (isset($_SESSION["deleted"])) {
                    if ($_SESSION["deleted"] == "true") {
                        echo "Film deleted";
                    } else {
                        echo "There was an error";
                    }
                    unset($_SESSION["deleted"]);
                }
            ?>

            <?php
                include "./database/DatabaseData.php";
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_errno) die('Brak połączenia z MySQL');

                if (isset($_POST['selectfilm'])) {
                    $film = $_POST['selectfilm'];
                    
                    $sql = "DELETE FROM `films` WHERE title = '$film'";
                    $res = $conn->query($sql);
                    
                    if ($res==null){
                        $_SESSION["deleted"] = "false";
                        header("Location: deletefilm.php");
                    } else {
                        $_SESSION["deleted"] = "true";
                        header("Location: deletefilm.php");
                    }
                    $conn->close();
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