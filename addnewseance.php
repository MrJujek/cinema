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
                
                <label for="choosedate">Choose date:</label>
                <input type="date" name="choosedate" id="choosedate"></input>
                <label for="choosetime">Choose time:</label>
                <input type="time" name="choosetime" id="choosetime"></input>

                <input type="submit" value="Add seance"></input>
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