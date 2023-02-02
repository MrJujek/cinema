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
        Delete seance

        <div class="deleteseance">
            <form method="POST" action="deleteseance.php">
            <?php
                if (isset($_GET['other'])) {
                    unset($_SESSION['isfilmselected']);
                    unset($_SESSION['film']);
                }

                if (!isset($_SESSION['isfilmselected'])) {
                    $_SESSION['isfilmselected'] = false;
                } 

                if (isset($_POST['selectfilm'])) {
                    $_SESSION['isfilmselected'] = true;
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
                    echo $_POST['selectfilm'];
                    if (!isset($_SESSION['film'])) {
                        $_SESSION['film'] = $_POST['selectfilm'];
                    }

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
                } else {
                    echo '<input type="submit" value="Next"></input>';
                }
            ?>
            </form>

            <?php
                if (isset($_POST['selectfilm'])) {
                    $_SESSION['isfilmselected'] = true;
                    echo "OR";
                    echo '<a href="deleteseance.php?other=true"">Choose other film</a>';
                }
            ?>

            <?php
                if (isset($_SESSION['deleteseanceinfo'])) {
                    echo $_SESSION['deleteseanceinfo'];
                    unset($_SESSION['deleteseanceinfo']);
                }
            ?>

            <?php
                if (isset($_POST['selectseance'])) {
                    $date = explode("|", $_POST['selectseance'])[0];
                    $hour = explode("|", $_POST['selectseance'])[1];

                    include "./database/DatabaseData.php";
                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_errno) die('Brak połączenia z MySQL');

                    $sql = "DELETE FROM `seanse` WHERE date = '".$date."' AND hour = '".$hour."' AND id_film = (SELECT id_film FROM `films` WHERE title = '".$_SESSION['film']."')";
                    $res = $conn->query($sql);
                    echo $sql;
                    $conn->close();

                    unset($_SESSION['isfilmselected']);
                    $_SESSION['deleteseanceinfo'] = "Seance deleted";
                    unset($_SESSION['film']);

                    header("Location: deleteseance.php");
                }
            ?>
        </div>
    </main>

    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>
    
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