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
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </header>

    <main>
        Delete reservation

        <div class="deletereservation">
            <form method="POST">
                <label for="selectreservation">Select reservation:</label>
                <select name="selectreservation" id="selectreservation">
                <?php
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    $sql = "SELECT * FROM `book`";
                    $res = $conn->query($sql);
                    $response = array();
                    while ($row = mysqli_fetch_assoc($res)) {
                        $response[] = $row;
                    }

                    for ($i = 0; $i < count($response); $i++) {
                        $reservation_value = $response[$i]['id']."|".$response[$i]['row']."|".$response[$i]['seat']."|".$response[$i]['id_film'];
                        $reservation_text = $response[$i]['id']." | ".$response[$i]['row']." | ".$response[$i]['seat']." | ".$response[$i]['id_film'];
                        echo '<option value="'.$reservation_value.'">'.$reservation_text.'</option>';
                    }
                    $conn->close();           
                ?>
                </select>

                <input type="submit" value="Delete reservation"></input>
            </form>
            OR
            <a href="delete_all_reservations.php?all=true">Delete all reservations</a>

            <?php
                if (isset($_SESSION["deleted"])) {
                    if ($_SESSION["deleted"]) {
                        echo "Reservation deleted";
                    } else {
                        echo "There was an error";
                    }
                    unset($_SESSION["deleted"]);
                }
            ?>

            <?php
                if (isset($_GET['all'])) {
                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    $sql = "DELETE FROM `book`";
                    $res = $conn->query($sql);
                    
                    if ($res==null){
                        $_SESSION["deleted"] = false;
                        header("Location: delete_all_reservations.php");
                    } else {
                        $_SESSION["deleted"] = true;
                        header("Location: delete_all_reservations.php");
                    }
                    $conn->close();
                }
            ?>

            <?php
                include "./database/DatabaseData.php";
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_errno) die('Brak połączenia z MySQL');

                if (isset($_POST['selectreservation'])) {
                    $reservation = $_POST['selectreservation'];
                    $reservation = explode("|", $reservation);
                    
                    $sql = "DELETE FROM `book` WHERE `id` = $reservation[0] AND `row` = $reservation[1] AND `seat` = $reservation[2] AND `id_film` = $reservation[3]";
                    $res = $conn->query($sql);
                    
                    if ($res==null){
                        $_SESSION["deleted"] = false;
                        header("Location: delete_all_reservations.php");
                    } else {
                        $_SESSION["deleted"] = true;
                        header("Location: delete_all_reservations.php");
                    }
                    $conn->close();
                }
            ?>
        </div>
    </main>

    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>
    
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