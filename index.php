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
        if (!isset($_SESSION['logged'])) {
            $_SESSION['logged'] = false;
        } else {
            if (!$_SESSION['logged']) {
                $_SESSION['logged'] = false;
            } else {
                $_SESSION['logged'] = true;
            }
        }
        unset($_SESSION['isfilmselected']);
        unset($_SESSION['film']);
        unset($_SESSION['deleteseanceinfo']);
    ?>

    <header>
        <?php
        if ($_SESSION["login"] == "admin") {
            echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
        }
        ?>
        <a href="index.php"><img src="img/cinema.jpg">Cinema</a>
        <?php
        if ($_SESSION["logged"] == true) {
            echo '<a href="logout.php" class="logout"><img src="img/logout.png">Log out</a>';
        }
        ?>
    </header>

    <main>
        <div class="index">
        <?php
            if ($_SESSION["logged"] == false) {
                echo '<a href="sign_in.php">Sign in</a>';
                echo 'OR';
                echo '<a href="sign_up.php">Sign up</a>';
            } else {
                echo '<a href="cinema.php" class="gotofilms">Go to films</a>';
            }
        ?>        
        </div>
    </main>

    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>
</body>